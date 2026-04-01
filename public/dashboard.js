// public/dashboard.js
$(document).ready(function() {

    // ========== VERIFICAR LOGIN ==========
    if (sessionStorage.getItem('admin_logado') !== 'true') {
        window.location.href = '/login_admin';
        return;
    }

    // ========== DATA ATUAL ==========
    var agora = new Date();
    var dataFormatada = agora.toLocaleDateString('pt-BR', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    $('#dataAtual').text(dataFormatada);
    $('#printData').text('Emitido em: ' + agora.toLocaleString('pt-BR'));

    // ========== LOGOUT ==========
    $('#btnLogout').on('click', function() {
        Swal.fire({
            title: 'Deseja sair?',
            text: 'Você será desconectado do painel admin.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#6f42c1',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sim, sair',
            cancelButtonText: 'Cancelar'
        }).then(function(result) {
            if (result.isConfirmed) {
                sessionStorage.removeItem('admin_logado');
                window.location.href = '/login_admin';
            }
        });
    });

    // ========== BOTÃO OBTER DADOS (PDF) ==========
    $('#btnExport').on('click', function() {
        Swal.fire({
            title: '<i class="fa-solid fa-file-arrow-down me-2" style="color:#6f42c1;"></i> Obter dados',
            html: '<p style="color:#555; font-size:0.9rem;">O relatório completo será aberto para impressão.<br>Na janela que abrir, selecione <strong>"Salvar como PDF"</strong> no campo de impressora.</p>',
            showCancelButton: true,
            confirmButtonColor: '#6f42c1',
            cancelButtonColor: '#aaa',
            confirmButtonText: '<i class="fa-solid fa-print me-1"></i> Imprimir / Salvar PDF',
            cancelButtonText: 'Cancelar'
        }).then(function(result) {
            if (result.isConfirmed) {
                setTimeout(function() {
                    window.print();
                }, 350);
            }
        });
    });

    // ========== VARIÁVEIS DOS GRÁFICOS ==========
    var chartModelo, chartCor, chartAno;

    var COLORS = [
        '#6f42c1', '#007aff', '#2ecc71', '#f39c12',
        '#e74c3c', '#1abc9c', '#9b59b6', '#3498db',
        '#e67e22', '#34495e', '#e91e63', '#00bcd4'
    ];

    // ========== FUNÇÃO CARREGAR DADOS ==========
    function carregarDados() {

        // ---------- APARELHOS ----------
        $.ajax({
            url: '/api/todos_samsung',
            method: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res.erro !== 'n') {
                    return;
                }
                var lista = res.samsung || [];

                // Atualizar cards
                $('#totalAparelhos').text(lista.length);
                
                // Calcular cores distintas
                var coresMap = {};
                var anosMap = {};
                $.each(lista, function(i, item) {
                    if (item.cor) coresMap[item.cor] = true;
                    if (item.ano) anosMap[item.ano] = true;
                });
                $('#totalCores').text(Object.keys(coresMap).length);
                $('#totalAnos').text(Object.keys(anosMap).length);

                // Gráfico Modelo
                var cModelo = {};
                $.each(lista, function(i, item) {
                    cModelo[item.modelo] = (cModelo[item.modelo] || 0) + 1;
                });
                if (chartModelo) chartModelo.destroy();
                chartModelo = new Chart(document.getElementById('chartModelo'), {
                    type: 'bar',
                    data: {
                        labels: Object.keys(cModelo),
                        datasets: [{
                            label: 'Quantidade',
                            data: Object.values(cModelo),
                            backgroundColor: COLORS,
                            borderRadius: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, ticks: { stepSize: 1 } }
                        }
                    }
                });

                // Gráfico Cor
                var cCor = {};
                $.each(lista, function(i, item) {
                    if (item.cor) {
                        cCor[item.cor] = (cCor[item.cor] || 0) + 1;
                    }
                });
                if (chartCor) chartCor.destroy();
                chartCor = new Chart(document.getElementById('chartCor'), {
                    type: 'doughnut',
                    data: {
                        labels: Object.keys(cCor),
                        datasets: [{
                            data: Object.values(cCor),
                            backgroundColor: COLORS,
                            borderWidth: 3,
                            borderColor: '#fff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'right' }
                        }
                    }
                });

                // Gráfico Ano
                var cAno = {};
                $.each(lista, function(i, item) {
                    if (item.ano) {
                        cAno[item.ano] = (cAno[item.ano] || 0) + 1;
                    }
                });
                var anosOrdenados = Object.keys(cAno).sort();
                if (chartAno) chartAno.destroy();
                chartAno = new Chart(document.getElementById('chartAno'), {
                    type: 'line',
                    data: {
                        labels: anosOrdenados,
                        datasets: [{
                            label: 'Aparelhos',
                            data: $.map(anosOrdenados, function(ano) {
                                return cAno[ano];
                            }),
                            borderColor: '#6f42c1',
                            backgroundColor: 'rgba(111,66,193,0.08)',
                            borderWidth: 2.5,
                            pointBackgroundColor: '#6f42c1',
                            pointRadius: 5,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, ticks: { stepSize: 1 } }
                        }
                    }
                });

                // Tabela Aparelhos (últimos 8)
                var ultimos = lista.slice(-8).reverse();
                var html = '';
                if (ultimos.length === 0) {
                    html = '<tr><td colspan="5" style="text-align:center;color:#ccc;padding:20px;">Nenhum aparelho cadastrado.</td></tr>';
                } else {
                    $.each(ultimos, function(i, ap) {
                        html += '<tr>' +
                            '<td style="color:#bbb;">#' + (ap.id || '') + '</td>' +
                            '<td><strong>' + (ap.aparelho || '—') + '</strong></td>' +
                            '<td><span class="tag tag-purple">' + (ap.modelo || '—') + '</span></td>' +
                            '<td>' + (ap.cor || '—') + '</td>' +
                            '<td><span class="tag tag-blue">' + (ap.ano || '—') + '</span></td>' +
                            '</tr>';
                    });
                }
                $('#tabelaAparelhos').html(html);
            },
            error: function() {
                $('#totalAparelhos').text('Erro');
            }
        });

        // ---------- USUÁRIOS ----------
        var token = null;
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.indexOf('token=') === 0) {
                token = cookie.substring('token='.length, cookie.length);
                break;
            }
        }

        $.ajax({
            url: '/api/todos_cadastros' + (token ? '?token=' + token : ''),
            method: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res.erro !== 'n') {
                    $('#totalContas').text('—');
                    $('#tabelaUsuarios').html('<tr><td colspan="5" style="text-align:center;color:#f39c12;padding:20px;"><i class="fa-solid fa-triangle-exclamation me-1"></i> Token de API necessário para listar usuários.</td></tr>');
                    return;
                }
                var lista = res.usuarios || [];
                $('#totalContas').text(lista.length);
                
                var html = '';
                if (lista.length === 0) {
                    html = '<tr><td colspan="5" style="text-align:center;color:#ccc;padding:20px;">Nenhum usuário cadastrado.</td></tr>';
                } else {
                    $.each(lista, function(i, u) {
                        html += '<tr>' +
                            '<td style="color:#bbb;">#' + (u.id || '') + '</td>' +
                            '<td><strong>' + (u.nome || '—') + '</strong></td>' +
                            '<td style="color:#666;">' + (u.email || '—') + '</td>' +
                            '<td><span class="tag tag-purple">' + (u.genero || '—') + '</span></td>' +
                            '<td>' + (u.telefone || '—') + '</td>' +
                            '</tr>';
                    });
                }
                $('#tabelaUsuarios').html(html);
            },
            error: function() {
                $('#totalContas').text('Erro');
                $('#tabelaUsuarios').html('<tr><td colspan="5" style="text-align:center;color:#e74c3c;padding:20px;">Erro ao carregar usuários.</td></tr>');
            }
        });
    }

    // Executar carregamento
    carregarDados();
    
    // Esconder loading
    setTimeout(function() {
        $('#loadingOverlay').fadeOut(400);
    }, 800);

});
{{-- resources/views/dashboard_admin_pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; color: #333; margin: 0; padding: 0; }
        .header { border-bottom: 2px solid #6f42c1; padding-bottom: 10px; margin-bottom: 20px; }
        h1 { color: #6f42c1; margin: 0; font-size: 22px; }
        .date { font-size: 11px; color: #666; }

        /* A MÁGICA PARA OS CARDS: Usando Tabela para total compatibilidade */
        .metrics-container {
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px 0; /* Espaço entre os cards */
            margin: 20px 0;
            margin-left: -10px; /* Alinha o primeiro card à esquerda */
        }
        .metric-card {
            background: #f4f0fa; /* Roxo bem clarinho */
            border: 1px solid #d1c4e9;
            border-radius: 8px;
            padding: 15px 5px;
            text-align: center;
            width: 25%; /* 4 cards = 25% cada */
        }
        .metric-label {
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            color: #555;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .metric-value {
            display: block;
            font-size: 24px;
            font-weight: bold;
            color: #6f42c1;
        }

        /* Tabela de Dados */
        h2 { font-size: 16px; margin-top: 30px; color: #444; }
        table.data-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.data-table th { background: #6f42c1; color: white; padding: 10px; font-size: 12px; text-align: left; }
        table.data-table td { border-bottom: 1px solid #eee; padding: 8px; font-size: 11px; }
        .row-even { background-color: #fafafa; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Dashboard de Gestão</h1>
        <div class="date">Gerado em: {{ now()->format('d/m/Y H:i:s') }}</div>
    </div>

    <table class="metrics-container">
        <tr>
            <td class="metric-card">
                <span class="metric-label">Total Aparelhos</span>
                <span class="metric-value">{{ $totalAparelhos }}</span>
            </td>
            <td class="metric-card">
                <span class="metric-label">Total Contas</span>
                <span class="metric-value">{{ $totalContas }}</span>
            </td>
            <td class="metric-card">
                <span class="metric-label">Cores Distintas</span>
                <span class="metric-value">{{ $totalCores }}</span>
            </td>
            <td class="metric-card">
                <span class="metric-label">Anos Distintos</span>
                <span class="metric-value">{{ $totalAnos }}</span>
            </td>
        </tr>
    </table>

    <h2>Últimos Aparelhos</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Modelo</th>
                <th>Cor</th>
                <th>Ano</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aparelhos as $index => $a)
            <tr class="{{ $index % 2 == 0 ? '' : 'row-even' }}">
                <td>{{ $a->id }}</td>
                <td>{{ $a->nome ?? 'N/A' }}</td>
                <td>{{ $a->modelo }}</td>
                <td>{{ $a->cor }}</td>
                <td>{{ $a->ano }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
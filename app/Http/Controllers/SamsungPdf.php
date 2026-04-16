<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Usuario;
use App\Models\SamsungModel;

class SamsungPdf extends Controller
{
    public function generate(){
        // Versão mais simples possível
        $data = [
            'totalAparelhos' => SamsungModel::count(),
            'totalContas' => Usuario::count(),
            'totalCores' => SamsungModel::distinct('cor')->count('cor'),
            'totalAnos' => SamsungModel::distinct('ano')->count('ano'),
            'aparelhos' => SamsungModel::latest()->take(10)->get(),
            'usuarios' => Usuario::latest()->take(10)->get(),
            'name' => 'Vinicius Silveira'
        ];
        
        $pdf = Pdf::loadView('PdfDashBoard', $data);
        
        return $pdf->download("Dashboard.pdf");
    }
}
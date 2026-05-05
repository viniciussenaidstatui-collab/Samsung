<?php
 
namespace App\Jobs;
 
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;
use App\Models\SamsungModel;
use App\Models\Usuario;
 
class RenovaCache implements ShouldQueue
{
    use Queueable;
 
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }
 
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Apaga o cache antigo
        Cache::forget('dashboard_samsung');
 
        // Recria o cache com dados frescos
        Cache::rememberForever('dashboard_samsung', function() {
            $data = [];
            $data['totalAparelhos'] = SamsungModel::count();
            $data['totalContas']    = Usuario::count();
            $data['totalCores']     = SamsungModel::distinct('cor')->count('cor');
            $data['totalAnos']      = SamsungModel::distinct('ano')->count('ano');
            $data['aparelhos']      = SamsungModel::latest()->take(10)->get();
            $data['usuarios']       = Usuario::latest()->take(10)->get();
            $data['name']           = 'Vinicius Silveira';
            return $data;
        });
    }
}

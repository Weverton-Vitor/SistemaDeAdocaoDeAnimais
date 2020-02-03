<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Animal;
use App\Models\PedidoAdocao;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(
            function () {
                //Negando todos pedidos fora data de validade            
                PedidoAdocao::where([['situacao', '=', 'P'], ['data_validade', '=', date('Y-m-d')]])->update(['situacao' => 'N']);

                //Liberando os animais para a adoção no site
                $animais = Animal::where('situacao_adocao', 'R')->with('pedidoAdocao')->get();
                foreach ($animais as $animal) {
                    if ($animal->pedidoAdocao->situacao == "N") {
                        $animal->situacao_adocao = "N";
                        $animal->save();
                    }
                }

            }
        )->dailyAt('23:59');   
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Inscription;
use Carbon\Carbon;
use DB;

class InscriptionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:inscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Borrar inscripciones de mas de 6 dias';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('inscriptions')
        ->where('inscription_status', 0)
        ->where('updated_at', '<', Carbon::now()->subDays(10))
        ->delete();

        DB::table('inscriptions')
        ->where('inscription_status', 2)
        ->where('updated_at', '<', Carbon::now()->subDays(10))
        ->delete();
    }
}

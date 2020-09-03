<?php

namespace App\Console\Commands;

use App\LosDataKbdb;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class KBDBAddLatestDataToDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kbdb:add-latest-data-to-db {livedata}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Overschrijf de oude data met de nieuwe gecrawlde data';

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
        $livedata = $this->argument('livedata');

        LosDataKbdb::truncate();

        foreach ($livedata as $data) {
            LosDataKbdb::create([
                'losplaats' => $data[0],
                'weer' => $data[1],
                'opmerking' => $data[2],
                'losuur' => $data[3],
            ]);
        }

        Log::info('Nieuwe data is overschreven');
    }
}

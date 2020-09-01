<?php

namespace App\Console\Commands;

use App\LosDataKbdb;
use Illuminate\Console\Command;

class CrawlKbdbTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:kbdb-test {crawler}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl a test URL for lossingsdata';

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
        $crawler = (object) $this->argument('crawler');

        $table = $crawler->filter('table:first-of-type')->filter('tr')->each(function ($tr, $i) {
            return $tr->filter('td')->each(function ($td, $i) {
                return trim($td->text());
            });
        });

        // Remove the first row cause it's the header row, but they failed their HTML markup
        unset($table[0]);

        LosDataKbdb::truncate();

        foreach (array_slice($table, 1) as $tabledata) {
            LosDataKbdb::create([
                'losplaats' => $tabledata[0],
                'weer' => $tabledata[1],
                'opmerking' => $tabledata[2],
                'losuur' => $tabledata[3],
            ]);
        }
    }
}

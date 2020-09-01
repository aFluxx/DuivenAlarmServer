<?php

namespace App\Console\Commands;

use App\LosData;
use Goutte\Client;
use Illuminate\Console\Command;

class CrawlDuivenspel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:duivenspel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl the web for data and populate the database';

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
        $client = new Client();

        $crawler = $client->request('GET', 'http://duivenspel.be/homepage.php');

        $table = $crawler->filter('#lossingsinfo ~ table')->filter('tr')->each(function ($tr, $i) {
            return $tr->filter('td')->each(function ($td, $i) {
                return trim($td->text());
            });
        });

        LosData::truncate();

        foreach (array_slice($table, 1) as $tabledata) {
            LosData::create([
                'losplaats' => $tabledata[0],
                'verbond' => $tabledata[1],
                'losuur' => $tabledata[2],
                'opmerking' => $tabledata[3],
            ]);
        }
    }
}

<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Goutte\Client;
use App\KBDBTableGrinder;
use Illuminate\Console\Command;
use League\HTMLToMarkdown\HtmlConverter;

class KBDBGrindTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kbdb:grind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawls the KBDB website for the table and store it in the database';

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

        $crawler = $client->request('GET', 'https://www.kbdb.be/teletekst/lossingsinfo_nl.php');

        $lastChangedData = explode(" ", $crawler->filter('strong:first-of-type')->eq(0)->text());
        $lastChangedTime = Carbon::parse(str_replace('/', '-', $lastChangedData[1]) . ' ' . $lastChangedData[2]);

        $tableHTML = $crawler->filter('table:first-of-type')->html();

        KBDBTableGrinder::create([
            'lossingsinformatie' => $lastChangedTime,
            'html' =>  $tableHTML,
        ]);
    }
}

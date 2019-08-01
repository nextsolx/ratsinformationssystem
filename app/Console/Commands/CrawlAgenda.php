<?php

namespace App\Console\Commands;

use App\Agendum;
use App\OParl\OParlApiManager;
use App\Paper;
use Illuminate\Console\Command;

class CrawlAgenda extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:agenda-items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl all Agenda Items';

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
     * @return mixed
     */
    public function handle()
    {
        $page = 1;

        do {
            list($agendaItems, $pages) = OParlApiManager::agendaItems($page);

            collect($agendaItems)->each(function ($agendum) {
                Agendum::initialize($agendum);
            });

            $page ++;
        }
        while ($pages['totalPages'] >= $page);
    }
}

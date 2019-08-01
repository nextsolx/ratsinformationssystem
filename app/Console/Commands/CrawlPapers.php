<?php

namespace App\Console\Commands;

use App\OParl\OParlApiManager;
use App\Paper;
use Illuminate\Console\Command;

class CrawlPapers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:papers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl all Papers';

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
            list($papers, $pages) = OParlApiManager::papers($page);

            collect($papers)->each(function ($paper) {
                Paper::initialize($paper);
            });

            $page ++;
        }
        while ($pages['totalPages'] >= $page);
    }
}

<?php

namespace App\Console\Commands;

use App\Meeting;
use App\OParl\OParlApiManager;
use App\Organization;
use Illuminate\Console\Command;

class CrawlOrganizations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:organizations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl all Organizations';

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
            list($organizations, $pages) = OParlApiManager::organizations($page);

            collect($organizations)->each(function ($organization) {
                Organization::initialize($organization);
            });

            $page ++;
        }
        while ($pages['totalPages'] >= $page);
    }
}

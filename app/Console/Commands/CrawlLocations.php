<?php

namespace App\Console\Commands;

use App\OParl\OParlApiManager;
use App\Location;
use Illuminate\Console\Command;

class CrawlLocations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:locations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl all Locations';

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
            list($locations, $pages) = OParlApiManager::locations($page);

            collect($locations)->each(function ($location) {
                Location::initialize($location);
            });

            $page ++;
        }
        while ($pages['totalPages'] >= $page);
    }
}

<?php

namespace App\Console\Commands;

use App\Membership;
use App\OParl\OParlApiManager;
use Illuminate\Console\Command;

class CrawlMemberships extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:memberships';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl all People';

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
            list($memberships, $pages) = OParlApiManager::memberships($page);

            collect($memberships)->each(function ($membership) {
                Membership::initialize($membership);
            });

            $page ++;
        }
        while ($pages['totalPages'] >= $page);
    }
}

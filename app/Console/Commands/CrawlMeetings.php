<?php

namespace App\Console\Commands;

use App\Meeting;
use App\OParl\OParlApiManager;
use Illuminate\Console\Command;

class CrawlMeetings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:meetings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl all Meetings';

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
            list($meetings, $pages) = OParlApiManager::meetings($page);

            collect($meetings)->each(function ($meeting) {
                Meeting::initialize($meeting);
            });

            $page ++;
        }
        while ($pages['totalPages'] >= $page);
    }
}

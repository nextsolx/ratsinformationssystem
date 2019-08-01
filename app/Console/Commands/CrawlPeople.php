<?php

namespace App\Console\Commands;

use App\OParl\OParlApiManager;
use App\Person;
use Illuminate\Console\Command;

class CrawlPeople extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:people';

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
            list($people, $pages) = OParlApiManager::people($page);

            collect($people)->each(function ($person) {
                Person::initialize($person);
            });

            $page ++;
        }
        while ($pages['totalPages'] >= $page);
    }
}

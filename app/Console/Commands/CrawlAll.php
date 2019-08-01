<?php

namespace App\Console\Commands;

use App\OParl\OParlApiManager;
use App\Person;
use Illuminate\Console\Command;

class CrawlAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl all All';

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
        $this->info('Crawling Organizations, Memberships and People');

        $this->call('crawl:organizations');
        $this->info('...');

        $this->call('crawl:people');
        $this->info('...');

        $this->call('crawl:memberships');

        $this->info('done.');

        $this->info('Crawling Meetings and Locations');

        $this->call('crawl:meetings');
        $this->info('...');

        $this->call('crawl:locations');
        $this->info('done.');

        $this->info('Crawling Consultations and AgendaItems');
        $this->info('This could take up to 30 minutes');

        $this->call('crawl:consultations');
        $this->info('...');

        $this->call('crawl:agenda-items');
        $this->info('...');

        $this->info('Crawling Papers and Files');
        $this->info('This could take up to 30 minutes');

        $this->call('crawl:papers');
        $this->info('...');

        $this->call('crawl:files');
        $this->info('done.');


        $this->info('Crawling finished');
    }
}

<?php

namespace App\Console\Commands;

use App\Consultation;
use App\OParl\OParlApiManager;
use App\Person;
use Illuminate\Console\Command;

class CrawlConsultations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:consultations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl all Consultations';

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
        $page = 265;

        do {
            list($consultations, $pages) = OParlApiManager::consultations($page);

            collect($consultations)->each(function ($consultation) {
                Consultation::initialize($consultation);
            });

            $page ++;
        }
        while ($pages['totalPages'] >= $page);
    }
}

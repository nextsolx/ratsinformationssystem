<?php

namespace App\Console\Commands;

use App\File;
use App\OParl\OParlApiManager;
use Illuminate\Console\Command;

class CrawlFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl all Files';

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
            list($files, $pages) = OParlApiManager::files($page);

            collect($files)->each(function ($file) {
                File::initialize($file);
            });

            $page ++;
        }
        while ($pages['totalPages'] >= $page);
    }
}

<?php

namespace App\Console\Commands;

use App\OParl\OParlApiManager;
use App\Organization;
use App\Person;
use Illuminate\Console\Command;

class MatchParties extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:match-parties';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Match all parties';

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
        $this->info('Matching Organization Party to people');
        
        Organization::where('classification', 'Fraktion')->get()
            ->each(function($organization) {
                $organization->people->each(function ($person) use ($organization){
                    $person->party = $organization->name;
                    $person->save();
                });
            });
    }
}

<?php

namespace go280286sai\search_json\Commands;

use go280286sai\search_json\Json\LogClear;
use go280286sai\search_json\Json\LogMessage;
use go280286sai\search_json\Models\Index_search;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ClearAllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all tables, logs and data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $title = $this->ask('Are you want to clear all tables? y/n');
            if ($title == 'y' || $title == 'yes') {
                Index_search::clear();
                LogClear::clear();
                LogMessage::send('Start to clear all tables of date:' . Carbon::now());
            } else {
                LogMessage::send('Arg is empty of date:' . Carbon::now());
                throw new \Exception('Arg is empty');
            }
        } catch (\Exception $e) {
            LogMessage::send($e->getMessage() . ' of date:' . Carbon::now());
            $this->error($e->getMessage());
        }
    }
}

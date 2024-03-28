<?php

namespace go280286sai\search_json\Commands;

use go280286sai\search_json\Json\LogMessage;
use go280286sai\search_json\Models\Index_search;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class SearchRemoveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add name table for remove from search';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $title = $this->ask('Add table name for remove from search');
            if (!is_null($title)) {
                Index_search::remove($title);
                LogMessage::send('Add table name: ' . $title . ' for remove of date:' . Carbon::now());
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

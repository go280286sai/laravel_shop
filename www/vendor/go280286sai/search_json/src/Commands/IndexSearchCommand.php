<?php

namespace go280286sai\search_json\Commands;

use go280286sai\search_json\Json\LogMessage;
use go280286sai\search_json\Models\Index_search;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class IndexSearchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start to indexing tables';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $title = $this->ask('Start to indexing tables? y/n');
            if ($title == 'y' || $title == 'yes') {
                Index_search::create_search();
                LogMessage::send('Start to indexing of date:' . Carbon::now());
            } elseif ($title == 'n' || $title == 'no') {
                $this->info('If need to run indexing tables than select y/yes');
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

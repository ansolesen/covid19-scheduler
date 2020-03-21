<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class FetchNewData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var int
     */
    private $chunkSize = 100;
    /**
     * @var string
     */
    private $connectionName = 'production';

    /**
     * @var string
     */
    private $tableName = 'survey';


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::connection($this->connectionName)
            ->table($this->tableName)
            ->whereDate('modified_on', ">", now()->subHour())
            ->orderBy('modified_on', 'desc')
            ->chunk($this->chunkSize, function($rows){
                InsertOrCreateReportingRows::dispatch($rows);
            });
    }
}

<?php

namespace App\Jobs;

use App\Survey;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class InsertOrCreateReportingRows implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Collection
     */
    private $rows;

    /**
     * @var string
     */
    private $tableName = 'survey';

    /**
     * Create a new job instance.
     *
     * @param Collection $rows
     */
    public function __construct(Collection $rows)
    {
        //
        $this->rows = $rows;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->rows as $row) {
            DB::table($this->tableName)->updateOrInsert([
                'id' => $row->id
            ], $row instanceof Survey ? $row->toArray() : (array) $row
            );
        }
    }
}

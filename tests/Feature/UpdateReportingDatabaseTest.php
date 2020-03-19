<?php

namespace Tests\Feature;

use App\Jobs\InsertOrCreateReportingRows;
use App\Survey;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;

class UpdateReportingDatabaseTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function can_insert_new_rows()
    {
        $surveys = factory(Survey::class, 5)->create();
        InsertOrCreateReportingRows::dispatch($surveys);
        $this->assertEquals(Survey::all()->count(), $surveys->count());
    }

    /**
     * @test
     */
    public function duplicate_ids_not_inserted_but_updated()
    {
        $survey = factory(Survey::class)->make();
        $person = $survey->person;

        InsertOrCreateReportingRows::dispatch(collect(Arr::wrap($survey)));

        $survey->person = $survey->person - 1;

        InsertOrCreateReportingRows::dispatch(collect(Arr::wrap($survey)));

        $this->assertEquals(Survey::all()->count(), 1);
        $this->assertEquals(Survey::find($survey->id)->person, $person - 1);
    }
}

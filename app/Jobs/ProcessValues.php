<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

use App\Estimate;
use App\Realtime;
use App\Calculated;

use App\Jobs\ProcessAverage;

class ProcessValues implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        DB::statement("update calculated set actualdays=datediff(delivered,despatched)+1");
        Calculated::chunk(1000, function($data) {
            foreach($data as $record)
            {
                $updateRecord = Calculated::where('id', $record->id)->first();
                $avgDays = Calculated::where('from_zone', $updateRecord->from_zone)->where('to_zone', $updateRecord->to_zone)->avg('actualdays');
                $updateRecord->avgdays = $avgDays;
                $updateRecord->save();
            }
        });
    }
}

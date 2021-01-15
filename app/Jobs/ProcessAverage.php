<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Calculated;
//use App\Realtime;

class ProcessAverage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->data as $record)
        {
            $updateRecord = Calculated::where('id', $record->id)->first();
            $avgDays = Calculated::where('from_zone', $updateRecord->from_zone)->where('to_zone', $updateRecord->to_zone)->avg('actualdays');
            $updateRecord->avgdays = $avgDays;
            $updateRecord->save();    
        }
    }
}

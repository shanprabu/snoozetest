<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Estimate;
use App\Realtime;
use App\Calculated;

class ProcessCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $csvData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($csvData)
    {
        $this->csvData = $csvData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->csvData as $partRecord)
        {
            $data = str_getcsv($partRecord,",");
            $realtimeRecord = new Realtime;
            $realtimeRecord->from_zone = $data[2];
            $realtimeRecord->to_zone = $data[3];
            $realtimeRecord->despatched = $data[0];
            $realtimeRecord->delivered = $data[1];
            $realtimeRecord->save();

            $calculated = new Calculated;
            $calculated->from_zone = $data[2];
            $calculated->to_zone = $data[3];
            $calculated->despatched = $data[0];
            $calculated->delivered = $data[1];
            $calculated->avgdays = 0;
            $calculated->actualdays = 0;
            $estimatedDays = Estimate::where('from_zone', $data[2])->where('to_zone',$data[3])->first();
            if($estimatedDays==NULL)
                $calculated->estimatedays = 0;
            else
                $calculated->estimatedays = $estimatedDays->traveltime;
            $calculated->save();
        }
    }
}

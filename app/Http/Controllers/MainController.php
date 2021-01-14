<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Estimate;
use App\Realtime;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function indexPage()
    {
        return view('index');
    }

    public function formSubmit(Request $request)
    {
        if($request->hasFile('etfile') && $request->hasFile('rtfile'))
        {
            $etFile = fopen($request->file('etfile'), "r");
            $temp = fgetcsv($etFile);
            if(Estimate::count()>0)
            {
                Estimate::query()->truncate();
            }
            while(($data = fgetcsv($etFile))!=FALSE)
            {
                $estimateRecord = new Estimate;
                $estimateRecord->from_zone = $data[0];
                $estimateRecord->to_zone = $data[1];
                $estimateRecord->traveltime = $data[2];
                $estimateRecord->save();
            }

            $rtFile = fopen($request->file('rtfile'), "r");
            $temp = fgetcsv($rtFile);
            if(Realtime::count()>0)
            {
                Realtime::query()->truncate();
            }
            while(($data = fgetcsv($rtFile))!=FALSE)
            {
                $realtimeRecord = new Realtime;
                $realtimeRecord->from_zone = $data[2];
                $realtimeRecord->to_zone = $data[3];
                $realtimeRecord->despatched = $data[0];
                $realtimeRecord->delivered = $data[1];
                $realtimeRecord->save();
            }
        }

        $this->processRecords();

        return redirect('/view');
    }

    function viewRecords()
    {
        $outputRecords = Realtime::paginate(100);
        $data['records'] = $outputRecords;
        return view('output', $data);
    }

    function processRecords()
    {
        DB::statement("update realtime set actualdays = datediff(delivered, despatched)+1");
        return;
    }
}

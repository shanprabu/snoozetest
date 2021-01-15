<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessCsv;

use App\Estimate;
use App\Realtime;
use App\Calculated;
use App\Jobs\ProcessValues;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MainController extends Controller
{
    public function uploadFiles()
    {
        return view('upload');
    }

    public function formSubmit(Request $request)
    {
        if($request->hasFile('etfile') && $request->hasFile('rtfile'))
        {
            Calculated::query()->truncate();
            $etFile = file($request->file('etfile')->getRealPath());
            $temp = array_slice($etFile,1);
            if(Estimate::count()>0)
            {
                Estimate::query()->truncate();
            }

            $etFileParts = array_chunk($temp,1000);
            foreach($etFileParts as $partFile)
            {
                foreach($partFile as $partRecord)
                {
                    $data = str_getcsv($partRecord,",");
                    $estimateRecord = new Estimate;
                    $estimateRecord->from_zone = $data[0];
                    $estimateRecord->to_zone = $data[1];
                    $estimateRecord->traveltime = $data[2];
                    $estimateRecord->save();
                        
                }
            }

            $rtFile = file($request->file('rtfile')->getRealPath());
            $temp = array_slice($rtFile,1);
            if(Realtime::count()>0)
            {
                Realtime::query()->truncate();
            }
            $rtFileParts = array_chunk($temp,1000);
            
            foreach($rtFileParts as $partFile)
            {
                ProcessCsv::dispatch($partFile);
            }
        }
        ProcessValues::dispatch();
        return redirect()->route('view');
    }

    function viewRecords()
    {
        $outputRecords = Calculated::paginate(100);
        $data['records'] = $outputRecords;
        return view('output', $data);
    }

    function getVue()
    {
        $calculatedRecords = Calculated::get();
        return response()->json($calculatedRecords);
    }

    function showVue()
    {
        return view('vueoutput');
    }
}

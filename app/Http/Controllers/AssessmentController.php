<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assessment;
use App\Assessment_AHP;
use App\Criteria;
use App\Media;
Use Alert;
use PDF;
class AssessmentController extends Controller
{
    public function index(){
        $criterias = Criteria::orderBy('criteria_code','Asc')->with('sub_criteria')->get();
        $criteria_filtered = Criteria::orderBy('criteria_code','Asc')->has('assessment')->with('sub_criteria')->get();
        $media = Media::orderBy('id','Asc')->with('assessment')->get(); 
        $arr = Assessment::dss_ahp_saw();
        // return $arr;
        // return Assessment::getMaxMin($criterias);
        return view('dashboard.admin.assessment.index',compact('criterias','media','arr','criteria_filtered'));
        
    }
    public function export(){
        $criteria_filtered = Criteria::orderBy('criteria_code','Asc')->with('sub_criteria')->get();
        $arr = Assessment::dss_ahp_saw();
        $pdf = PDF::loadview('dashboard.admin.assessment.rank',compact('criteria_filtered','arr'))->setPaper('a4', 'landscape');
    	return $pdf->download('Data Rank');
    }

    public function store(Request $request){
        // return $request->all();
        request()->validate([
            'criteria_id'=>['required'],
            'weight'=>['required']
        ]);
            if (count(Criteria::get())!=count($request->weight)) {
                return redirect()->route('assessment')->withErrors('Please Choose All Criteria Weight');
            }
        $arr=[];
        foreach($request['criteria_id'] as $index => $criteria_id){
            $arr[]=[
                'media_id'=>$request['media_id'],
                'criteria_id'=>$criteria_id,
                'weight'=>$request['weight'][$index]
            ];
        }
        // return $arr;
        foreach($arr as $data){
            try {
                Assessment::updateOrCreate([
                'media_id'=>$request['media_id'],
                'criteria_id'=>$data['criteria_id'],
                ],[
                'weight'=>$data['weight']
                ]);
            } catch (\Throwable $th) {
                // return $th;
                return redirect()->route('assessment')->withErrors('Error');
            }
        }
        return redirect()->route('assessment')->withSuccess('Success');
    }

    
}

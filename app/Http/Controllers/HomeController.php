<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use App\Criteria;
use App\SubCriteria;
use App\Assessment;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $media = Media::get();
        $media = count($media);
        $assessment_success =  count(Media::has('assessment')->get());
        $assessment_pending =  count(Media::doesntHave('assessment')->get());
        $criteria=Criteria::get();
        $criteria = count($criteria);

        $sub_criteria=SubCriteria::get();
        $sub_criteria = count($sub_criteria);

        return view('dashboard.admin.home',compact('criteria','sub_criteria','media','assessment_success','assessment_pending'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
class MediaController extends Controller
{
    //
    public function index(){
        $media = Media::get();
        return view('dashboard.admin.media.index',compact('media'));

    }
    public function destroy($id){
        $media = Media::findOrFail($id);
        $media->delete();
        return redirect()->route('media')->withSuccess('Delete Data Success');
    }
    public function create(){
        return view('dashboard.admin.media.create');
    }
    public function store(Request $request){
        request()->validate($this->validation());
        try {
            $media = Media::create($this->field());
            
        } catch (\Throwable $th) {
            return redirect()->route('media.create')->withErrors('Add New Data Failed');
            
        }
        return redirect()->route('media')->withSuccess('Add New Data Success');
    }

    public function edit($id){
        $media = Media::where('id',$id)->first();
        return view('dashboard.admin.media.edit',compact('media'));

    }
    public function update($id,Request $request){
        request()->validate($this->validation());
        try {
            $media = Media::findOrFail($id);
            $media->update($this->field());
            
        } catch (\Throwable $th) {
            return redirect()->route('media.create')->withErrors('Add New Data Failed');
            
        }
        return redirect()->route('media')->withSuccess('Add New Data Success');
    }

    public function validation(){
        return [
            'media_name'=>['required'],
            //'gender'=>['required','in:Male,Female'],
            'size'=>['required'],
            //'birth_date'=>['required'],
            'address'=>['required'],
            'position'=>['required'],
        ];
    }
    public function field(){
        return [
            'media_name'=>request('media_name'),
            //'gender'=>request('gender'),
            'size'=>request('size'),
            //'birth_date'=>request('birth_date'),
            'address'=>request('address'),
            'position'=>request('position'),
        ];
    }
}

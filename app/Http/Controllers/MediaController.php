<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use App\Imports\MediaImport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
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
            'size'=>['required'],
            'ukuran'=>['required'],
            'address'=>['required'],
            'position'=>['required'],
        ];
    }
    public function field(){
        return [
            'media_name'=>request('media_name'),
            'size'=>request('size'),
            'ukuran'=>request('ukuran'),
            'address'=>request('address'),
            'position'=>request('position'),
        ];
    }
    public function import(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = $file->hashName();

        //temporary file
        $path = $file->storeAs('public/excel/',$nama_file);

        // import data
        $import = Excel::Import(new MediaImport(), storage_path('app/public/excel/'.$nama_file));

        //remove from server
        Storage::delete($path);

        if($import) {
            //redirect
            return redirect()->route('media.index')->with(['success' => 'Data Berhasil Diimport!']);
        } else {
            //redirect
            return redirect()->route('media.index')->with(['error' => 'Data Gagal Diimport!']);
        }
    }

    /*public function importView(Request $request){
        return view('importFile');
    }

    public function import(Request $request){
        Excel::import(new MediaController, $request->file('file')->store('files'));
        return redirect()->back();
    }*/


    public function exportMedia(Request $request){
        return Excel::download(new MediaController, 'datamana.xlsx');
    }
}

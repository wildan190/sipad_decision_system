@extends('dashboard.master')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Media</h1>
  </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header font-weight-bold text-primary">Edit Record
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{route('media.update',['id'=>$media->id])}}" method="POST">
                            @csrf
                            @method('put')
                                <!--<div class="form-group">
                                  <label for="full_name">Full Name</label>
                                <input type="text" name="full_name" class="form-control" id="full_name" aria-describedby="full_nameHelp" value="{{$media->full_name}}">
                                </div>-->
                                <div class="form-group">
                                  <label for="media_name">Media Type</label>
                                  <select name="media_name" class="form-control" id="media_name">
                                    <option value='Billboard' {{$media->media_name=='Billboard'?'selected':''}}>Billboard</option>
                                    <option value='VideoTron' {{$media->media_name=='VideoTron'?'selected':''}}>VideoTron</option>
                                    <option value='Banner' {{$media->media_name=='Banner'?'selected':''}}>Banner</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="size">Size Media</label>
                                  <select name="size" class="form-control" id="size">
                                    <option value='12x4' {{$media->size=='12x4'?'selected':''}}>12x4</option>
                                    <option value='8x20' {{$media->size=='8x20'?'selected':''}}>8x20</option>
                                  </select>
                                </div>
                                <!--<div class="form-group">
                                  <label for="birth_place">Place Of Birth</label>
                                  <input type="text" name="birth_place" class="form-control" id="birth_place" aria-describedby="birth_placeHelp" value="{{$media->birth_place}}">
                                </div>
                                <div class="form-group">
                                    <label for="birth_date">Date Of Birth</label>
                                    <input type="date" name="birth_date" class="form-control" id="birth_date" aria-describedby="birth_dateHelp" value="{{$media->birth_date}}">
                                </div>-->
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" class="form-control" id="address" aria-describedby="addressHelp" >{{$media->address}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="position">Position</label>
                                <input type="text" name="position" class="form-control" id="position" aria-describedby="positionHelp" value="{{$media->position}}">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
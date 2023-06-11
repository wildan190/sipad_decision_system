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
                                <div class="form-group">
                                  <label for="media_name">Media Type</label>
                                  <select name="media_name" class="form-control" id="media_name">
                                    <option value='Jagorawi'>Jagorawi</option>
                                    <option value='Jakarta-Cikampek' {{$media->media_name=='Jakarta-Cikampek'?'selected':''}}>Jakarta-Cikampek</option>
                                    <option value='Jakarta-Tangerang'{{$media->media_name=='Jakarta-Tangerang'?'selected':''}}>Jakarta-Tangerang</option>
                                    <option value='Dalam Kota Jakarta'{{$media->media_name=='Dalam Kota Jakarta'?'selected':''}}>Dalam Kota Jakarta</option>
                                    <option value='Jln Tol Lingkar Luar Jkt'{{$media->media_name=='Jln Tol Lingkar Luar Jkt'?'selected':''}}>Jln Tol Lingkar Luar Jkt</option>
                                    <option value='Ulujami-Pondok Aren' {{$media->media_name=='Ulujami-Pondok Aren'?'selected':''}}>Ulujami-Pondok Aren</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="size">Tipe Media</label>
                                  <select name="size" class="form-control" id="size">
                                    <option value='Billboard' {{$media->size=='Billboard'?'selected':''}}>12x4</option>
                                    <option value='VideoTron' {{$media->size=='VideoTron'?'selected':''}}>8x20</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="ukuran">Size Media</label>
                                  <select name="ukuran" class="form-control" id="ukuran">
                                    <option value='20x8' {{$media->size=='20x8'?'selected':''}}>20x8</option>
                                    <option value='24x10' {{$media->size=='24x10'?'selected':''}}>24x10</option>
                                  </select>
                                </div>
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
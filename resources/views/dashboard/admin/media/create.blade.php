@extends('dashboard.master')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Media</h1>
  </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header font-weight-bold text-primary">New Record
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{route('media.store')}}" method="POST">
                            @csrf
                                <!--<div class="form-group">
                                  <label for="full_name">Media Name</label>
                                  <input type="text" name="full_name" class="form-control" id="full_name" aria-describedby="full_nameHelp">
                                </div>-->
                                <div class="form-group">
                                  <label for="media_name">Lokasi</label>
                                  <select name="media_name" class="form-control" id="media_name">
                                    <option value='Jagorawi'>Jagorawi</option>
                                    <option value='Jakarta-Cikampek'>Jakarta-Cikampek</option>
                                    <option value='Jakarta-Tangerang'>Jakarta-Tangerang</option>
                                    <option value='Dalam Kota Jakarta'>Dalam Kota Jakarta</option>
                                    <option value='Jln Tol Lingkar Luar Jkt'>Jln Tol Lingkar Luar Jkt</option>
                                    <option value='Ulujami-Pondok Aren'>Ulujami-Pondok Aren</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="size">Typd Media</label>
                                  <select name="size" class="form-control" id="size">
                                    <option value='Billboard'>Billboard</option>
                                    <option value='VideoTron'>VideoTron</option>
                                  </select>
                                </div>
                                <!--<div class="form-group">
                                  <label for="birth_place">Place Of Birth</label>
                                  <input type="text" name="birth_place" class="form-control" id="birth_place" aria-describedby="birth_placeHelp">
                                </div>
                                <div class="form-group">
                                    <label for="birth_date">Date Of Birth</label>
                                    <input type="date" name="birth_date" class="form-control" id="birth_date" aria-describedby="birth_dateHelp">
                                </div>-->
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" class="form-control" id="address" aria-describedby="addressHelp"></textarea>
                                </div>
                                <div class="form-group">
                                <label for="position">Position</label>
                                <input type="text" name="position" class="form-control" id="position" aria-describedby="positionHelp">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
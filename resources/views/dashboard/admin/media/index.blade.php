@extends('dashboard.master')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Media</h1>
</div>
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-sm mb-4">
            <div class="card-header font-weight-bold text-primary">List Data
                <a href="{{route('media.create')}}" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus-square"></i> New Record</a></a>
            </div>

            <div class="card-body">
                <div class="button-action" style="margin-bottom: 20px">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#import">
                        IMPORT
                    </button>
                    <a href="" class="btn btn-primary btn-md">EXPORT</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="data" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Lokasi</th>
                                <th>Media</th>
                                <th>Ukuran</th>
                                <th>Address</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($media as $index => $media)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$media->media_name}}</td>
                                <td>{{$media->size}}</td>
                                <td>{{$media->ukuran}}</td>
                                <td>{{$media->address}}</td>
                                <td>{{$media->position}}</td>
                                <td>
                                    <a href="{{route('media.show',['id'=>$media->id])}}" class="btn btn-sm btn-primary"><i class="fas fa-th-list"></i></a>
                                    <a href="/dashboard/media/{{$media->id}}/edit" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="/dashboard/media/{{$media->id}}/delete" method="post" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger float" onclick="return confirm('Yakin?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">IMPORT DATA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('media.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>PILIH FILE</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-success">IMPORT</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('sbadmin2\vendor\datatables\jquery.dataTables.js')}}"></script>
<script src="{{asset('sbadmin2\vendor\datatables\dataTables.bootstrap4.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#table').DataTable();
    } );
</script>
<script>
    $(document).ready(function() {
        $('#data').DataTable();
    });
</script>
@endpush
<div class="card border-0 mb-4 mt-2">
    <div class="card-header font-weight-bold text-primary">List Assessment
        <a href="{{route('media.create')}}" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus-square"></i> New Record</a></a>
    </div>

    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-bordered" id="data" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tempat</th>
                        @foreach ($criterias as $criteria)
                        <th>{{$criteria->criteria_code}}<br>
                            ({{$criteria->name}})</th>
                        @endforeach
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($media as $index => $media)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$media->media_name}}</td>
                        <form action="{{route('assessment.store')}}" method="post">
                            <input type="hidden" name="media_id" value="{{$media->id}}">
                            @foreach ($criterias as $criteria)
                            @csrf
                            <td>
                                <input type="hidden" name="criteria_id[]" value="{{$criteria->id}}">
                                <select name="weight[]" class="form-controll" required>
                                    <option selected disabled>--Choose--</option>
                                    @foreach ($criteria->sub_criteria as $sub_criteria)

                                    <option value="{{$sub_criteria->weight}}" @foreach ($media->assessment as $assessment)
                                        {{($criteria->id == $assessment->criteria_id && 
                                                $sub_criteria->weight == $assessment->weight)?'selected':''}}
                                        @endforeach

                                        >{{$sub_criteria->name}}
                                    </option>

                                    @endforeach
                                </select>
                            </td>
                            @endforeach
                            <td>
                                <button type="submit" class="btn btn-primary">Save</button>

                            </td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
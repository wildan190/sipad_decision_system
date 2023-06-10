<div class="card border-0 mb-4 mt-2">
    <div class="card-header font-weight-bold text-primary">
        List AHP Weight Result
    </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered" id="weight" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tempat</th>
                            @foreach ($criteria_filtered as $criteria)
                        <th>{{$criteria->criteria_code}}<br>
                        ({{$criteria->name}})</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($media as $index => $media)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$media->media_name}}</td>
                            @foreach ($criteria_filtered as $criteria)
                            @csrf
                            <td>
                             @foreach ($criteria->sub_criteria as $sub_criteria)
                                        
                                            @foreach ($media->ahp as $ahp)
                                                {{($criteria->id == $ahp->criteria_id && 
                                                $sub_criteria->weight == $ahp->weight)?$ahp->weight:''}}
                                            @endforeach
                                            

                                        @endforeach
                                    </select>
                                </td>
                            @endforeach
                               
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
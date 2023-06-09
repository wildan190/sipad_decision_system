<div class="card border-0 mb-4 mt-2">
    <div class="card-header font-weight-bold text-primary">
        Rank
    </div>

    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-bordered" border="1" id="weight" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Rank.</th>
                        <th>Tempat</th>
                        @foreach ($criteria_filtered as $criteria)
                        <th>{{$criteria->criteria_code}}<br>
                            ({{$criteria->name}})</th>
                        @endforeach
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arr as $index => $result)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$result['media_name']}}</td>
                        @foreach ($result['criteria'] as $key => $criteria)
                        <td>
                            @if (isset($criteria['result']))
                            {{$criteria['result']}}
                            @else
                            N/A
                            @endif
                        </td>
                        @endforeach
                        <td>
                            {{$result['score']}}
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
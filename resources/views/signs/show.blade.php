@extends('layouts.app')

@section('content')
    <h2>{{$sign->file_name}}</h2>
    <div class="d-flex justify-content-between">
        <small>Submitted on {{$sign->created_at}} by {{$user->name}}</small>
        <a href="/signs/upload/{{$sign->id}}" class="btn btn-success">Upload Signed File</a>
    </div>
    <hr>
    <div class="card">
        <div class="card-header">
            Requested Signature
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Last update</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach($assigneds as $assigned)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{$assigned->name}}</td>
                                @if ($assigned->status == 2)
                                    <td class="d-flex justify-content-between">done<button class="btn btn-success" disabled></button></td>
                                @endif
                                @if ($assigned->status == 1)
                                    <td class="d-flex justify-content-between">reviewing<button class="btn btn-warning" disabled></button></td>
                                @endif
                                @if ($assigned->status == 0)
                                    <td class="d-flex justify-content-between">waiting<button class="btn btn-danger" disabled></button></td>
                                @endif
                            <td>{{$assigned->updated_at}}</td>
                        </tr>
                        @php
                            $no +=1;
                        @endphp
                    @endforeach
                 </tbody>
            </table>
            <br>
            <div class="d-flex justify-content-between">
                <div>
                    {{-- <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a> --}}
                    {!! Form::open(['action' => ['SignsController@downloadingFile', $sign->id], 'method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
                    {{Form::submit('Download File to Sign', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
                </div>
                @if(!Auth::guest() && Auth::user()->id == $sign->user_id)
                    <div>  
                        {!! Form::open(['action' => ['SignsController@destroy', $sign->id], 'method' => 'POST']) !!}
                        {{Form::hidden('_method' , 'DELETE')}}
                        {{Form::submit('Delete File', ['class' => 'btn btn-danger'])}}
                        {!! Form::close() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <hr>
    <div>
        <div>
            {{-- {!! Form::open(['action' => ['SignsController@downloadingOriginalFile', $sign->id], 'method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
            {{Form::submit('Download', ['class' => 'text-info'])}}
            {!! Form::close() !!} --}}
            <a href="/signs/downloadingoriginal/{{$sign->id}}">Download original file disini</a>
        </div>
    </div>
@endsection
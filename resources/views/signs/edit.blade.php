@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{!! $dataTable->table() !!}}
        </div>
    </div>
    {{!! $dataTable->scripts() !!}}
@endsection
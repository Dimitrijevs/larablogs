@extends('layout.template')

@section('content')
    @include('components.main.listHeader')
    @include('components.main.postList', $posts)
@endsection

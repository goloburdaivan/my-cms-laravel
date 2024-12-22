@extends('site.layout')

@section('title', $page->title)

@section('content')
    {!! $page->html !!}
@endsection

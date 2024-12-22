@extends('layouts.app')

@section('content')
    <div class="editable" style="padding-top: 20px" data-editable data-name="main-content">
        {!! $item->html !!}
    </div>
@endsection

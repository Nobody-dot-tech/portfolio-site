@extends('layouts.app')

@section('content')
    <div class="w-full my-4 rounded">
        <h1>{{ $concert->title }}</h1>
    </div>
    <div class="w-full my-4 rounded">
        <p>日程：{{ $concert->date }}</p>
    </div>
    <div class="w-full my-4 rounded">
        <p>場所：{{ $concert->place }}</p>
    </div>
    <div class="w-full my-4 rounded">
        <p>開場：{{ $concert->open }}</p>
    </div>
    <div class="w-full my-4 rounded">
        <p>開演：{{ $concert->start }}</p>
    </div>
    <div class="w-full my-4 rounded">
        <p>プログラム：</p><br>
        <p>{!! nl2br(e($concert->program)) !!}</p>
    </div>
    <div class="w-full my-4 rounded">
        <p>見どころ：</p><br>
        <p>{!! nl2br(e($concert->comment)) !!}</p>
    </div>
@endsection
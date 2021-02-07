@extends('Layouts.master')

@section('title','الرئيسية')

@section('content')
<div class="Home1">
    <div class="container">
        <img src="{{ asset('/assets/images/home1.png') }}" class="wow fadeInDown" alt="" />
        <h2 class="title">
            {{ $data->pages[0]->title }}
            {!! $data->pages[0]->description !!}        
        </h2>
        <a href="{{ URL::to('/joinUs') }}" class="btnStyle">انضم الآن</a>
    </div>
</div>
@endsection
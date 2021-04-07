@extends('Layouts.master')

@section('title','الفعاليات القادمة')

@section('styles')

@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>الفعاليات القادمة</h2>
            <ul class="list-unstyled">
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li class="active">الفعاليات القادمة</li>
            </ul>
        </div>
    </div>

    <div class="members actions">
        <div class="container">
            <h2 class="title">{{ $data->pages[0]->title }}</h2>
            <div class="row">
                @foreach($data->data as $key => $event)
                <div class="col-md-5 wow fadeInUp">
                    <a href="{{ URL::to('/events/'.$event->id) }}" class="memb event">
                        <img src="{{ $event->photo }}"/>
                        <p class="price pull-left mb-2"> {{ $event->date }}</p>
                        <p class="price pull-right mb-2"> {{ $event->type }}</p>
                        <div class="clearfix"></div>
                        <h2 class="name">{{ $event->title }}</h2>
                    </a>
                </div>
                <div class="col-md-1"></div>
                @endforeach
            </div>
        </div>
    </div>
@endsection



@section('scripts')
@endsection
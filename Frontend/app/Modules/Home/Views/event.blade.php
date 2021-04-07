@extends('Layouts.master')

@section('title','تفاصيل الفعالية')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>تفاصيل الفعالية</h2>
            <ul class="list-unstyled">
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li class="active">{{ $data->data->title }}</li>
            </ul>
        </div>
    </div>

    <div class="project">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="author">
                        <img src="{{ $data->data->photo }}" alt="" />
                        <h2 class="title">{{ $data->data->title }}</h2>
                        <span class="new">{{ $data->data->price }} ر.س</span>
                        <p><i class="flaticon-flag"></i>  {{ $data->data->type }}</p>
                        <p><i class="flaticon-school-calendar"></i> {{ $data->data->date }}</p>
                    </div>
                    
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
    </div>
        
@endsection

@section('scripts')

@endsection
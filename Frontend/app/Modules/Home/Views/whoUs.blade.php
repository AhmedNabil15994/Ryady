@extends('Layouts.master')

@section('title','من نحن')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>من نحن</h2>
            <ul class="list-unstyled">
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li class="active">من نحن</li>
            </ul>
        </div>
    </div>

    
@endsection

@section('scripts')

@endsection
@extends('Layouts.master')

@section('title','شبكة VIP')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>شبكة VIP</h2>
            <ul class="list-unstyled">
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li class="active">شبكة VIP</li>
            </ul>
        </div>
    </div>
    
    <div class="vipPage">
        <div class="container">
            <div class="row">
                @foreach($data->data->data as $user)
                <div class="col-md-4">
                    <div class="itemVip">
                        <img src="{{ $user->user->photo }}" alt="" />
                        <div class="mask">
                            <h2 class="title">أ.{{ $user->user->name_ar }}</h2>
                            <a href="#" class="btnStyle" data-toggle="modal" data-area="{{ $user->user_id }}" data-target="#profile">الملف الشخصي</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @include('Partials.pagination')
        </div>
    </div>
    
    <div class="join">
        <img src="{{ asset('/assets/images/bgJoin.png') }}" class="bg" alt="" />
        <div class="container">
            <div class="desc">
                {{ $data->pages[0]->title }}
            </div>
            <a class="btnStyle">انضم الينا</a>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('/assets/js/profile.js') }}"></script>
@endsection
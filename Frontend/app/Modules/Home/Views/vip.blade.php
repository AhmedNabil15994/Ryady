@extends('Layouts.master')

@section('title','شبكة تنفيذية VIP')

@section('styles')
<style type="text/css" media="screen">
    .vipPage .itemVip{
        height: 250px;
    }
    .vipPage .itemVip .mask{
        padding-top: 190px;
    }
</style>
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>شبكة تنفيذية VIP</h2>
            <ul class="list-unstyled">
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li class="active">شبكة تنفيذية VIP</li>
            </ul>
        </div>
    </div>
    
    <div class="vipPage">
        <div class="container">
            <input type="hidden" name="cols" value="{{ \Session::has('user_id') ? \Session::get('user_id') : 0 }}">
            <div class="row">
                @foreach($data->data->data as $user)
                <div class="col-md-4">
                    <div class="itemVip">
                        <img src="{{ $user->user->photo }}" alt="" />
                        <div class="mask">
                            <h2 class="title">أ.{{ $user->user->name_ar }}</h2>
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
            <a href="{{ URL::to('/joinUs') }}" class="btnStyle">انضم الينا</a>
        </div>
    </div>
@endsection

@section('modals')
@include('Partials.joinUsModal')
@endsection

@section('scripts')
<script src="{{ asset('/assets/js/profile.js') }}"></script>
<script src="{{ asset('/assets/js/joinUs.js') }}"></script>
@endsection

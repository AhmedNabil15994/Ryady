@extends('Layouts.master')

@section('title','الاعضاء')

@section('styles')
<style type="text/css" media="screen">
    @foreach($data->memberships as $membership)
    .membership{{ $membership->id }}:hover{
        border-color: {{ $membership->color }} !important;
    }
    @endforeach
</style>
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>أعضاء الشاب الريادي</h2>
            <ul class="list-unstyled">
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li class="active">أعضاء الشاب الريادي</li>
            </ul>
        </div>
    </div>
    
    <div class="members">
        <div class="container">
            <div class="row">
                @foreach($data->data->data as $member)
                <div class="col-md-3 wow fadeInUp">
                    <div class="memb">
                        <img class="membership{{ $member->membership_id }}" src="{{ $member->user->photo }}" style="" />
                        <h2 class="name">أ.{{ $member->user->name_ar }}</h2>
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
            <a href="{{ URL::to('/joinUs') }}" class="btnStyle">{!! $data->pages[0]->description !!}</a>
        </div>
    </div>
@endsection


@section('scripts')
<script src="{{ asset('/assets/js/profile.js') }}"></script>
@endsection
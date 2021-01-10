@extends('Layouts.master')

@section('title','الاعضاء')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>أعضاء الشاب الريادي</h2>
            <ul class="list-unstyled">
                <li class="active"><a href="index.html">الرئيسية</a></li>
                <li>أعضاء الشاب الريادي</li>
            </ul>
        </div>
    </div>
    
    <div class="members">
        <div class="container">
            <div class="row">
                <div class="col-md-3 wow fadeInUp">
                    <div class="memb">
                        <img src="{{ asset('/assets/images/memb1.png') }}" />
                        <h2 class="name">أ.عبدالله بن مساعد</h2>
                        <a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
                    </div>
                </div>
                <div class="col-md-3 wow fadeInUp">
                    <div class="memb">
                        <img src="{{ asset('/assets/images/memb2.png') }}" />
                        <h2 class="name">أ.عبدالله بن مساعد</h2>
                        <a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
                    </div>
                </div>
                <div class="col-md-3 wow fadeInUp">
                    <div class="memb">
                        <img src="{{ asset('/assets/images/memb3.png') }}" />
                        <h2 class="name">أ.عبدالله بن مساعد</h2>
                        <a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
                    </div>
                </div>
                <div class="col-md-3 wow fadeInUp">
                    <div class="memb">
                        <img src="{{ asset('/assets/images/memb4.png') }}" />
                        <h2 class="name">أ.عبدالله بن مساعد</h2>
                        <a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
                    </div>
                </div>
                <div class="col-md-3 wow fadeInUp">
                    <div class="memb">
                        <img src="{{ asset('/assets/images/memb5.png') }}" />
                        <h2 class="name">أ.عبدالله بن مساعد</h2>
                        <a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
                    </div>
                </div>
                <div class="col-md-3 wow fadeInUp">
                    <div class="memb">
                        <img src="{{ asset('/assets/images/memb6.png') }}" />
                        <h2 class="name">أ.عبدالله بن مساعد</h2>
                        <a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
                    </div>
                </div>
                <div class="col-md-3 wow fadeInUp">
                    <div class="memb">
                        <img src="{{ asset('/assets/images/memb7.png') }}" />
                        <h2 class="name">أ.عبدالله بن مساعد</h2>
                        <a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
                    </div>
                </div>
                <div class="col-md-3 wow fadeInUp">
                    <div class="memb">
                        <img src="{{ asset('/assets/images/memb8.png') }}" />
                        <h2 class="name">أ.عبدالله بن مساعد</h2>
                        <a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
    
    <div class="join">
        <img src="{{ asset('/assets/images/bgJoin.png') }}" class="bg" alt="" />
        <div class="container">
            <div class="desc">
                {{ $data->pages[0]->title }}
            </div>
            <a href="#" class="btnStyle">{!! $data->pages[0]->description !!}</a>
        </div>
    </div>
@endsection


@section('scripts')

@endsection
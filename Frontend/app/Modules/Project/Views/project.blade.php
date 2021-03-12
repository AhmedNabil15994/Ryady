@extends('Layouts.master')

@section('title','مشاريع الاعضاء')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>مشاريع الشركاء</h2>
            <ul class="list-unstyled">
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li><a href="{{ URL::to('/projects') }}">مشاريع الشركاء</a></li>
                <li class="active">{{ $data->data->title }}</li>
            </ul>
        </div>
    </div>

    <div class="project">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="sliderProject">
                        <div id="myslide" class="carousel slide"  data-ride="carousel">
                            <div class="relative">
                                <div class="carousel-inner">
                                    @foreach($data->data->images as $key => $image)
                                    <div class="item {{ $key== 0 ? 'active' : '' }}">
                                        <img src="{{ $image->photo }}" alt="...">
                                    </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#myslide" role="button" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="carousel-control-next" href="#myslide" role="button" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                            <div class="projCarousel">
                              <!-- Indicators -->
                                <ol class="carousel-indicators Owl owl-carousel clearfix" id="carousel-indicators">
                                    @foreach($data->data->images as $key => $image)
                                    <li data-target="#myslide" class="item {{ $key== 0 ? 'active' : '' }}" data-slide-to="{{ $key }}">
                                        <img src="{{ $image->photo }}" alt="...">
                                    </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="author">
                        <img src="{{ $data->data->logo }}" alt="" />
                        <h2 class="title">{{ $data->data->title }}</h2>
                        <span class="new">{{ $data->data->category }}</span>
                        <p><i class="flaticon-flag"></i> {{ $data->data->typeMessage }}</p>
                        {{-- <p><i class="flaticon-place"></i>  {{ $data->data->type_text }}</p> --}}
                    </div>
                    
                    <div class="projectDetails">
                        <div class="tabsHead">
                            <ul class="btnsTabs clearfix" id="tabs">
                                <li id="tab1" class="active">التفاصيل</li>
                                <li id="tab2">رأس مال المشروع</li>
                            </ul>
                        </div>
                        <div class="tabs">
                            <div class="tab1 tab">
                                <div class="desc">
                                    {!! $data->data->brief !!}                           
                                </div>                              
                            </div>
                            <div class="tab2 tab">
                                @if(!empty($data->data->coupons))
                                <div class="discount clearfix">
                                    <span>{{ $data->data->coupons }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="map">
                        <iframe src = "https://maps.google.com/maps?q={{ $data->data->lat }},{{ $data->data->lng }}&hl=es;z=14&amp;output=embed" width="600" height="450"></iframe>
                    </div>
                    <div class="infoProject">
                        <h2 class="title">معلومات الاتصال</h2>
                        <div class="info">
                            <i class="flaticon-email"></i>
                            <span class="name">البريد الإلكتروني</span>
                            <a href="#">{{ $data->data->email }}</a>
                        </div>
                        <div class="info">
                            <i class="flaticon-phone-call"></i>
                            <span class="name">رقم الجوال</span>
                            <a href="#">{{ $data->data->phone }}</a>
                        </div>
                        <ul class="socialProj clearfix">
                            @if($data->user->facebook != '')
                            <li><a href="{{ $data->user->facebook }}" target="_blank" class="fa fa-facebook"></a></li>
                            @endif
                            @if($data->user->snapchat != '')
                            <li><a href="{{ $data->user->snapchat }}" target="_blank" class="fa fa-snapchat"></a></li>
                            @endif
                            @if($data->user->twitter != '')
                            <li><a href="{{ $data->user->twitter }}" target="_blank" class="fa fa-twitter"></a></li>
                            @endif
                            @if($data->user->youtube != '')
                            <li><a href="{{ $data->user->youtube }}" target="_blank" class="fa fa-youtube"></a></li>
                            @endif
                            @if($data->user->instagram != '')
                            <li><a href="{{ $data->user->instagram }}" target="_blank" class="fa fa-instagram"></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
@endsection

@section('scripts')

@endsection
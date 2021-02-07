@extends('Layouts.master')

@section('title','مشاريع الاعضاء')

@section('styles')
@endsection

@section('content')
    <div class="project">
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
        
        <div class="map">
            <iframe src = "https://maps.google.com/maps?q={{ $data->data->lat }},{{ $data->data->lng }}&hl=es;z=14&amp;output=embed" width="600" height="450"></iframe>
        </div>
        
        <div class="container">
            <div class="author">
                <img src="{{ $data->data->logo }}" alt="" />
                <h2 class="title">{{ $data->data->title }}</h2>
                <span class="new">{{ $data->data->category }}</span>
                <p><i class="flaticon-place"></i>  {{ $data->data->address }}</p>
            </div>
        </div>      
        <div class="projectDetails">
            <div class="tabsHead">
                <ul class="btnsTabs clearfix" id="tabs">
                    <li id="tab1" class="active">التفاصيل</li>
                    <li id="tab2">كوبونات الخصم</li>
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
                    @foreach($data->data->coupons as $coupon)
                    <div class="discount clearfix">
                        <span>خصم {{ $coupon->discount_value }} {{ $coupon->discount_type == 1 ? 'ريال' : '%' }} على اجمالي الفاتورة</span>
                        <a href="#">اطلب الآن</a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        
        </div>
    </div>
@endsection

@section('scripts')

@endsection
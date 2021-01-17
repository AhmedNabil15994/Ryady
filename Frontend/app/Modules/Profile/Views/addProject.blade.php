@extends('Layouts.master')

@section('title','اضف مشروعك')

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
                <li class="active">انضم الينا</li>
            </ul>
        </div>
    </div>
        
    <div class="orderPage partnerProj">
        <div class="container">
            <div class="row">
            <form class="col-md-8 center-block">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="inputStyle" name="title" placeholder="اسم المشروع :" />
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="inputStyle" name="phone" placeholder="رقم الجوال :" />
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="inputStyle" name="email" placeholder="البريد الالكتروني :" />
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="inputStyle" name="address" placeholder="العنوان :" />
                    </div>
                    <div class="col-md-6">
                        <div class="selectStyle">
                            <select class="selectmenu" name="category_id" id="selectmenu">
                                <option value="" disabled selected>اختر التصنيف :</option>
                                @foreach($data->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="selectStyle">
                            <select class="selectmenu" name="city_id" id="selectmenu2">
                                <option value="" disabled selected>اختر المدينة :</option>
                                @foreach($data->cities as $city)
                                <option value="{{ $city->id }}">{{ $city->title }}</option>
                                @endforeach
                            </select>
                            <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="inputSt">
                            <input type="text" class="inputStyle" name="gmaps" placeholder="خرائط جوجل :" />
                            <img class="iconImg locations" data-toggle="modal" data-target=".modal-location" src="{{ asset('/assets/images/google-maps (2).png') }}" />
                            <input type="hidden" name="lat" value="24.774265">
                            <input type="hidden" name="lng" value="46.738586">
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="coupons">
                            <div class="inputSt">
                                <input type="text" class="inputStyle" name="coupons[]" placeholder="كوبونات الخصم :" />
                                <i class="iconImg flaticon-plus iconAdd"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="labelFile">
                            <label>
                                <span>شعار النشاط :</span>
                                <input type="file" name="logo" />
                                <i class="fa fa-upload"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="labelFile">
                            <label>
                                <span>صور عن النشاط :</span>
                                <input type="file" name="images[]" />
                                <i class="fa fa-upload"></i>
                            </label>
                            <ul class="imgs">
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <textarea class="textareaStyle" name="brief" placeholder="نبذة عن المشروع :"></textarea>
                
                <button class="btnStyle perform-btn">ارسل الآن</button>
            </form>
        </div>
        </div>
    </div>
        
@endsection

@section('modals')
@include('Partials.locationModal')
@endsection

@section('scripts')
<script src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>
<script src="{{ asset('/assets/js/locationpicker.jquery.js') }}"></script>
<script src="{{ asset('/assets/js/addProject.js') }}"></script>
@endsection
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
                <li class="active"><a href="index.html">الرئيسية</a></li>
                <li><a href="#">مشاريع الشركاء</a></li>
                <li>انضم الينا</li>
            </ul>
        </div>
    </div>
        
    <div class="orderPage partnerProj">
        <div class="container">
            <div class="row">
            <form class="col-md-8 center-block">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="inputStyle" placeholder="اسم المشروع :" />
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="inputStyle" placeholder="رقم الجوال :" />
                    </div>
                    <div class="col-md-6">
                        <input type="number" class="inputStyle" placeholder="العنوان :" />
                    </div>
                    <div class="col-md-6">
                        <div class="selectStyle">
                            <select class="selectmenu" id="selectmenu">
                                <option>المدينة :</option>
                                <option>المدينة :</option>
                                <option>المدينة :</option>
                                <option>المدينة :</option>
                            </select>
                            <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="inputSt">
                            <input type="text" class="inputStyle" placeholder="خرائط جوجل :" />
                            <img class="iconImg" src="{{ asset('/assets/images/google-maps (2).png') }}" />
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="coupons">
                            <div class="inputSt">
                                <input type="number" class="inputStyle" placeholder="كوبونات الخصم :" />
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
                                <input type="file" />
                                <i class="fa fa-upload"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="labelFile">
                            <label>
                                <span>صور عن النشاط :</span>
                                <input type="file" />
                                <i class="fa fa-upload"></i>
                            </label>
                            <ul class="imgs">
                                <li><img src="{{ asset('/assets/images/uploadImg.png') }}" alt="" /><i class="fa fa-close"></i></li>
                                <li><img src="{{ asset('/assets/images/uploadImg.png') }}" alt="" /><i class="fa fa-close"></i></li>
                                <li><img src="{{ asset('/assets/images/uploadImg.png') }}" alt="" /><i class="fa fa-close"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <textarea class="textareaStyle" placeholder="نبذة عن المشروع :"></textarea>
                
                <button class="btnStyle">ارسل الآن</button>
            </form>
        </div>
        </div>
    </div>
        
@endsection


@section('scripts')

@endsection
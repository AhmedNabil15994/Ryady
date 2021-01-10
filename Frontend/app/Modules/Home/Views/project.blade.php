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
                <li class="active"><a href="index.html">الرئيسية</a></li>
                <li><a href="#">مشاريع الشركاء</a></li>
                <li>مطاعم وكافيهات</li>
            </ul>
        </div>
    </div>
    
    <div class="addProject projectsPageHead">
        <div class="container">
            <form class="searchSelect">
                <div class="row">
                    <div class="col-md-8 center-block">
                        <div class="searchStyle clearfix">
                            <input type="text" placeholder="ابحث عن مزود الخدمة" />
                            <div class="selectStyle">
                                <select class="selectmenu">
                                    <option>حدد المدينة</option>
                                    <option>حدد المدينة</option>
                                </select>
                                <i class="fa fa-angle-down iconLeft"></i>
                            </div>
                            <button class="btnSearch">البحث</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="container-fluid">
            
            <div id="OwlLinks" class="OwlLinks Owl">
                <div class="item">
                    <a href="#" class="itemProject">
                        <i class="flaticon-hospital"></i>
                        <h2 class="titleItem">مستشفيات وعيادات</h2>
                    </a>
                </div>
                <div class="item">
                    <a href="#" class="itemProject">
                        <i class="flaticon-restaurant"></i>
                        <h2 class="titleItem">مطاعم وكافيهات</h2>
                    </a>
                </div>
                <div class="item">
                    <a href="#" class="itemProject">
                        <i class="flaticon-running"></i>
                        <h2 class="titleItem">رياضة وترفيه</h2>
                    </a>
                </div>
                <div class="item">
                    <a href="#" class="itemProject">
                        <i class="flaticon-store"></i>
                        <h2 class="titleItem">متاجر الكترونية</h2>
                    </a>
                </div>
                <div class="item">
                    <a href="#" class="itemProject">
                        <i class="flaticon-presentation"></i>
                        <h2 class="titleItem">مدارس ومراكز تعليم</h2>
                    </a>
                </div>
                <div class="item">
                    <a class="itemProject">
                        <i class="flaticon-aircraft"></i>
                        <h2 class="titleItem">فنادق وسياحة</h2>
                    </a>
                </div>
                <div class="item">
                    <a class="itemProject">
                        <i class="flaticon-grid"></i>
                        <h2 class="titleItem">جميع التصنيفات</h2>
                    </a>
                </div>
            </div>

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
                                <div class="item active">
                                  <img src="{{ asset('/assets/images/projctImg1.png') }}" alt="...">
                                </div>
                                <div class="item ">
                                  <img src="{{ asset('/assets/images/projctImg1.png') }}" alt="...">
                                </div>
                                <div class="item ">
                                  <img src="{{ asset('/assets/images/projctImg1.png') }}" alt="...">
                                </div>
                                <div class="item">
                                  <img src="{{ asset('/assets/images/projctImg1.png') }}" alt="...">
                                </div>
                                <div class="item">
                                  <img src="{{ asset('/assets/images/projctImg1.png') }}" alt="...">
                                </div>
                                <div class="item">
                                  <img src="{{ asset('/assets/images/projctImg1.png') }}" alt="...">
                                </div>
                                <div class="item">
                                  <img src="{{ asset('/assets/images/projctImg1.png') }}" alt="...">
                                </div>
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
                            <li data-target="#myslide" class="item active" data-slide-to="0">
                                <img src="{{ asset('/assets/images/projctImg1.png') }}" alt="...">
                            </li>
                            <li data-target="#myslide" class="item" data-slide-to="1">
                                <img src="{{ asset('/assets/images/projctImg1.png') }}" alt="...">
                            </li>
                            <li data-target="#myslide" class="item" data-slide-to="2">
                                <img src="{{ asset('/assets/images/projctImg1.png') }}" alt="...">
                            </li>
                            <li data-target="#myslide" class="item" data-slide-to="3">
                                <img src="{{ asset('/assets/images/projctImg1.png') }}" alt="...">
                            </li>
                            <li data-target="#myslide" class="item" data-slide-to="4">
                                <img src="{{ asset('/assets/images/projctImg1.png') }}" alt="...">
                            </li>
                            <li data-target="#myslide" class="item" data-slide-to="5">
                                <img src="{{ asset('/assets/images/projctImg1.png') }}" alt="...">
                            </li>
                            <li data-target="#myslide" class="item" data-slide-to="5">
                                <img src="{{ asset('/assets/images/projctImg1.png') }}" alt="...">
                            </li>
                          </ol>

                        </div>
                    </div>
                
                </div>

                    
                    <div class="author">
                        <img src="{{ asset('/assets/images/logoProj1.png') }}" alt="" />
                        <h2 class="title">مذاق الزعفران</h2>
                        <span class="new">انضم حديثا</span>
                        <p><i class="flaticon-place"></i>  جدة - حي الحمراء - شارع فلسطين</p>
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
                                    يمكن للمشترك من خلال اللوحة الخاصة بة بصلاحيات افتراضية من خلالها, اضافة التفاصيل او التعريف الخاص بالنشاط التابع له او الخصومات او الكوبونات 
                                </div>
                                <div class="desc">
                                    يمكن للمشترك من خلال اللوحة الخاصة بة بصلاحيات افتراضية من خلالها, اضافة التفاصيل او التعريف الخاص بالنشاط التابع له او الخصومات او الكوبونات                                   
                                </div>                              
                            </div>
                            <div class="tab2 tab">
                                <div class="discount clearfix">
                                    <span>خصم 50% على اجمالي الفاتورة</span>
                                    <a href="#">اطلب الآن</a>
                                </div>
                                <div class="discount clearfix">
                                    <span>خصم 50% على اجمالي الفاتورة</span>
                                    <a href="#">اطلب الآن</a>
                                </div>
                                <div class="discount clearfix">
                                    <span>خصم 50% على اجمالي الفاتورة</span>
                                    <a href="#">اطلب الآن</a>
                                </div>
                            </div>
                            <div class="tab3 tab">
                                test
                            </div>
                        </div>
                    
                    </div>

                    
                </div>
                <div class="col-md-4">
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3711.2715939772993!2d39.1750041850587!3d21.536233085725666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c3d09b97e2fb0d%3A0x3bafaf5c1752cb0c!2z2YXYsdmD2LIg2KfZhNiu2YjYp9iv2YUg2KfZhNix2YLZhdmK2Kk!5e0!3m2!1sar!2seg!4v1610000395619!5m2!1sar!2seg" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="infoProject">
                    <h2 class="title">معلومات الاتصال</h2>
                    <div class="info">
                        <i class="flaticon-email"></i>
                        <span class="name">البريد الإلكتروني</span>
                        <a href="#">name@name.com</a>
                    </div>
                    <div class="info">
                        <i class="flaticon-phone-call"></i>
                        <span class="name">رقم الجوال</span>
                        <a href="#">012345678912345</a>
                    </div>
                    <ul class="socialProj clearfix">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-snapchat"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-youtube"></a></li>
                        <li><a href="#" class="fa fa-instagram"></a></li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
    </div>
        
@endsection

@section('scripts')

@endsection
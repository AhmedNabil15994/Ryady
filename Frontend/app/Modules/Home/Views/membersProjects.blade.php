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
    
    <div class="PartProjects">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="item">
                        <a href="{{ URL::to('/project') }}" class="mask">
                            <img src="{{ asset('/assets/images/spaghetti-with-meatballs-tomato-sauce-italian-pasta_214995-2300.png') }}" alt="" />
                        </a>
                        <div class="details">
                            <img class="imgDetails" src="{{ asset('/assets/images/logoProj1.png') }}" alt="" />
                            <a href="{{ URL::to('/project') }}" class="title">مذاق الزعفران</a>
                            <p class="location"><i class="flaticon-place"></i> جدة - حي الحمراء - شارع فلسطين </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="item">
                        <a href="{{ URL::to('/project') }}" class="mask">
                            <img src="{{ asset('/assets/images/style-still-life-with-noodles-bowl_1150-19765.png') }}" alt="" />
                            <span>انضم حديثا</span>
                        </a>
                        <div class="details">
                            <img class="imgDetails" src="{{ asset('/assets/images/logoProj2.png') }}" alt="" />
                            <a href="{{ URL::to('/project') }}" class="title">مذاق الزعفران</a>
                            <p class="location"><i class="flaticon-place"></i> جدة - حي الحمراء - شارع فلسطين </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="item">
                        <a href="{{ URL::to('/project') }}" class="mask">
                            <img src="{{ asset('/assets/images/white-shrimp-salad-with-lettuce-corn-scallions-chopped_1150-26942.png') }}" alt="" />
                        </a>
                        <div class="details">
                            <img class="imgDetails" src="{{ asset('/assets/images/logoProj3.png') }}" alt="" />
                            <a href="{{ URL::to('/project') }}" class="title">مذاق الزعفران</a>
                            <p class="location"><i class="flaticon-place"></i> جدة - حي الحمراء - شارع فلسطين </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="item">
                        <a href="{{ URL::to('/project') }}" class="mask">
                            <img src="{{ asset('/assets/images/spaghetti-with-meatballs-tomato-sauce-italian-pasta_214995-2300.png') }}" alt="" />
                        </a>
                        <div class="details">
                            <img class="imgDetails" src="{{ asset('/assets/images/logoProj1.png') }}" alt="" />
                            <a href="{{ URL::to('/project') }}" class="title">مذاق الزعفران</a>
                            <p class="location"><i class="flaticon-place"></i> جدة - حي الحمراء - شارع فلسطين </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="item">
                        <a href="{{ URL::to('/project') }}" class="mask">
                            <img src="{{ asset('/assets/images/style-still-life-with-noodles-bowl_1150-19765.png') }}" alt="" />
                            <span>انضم حديثا</span>
                        </a>
                        <div class="details">
                            <img class="imgDetails" src="{{ asset('/assets/images/logoProj2.png') }}" alt="" />
                            <a href="{{ URL::to('/project') }}" class="title">مذاق الزعفران</a>
                            <p class="location"><i class="flaticon-place"></i> جدة - حي الحمراء - شارع فلسطين </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="item">
                        <a href="{{ URL::to('/project') }}" class="mask">
                            <img src="{{ asset('/assets/images/white-shrimp-salad-with-lettuce-corn-scallions-chopped_1150-26942.png') }}" alt="" />
                        </a>
                        <div class="details">
                            <img class="imgDetails" src="{{ asset('/assets/images/logoProj3.png') }}" alt="" />
                            <a href="{{ URL::to('/project') }}" class="title">مذاق الزعفران</a>
                            <p class="location"><i class="flaticon-place"></i> جدة - حي الحمراء - شارع فلسطين </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="item">
                        <a href="{{ URL::to('/project') }}" class="mask">
                            <img src="{{ asset('/assets/images/spaghetti-with-meatballs-tomato-sauce-italian-pasta_214995-2300.png') }}" alt="" />
                        </a>
                        <div class="details">
                            <img class="imgDetails" src="{{ asset('/assets/images/logoProj1.png') }}" alt="" />
                            <a href="{{ URL::to('/project') }}" class="title">مذاق الزعفران</a>
                            <p class="location"><i class="flaticon-place"></i> جدة - حي الحمراء - شارع فلسطين </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="item">
                        <a href="{{ URL::to('/project') }}" class="mask">
                            <img src="{{ asset('/assets/images/style-still-life-with-noodles-bowl_1150-19765.png') }}" alt="" />
                            <span>انضم حديثا</span>
                        </a>
                        <div class="details">
                            <img class="imgDetails" src="{{ asset('/assets/images/logoProj2.png') }}" alt="" />
                            <a href="{{ URL::to('/project') }}" class="title">مذاق الزعفران</a>
                            <p class="location"><i class="flaticon-place"></i> جدة - حي الحمراء - شارع فلسطين </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="item">
                        <a href="{{ URL::to('/project') }}" class="mask">
                            <img src="{{ asset('/assets/images/white-shrimp-salad-with-lettuce-corn-scallions-chopped_1150-26942.png') }}" alt="" />
                        </a>
                        <div class="details">
                            <img class="imgDetails" src="{{ asset('/assets/images/logoProj3.png') }}" alt="" />
                            <a href="{{ URL::to('/project') }}" class="title">مذاق الزعفران</a>
                            <p class="location"><i class="flaticon-place"></i> جدة - حي الحمراء - شارع فلسطين </p>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="pagiDiv clearfix">
                <a href="#" class="next">التالي</a>
                <ul class="pagination">
                      <li><a href="#" class="active">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                      <li><a href="#">...</a></li>
                      <li><a href="#">19</a></li>
                </ul>
                <a href="#" class="prev">السابق</a>
            </div>
            
        </div>
    </div>
    
    <div class="join">
        <img src="{{ asset('/assets/images/bgJoin.png') }}" class="bg" alt="" />
        <div class="container">
            <div class="desc">
                مجمتع حيوي كبير انضم الآن لأكبر
                مجموعة من المشاريع
            </div>
            <a href="#" class="btnStyle">انضم الينا</a>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
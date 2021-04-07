@extends('Layouts.master')

@section('title','مشاريع الشاب الريادي')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>مشاريع الريادي</h2>
            <ul class="list-unstyled">
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li class="active">مشاريع الريادي</li>
            </ul>
        </div>
    </div>
        
    <div class="addProject projectsPageHead">
        <div class="container">
            <input type="hidden" name="cols" value="{{ \Session::has('user_id') ? \Session::get('user_id') : 0 }}">
            <form class="searchSelect" method="get" action="{{ URL::current() }}">
                <div class="row">
                    <div class="col-md-8 center-block">
                        <div class="searchStyle clearfix">
                            <input type="text" name="title" value="{{ \Request::get('title') }}" placeholder="ابحث عن مزود الخدمة" />
                            <div class="selectStyle">
                                <select class="selectmenu" name="city_id">
                                    <option value="" selected disabled>حدد المدينة</option>
                                    @foreach($data->cities as $city)
                                    <option value="{{ $city->id }}" {{ $city->id == \Request::get('city_id') ? 'selected' : '' }}>{{ $city->title }}</option>
                                    @endforeach
                                </select>
                                <i class="fa fa-angle-down iconLeft"></i>
                            </div>
                            <button type="submit" class="btnSearch">البحث</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="container-fluid">
            
            <div id="OwlLinks" class="OwlLinks Owl">
                @foreach($data->categories as $category)
                <div class="item">
                    <a href="{{ URL::current().'?category_id='.$category->id }}" class="itemProject">
                        <i class="{{ $category->icon }}"></i>
                        <h2 class="titleItem">{{ $category->title }}</h2>
                    </a>
                </div>
                @endforeach
            </div>

        </div>
    </div>
    
    <div class="PartProjects">
        <div class="container">
            <div class="row">
                <div id="OwlCards" class="OwlCards2 Owl wow zoomIn">
                    @foreach($data->data->data as $project)
                    <div class="item">
                        <a href="{{ URL::to('/projects/'.$project->id) }}" class="mask">
                            <img src="{{ !empty($project->images) ? $project->images[array_rand($project->images)]->photo : $project->logo }}" alt="" />
                        </a>
                        <div class="details">
                            <img class="imgDetails" src="{{ $project->logo }}" alt="" />
                            <a href="{{ URL::to('/projects/'.$project->id) }}" class="title pull-right">{{ $project->title }}</a>
                            <div class="clearfix"></div>
                            <p class="location" dir="rtl"><i class="flaticon-flag pull-right"></i> {{ $project->typeMessage }} </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @endforeach
                </div>
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
<script src="{{ asset('/assets/js/joinUs.js') }}"></script>
@endsection
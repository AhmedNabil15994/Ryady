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
                <li class="active">مشاريع الشركاء</li>
            </ul>
        </div>
    </div>
        
    <div class="addProject projectsPageHead">
        <div class="container">
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
                @foreach($data->data->data as $project)
                <div class="col-md-4">
                    <div class="item">
                        <a href="{{ URL::to('/projects/'.$project->id) }}" class="mask">
                            <img src="{{ isset($project->images[0]) ? $project->images[0]->photo : $project->logo }}" alt="" />
                        </a>
                        <div class="details">
                            <img class="imgDetails" src="{{ $project->logo }}" alt="" />
                            <a href="{{ URL::to('/projects/'.$project->id) }}" class="title">{{ $project->title }}</a>
                            <p class="location" dir="rtl"><i class="flaticon-place pull-right"></i> {{ $project->address }} </p>
                        </div>
                        <div class="clearfix"></div>
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

@section('scripts')

@endsection
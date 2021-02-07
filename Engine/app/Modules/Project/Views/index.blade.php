@extends('Layouts.master')

@section('title','مشاريع الشاب الريادي')

@section('styles')
@endsection

@section('content')
    
    <div class="projectsPageHead">
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
                                <i class="fa fa-angle-down iconLeft" style="color:#707070"></i>
                            </div>
                            <button type="submit" class="btnSearch fa fa-search"></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="container-fluid">       
            <div id="OwlLinks" class="OwlLinks owl-carousel owl-theme">
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

@endsection

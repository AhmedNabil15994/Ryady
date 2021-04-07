@extends('Layouts.master')

@section('title','المدونة')

@section('styles')

@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>المدونة</h2>
            <ul class="list-unstyled">
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li class="active">المدونة</li>
            </ul>
        </div>
    </div>
    
    <div class="addProject projectsPageHead">
        <div class="container-fluid">
            <div id="OwlLinks" class="OwlLinks Owl">
                @foreach($data->categories as $category)
                <div class="item">
                    <a href="{{ URL::current().'?category_id='.$category->id }}" class="itemProject">
                        <h2 class="titleItem">{{ $category->title }}</h2>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="blog">
        <div class="container">
            <input type="hidden" name="cols" value="{{ \Session::has('user_id') ? \Session::get('user_id') : 0 }}">
            <div class="row">
                @foreach($data->data->data as $key => $blog)
                @if($key != 0 && $key%3 == 0)
                </div><div class="row">
                @endif
                    <div class="col-md-4">
                        <div class="itemBlog">
                            <a href="{{ URL::to('/blogs/' . $blog->id) }}" class="mask">
                                @if($blog->fileType == 'video')
                                <video>
                                  <source src="{{ $blog->photo }}" type="video/mp4">
                                </video>
                                @else
                                <img src="{{ $blog->photo }}" alt="" />
                                @endif
                            </a>
                            <div class="details">
                                <div class="date clearfix">
                                    <span class="time"><i class="fa fa-user"></i> {{ $blog->creator }}</span>
                                    <span class="time"><i class="flaticon-school-calendar"></i> {{ $blog->created_at }}</span>
                                    <span class="time"><i class="fa fa-eye"></i> {{ $blog->views }}</span>
                                </div>
                                <div class="paddingTitle">
                                    <a href="{{ URL::to('/blogs/' . $blog->id) }}" class="titleItem"> {{ $blog->title }} </a>
                                </div>
                                <div class="userDetails">
                                    <h2 class="author"><span>{{ $blog->category }}</span></h2>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @include('Partials.pagination')            
        </div>
    </div>
    
    {{-- <div class="join">
        <img src="{{ asset('/assets/images/bgJoin.png') }}" class="bg" alt="" />
        <div class="container">
            <div class="desc">
                {{ $data->pages[0]->title }}
            </div>
            <a href="{{ URL::to('/joinUs') }}" class="btnStyle">انضم الينا</a>
        </div>
    </div> --}}
@endsection

@section('modals')
@include('Partials.joinUsModal')
@endsection


@section('scripts')
<script src="{{ asset('/assets/js/joinUs.js') }}"></script>
@endsection
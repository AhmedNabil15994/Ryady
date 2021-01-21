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
        
    <div class="blog">
        <div class="container">
            <h2 class="titleBlog">مقالات الأعضاء</h2>
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
                            <span>{{ $blog->category }}</span>
                        </a>
                        <div class="details">
                            <div class="paddingTitle">
                                <a href="{{ URL::to('/blogs/' . $blog->id) }}" class="titleItem">{!! $blog->description2 !!}</a>
                            </div>
                            <div class="userDetails">
                                <img src="{{ $blog->creator_photo }}" alt="" />
                                <h2 class="author">نشر بواسطة <span>أ.{{ $blog->creator }}</span></h2>
                            </div>
                            <div class="date clearfix">
                                <span class="time"><i class="flaticon-school-calendar"></i> {{ $blog->created_at }}</span>
                                <a href="{{ URL::to('/blogs/' . $blog->id) }}" class="moreDetails">التفاصيل</a>
                            </div>
                        </div>
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
@extends('Layouts.master')

@section('title','التفاصيل')

@section('styles')
<style type="text/css" media="screen">
    .itemBlog .date span.moreDetails{
        margin-right: 15px;
        font-size: 16px;
        margin-top: 5px;
    }
</style>
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>المدونة</h2>
            <ul class="list-unstyled">
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li><a href="{{ URL::to('/blogs') }}">المدونة</a></li>
                <li class="active">{{ $data->data->title }}</li>
            </ul>
        </div>
    </div>
    
    <div class="postDetails">
        <div class="container">
            <div class="row">
                <div class="col-md-10 center-block">
                    <a href="#" class="mask" data-toggle="modal" data-target="#video">
                    @if($data->data->fileType == 'video')
                        <video>
                            <source src="{{ $data->data->photo }}" type="video/mp4">
                        </video>
                        <i class="flaticon-play"></i>
                    @else   
                        <img src="{{ $data->data->photo }}" alt="" />
                    @endif      
                    </a>
                    <div class="authorDetails clearfix">
                        <div class="user">
                            <img src="{{ $data->data->creator_photo }}" alt="" />
                            <span>نشر بواسطة</span>
                            <h3 class="name">{{ $data->data->creator }}</h3>
                        </div>
                        
                        <span class="date">{{ $data->data->created_at }} <i class="flaticon-school-calendar"></i></span>
                        <a href="#" class="btnProj">{{ $data->data->category }}</a>
                        <div class="share">
                            <span class="openShare">شارك الموضوع</span>
                            <ul class="listSocial">
                                <li><a href="{{ URL::current().'/shareBlog'.'/facebook' }}" target="_blank" class="facebook"><i class="fa fa-facebook"></i> Facebook</a></li>
                                <li><a href="{{ URL::current().'/shareBlog'.'/twitter' }}" target="_blank" class="twitter"><i class="fa fa-twitter"></i> Twitter</a></li>
                                <li><a href="{{ URL::current().'/shareBlog'.'/linkedin' }}" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i> LinkedIn</a></li>
                                @if(\Session::has('user_id')  && Session::has('username'))
                                <li><a href="https://api.whatsapp.com/send?phone={{ \App\Models\User::getOne(\Session::get('user_id'))->phone }}&text={{ URL::current() }}" target="_blank" class="whatsapp"><i class="fa fa-whatsapp"></i> Whatsapp</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    
                    <h2 class="titlePost">{{ $data->data->title }}</h2>
                    <div class="descPost">{!! $data->data->description !!}</div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="morePosts">
        <div class="container">
            <h2 class="titleMore">مواضيع ذات صلة</h2>
            <div class="sliderMore">
                <div id="OwlMore" class="OwlMore Owl">
                    @foreach($data->related as $blog)
                    <div class="item">
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
                                    <a href="{{ URL::to('/blogs/' . $blog->id) }}" class="titleItem">
                                        {{ $blog->title }}
                                    </a>
                                </div>
                                <div class="userDetails">
                                    <img src="{{ $blog->creator_photo }}" alt="" />
                                    <h2 class="author">نشر بواسطة <span>{{ $blog->creator }}</span></h2>
                                </div>
                                <div class="date clearfix">
                                    <span class="time"><i class="flaticon-school-calendar"></i> {{ $blog->created_at }}</span>
                                    <span class="moreDetails"><i class="fa fa-eye"></i> {{ $blog->views }}</span>
                                    <a href="{{ URL::to('/blogs/' . $blog->id) }}" class="moreDetails">التفاصيل</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
       
            
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
<script src="{{ asset('/assets/js/blogs.js') }}"></script>
@endsection
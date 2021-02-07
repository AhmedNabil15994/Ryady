@extends('Layouts.master')

@section('title','التفاصيل')

@section('styles')
<style type="text/css" media="screen">
    video{
        width: 100%;
        height: 100%;
    }
    .banner-image i {
        position: absolute;
        left: 25px;
        bottom: 25px;
        z-index: 2;
        width: 40px;
        height: 40px;
        line-height: 40px;
        background-color: #fff;
        border-radius: 50%;
        color: #8795AF;
        text-align: center;
        cursor: pointer;
    }
    .blog--date span a{
        color: inherit;
    }
</style>
@endsection

@section('content')    
    <section class="subject--section">
        <div class="view-blog">
            <div class="blog--banner">
                <div class="banner-overlay"></div>
                    @if($data->data->fileType == 'video')
                    <div class="banner-image" style="z-index: 2">
                        <video>
                            <source src="{{ $data->data->photo }}" type="video/mp4">
                        </video>
                        <i class="flaticon-play"></i>
                    @else   
                    <div class="banner-image">
                        <img src="{{ $data->data->photo }}" alt="" />
                    @endif    
                </div>
                <div class="author-info">
                    <div class="container">
                        <div class="blog--author">
                            <div class="author-img">
                                <img src="{{ $data->data->creator_photo }}" alt="">
                            </div>
                            <div class="author-name">
                                <h3>نشر بواسطه</h3>
                                <p>{{ $data->data->creator }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="blog-info">
                    <div class="blog--date">
                        <span>{{ $data->data->created_at }}</span>
                        <i class="flaticon-school-calendar"></i>
                    </div>
                    <div class="blog--title">{{ $data->data->title }}</div>
                    <div class="blog--desc">{!! $data->data->description !!}</div>
                </div>
            </div>

        </div>
        <div class="related-blog">
            <div class="container">
                <div class="title text-right">مواضيع ذات صله</div>
            </div>
            
            <div class="blog-slider">
                <div id="Owlblogs" class="owl-carousel owl-theme">
                    @foreach($data->related as $blog)
                    <div class="item">
                        <div class="blog-information white__theme">
                            <div class="image">
                                @if($blog->fileType == 'video')
                                <video>
                                    <source src="{{ $blog->photo }}" type="video/mp4">
                                </video>
                                @else
                                <img src="{{ $blog->photo }}" alt="" />
                                @endif
                            </div>
                            <div class="blog-title"> {{ $blog->title }}</div>
                            <div class="blog--author light__theme">
                                <div class="author-img">
                                    <img src="{{ $blog->creator_photo }}" alt="">
                                </div>
                                <div class="author-name">
                                    <h3>نشر بواسطه</h3>
                                    <p>{{ $blog->creator }}</p>
                                </div>
                            </div>
                            <div class="blog--date">
                                <span> {{ $blog->created_at }}</span>
                                <i class="flaticon-school-calendar"></i>
                                <span class="text-left">
                                    <a href="{{ URL::to('/blogs/' . $blog->id) }}" title="">التفاصيل</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script src="{{ asset('/assets/components/blogs.js') }}"></script>
@endsection
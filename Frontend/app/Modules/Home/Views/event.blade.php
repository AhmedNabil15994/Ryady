@extends('Layouts.master')

@section('title','تفاصيل الفعالية')

@section('styles')
<style type="text/css" media="screen">
    .formMembers{
        padding-top: 0;
        display: none;
    }
    .formMembers .formStyle{
        padding: 25px;
    }
</style>
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>تفاصيل الفعالية</h2>
            <ul class="list-unstyled">
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li class="active">{{ $data->data->title }}</li>
            </ul>
        </div>
    </div>

    <div class="project">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="author">
                        <img src="{{ $data->data->photo }}" alt="" />
                        <h2 class="title">{{ $data->data->title }}</h2>
                        <span class="new">{{ $data->data->price }} ر.س</span>
                        @if(Session::has('user_id') && Session::has('username'))
                        <a href="{{ URL::current().'/joinEvent' }}" class="new new2">انضم الي الفعالية</a>
                        @else
                        <a class="new new2 new3">انضم الي الفعالية</a>
                        @endif
                        <p><i class="flaticon-flag"></i>  {{ $data->data->type }}</p>
                        <p><i class="flaticon-school-calendar"></i> {{ $data->data->date }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="formMembers">
                        <form class="formStyle" method="POST" action="{{ URL::current() }}">
                            @csrf
                            <h2 class="title">نموذج انضمام الي الفعالية</h2>

                            <label for="" data-toggle="tooltip" data-placement="top" title="يرجي ادخال الاسم ثلاثي">اسمك بالعربي</label>
                            <input type="text" name="name_ar" value="{{ \Request::get('name_ar') }}" data-toggle="tooltip" data-placement="top" title="يرجي ادخال الاسم ثلاثي" class="inputStyle"/>

                            <label for="" data-toggle="tooltip" data-placement="top" title="يرجي ادخال الاسم ثلاثي">اسمك بالإنجليزي</label>
                            <input type="text" name="name_en" data-toggle="tooltip" data-placement="top" title="يرجي ادخال الاسم ثلاثي" value="{{ \Request::get('name_en') }}" class="inputStyle"/>

                            <label for="">حدد النوع</label>
                            <div class="selectStyle">
                                <select class="selectmenu" id="selectmenu2" name="gender">
                                    <option value="1">ذكر</option>
                                    <option value="2">انثي</option>
                                </select>
                                <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                            </div>

                            <label for="">البريد الالكتروني</label>
                            <input type="email" class="inputStyle" value="{{ \Request::get('email') }}" name="email"/>
                            <label for="">رقم الجوال</label>
                            <input type="text" class="inputStyle" value="{{ \Request::get('phone') }}" name="phone"/>
                            <label for="">كلمة المرور</label>
                            <input type="password" class="inputStyle" name="password"/>
                            <button class="btnForm" type="submit">ارسال الطلب</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
@endsection

@section('scripts')
<script src="{{ asset('/assets/js/event.js') }}" type="text/javascript"></script>   
@endsection
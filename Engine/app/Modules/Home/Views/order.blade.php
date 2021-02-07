@extends('Layouts.master')

@section('title','طلب خدمة')

@section('styles')
@endsection

@section('content')
    <div class="addProject">
        <div class="container">
            <div class="clearfix hidden-sm hidden-xs wow bounceIn">
                @foreach($data->data as $category)
                <a href="#" class="itemProject">
                    <i class="{{ $category->icon }}"></i>
                    <h2 class="titleItem">{{ $category->title }}</h2>
                </a>
                @endforeach
            </div>
            <div id="OwlProj" class="OwlProj visible-sm visible-xs Owl wow zoomIn">
                @foreach($data->data as $category)
                <div class="item">
                    <a href="#" class="itemProject">
                        <i class="{{ $category->icon }}"></i>
                        <h2 class="titleItem">{{ $category->title }}</h2>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="orderPage">
        <div class="container">
            <div class="row">
            <form class="col-md-8 center-block" method="POST" action="{{ URL::current() }}">
                @csrf
                <h2 class="title">نموذج طلب خدمة</h2>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="inputStyle" name="name" value="{{ old('name') }}" placeholder="الاسم :" />
                    </div>
                    <div class="col-md-6">
                        <input type="number" class="inputStyle" name="phone" value="{{ old('phone') }}" placeholder="رقم الجوال :" />
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="inputStyle" name="email" value="{{ old('email') }}" placeholder="البريد الالكتروني :" />
                    </div>
                    <div class="col-md-6">
                        <div class="selectStyle">
                            <select class="selectmenu" id="selectmenu" name="category_id">
                                <option value="" selected disabled>حدد نوع الخدمة :</option>
                                @foreach($data->data as $category)
                                <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>{{ $category->title }}</option>
                                @endforeach
                            </select>
                            <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                        </div>
                    </div>
                </div>
                <button class="btnStyle">ارسل الآن</button>
            </form>
        </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
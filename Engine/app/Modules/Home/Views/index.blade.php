@extends('Layouts.master')

@section('title','الرئيسية')

@section('styles')
@endsection

@section('content')

    <div class="usersHome">
        <h2 class="title clearfix">شبكة VIP <a href="#" class="plus flaticon-plus"></a></h2>
        <div id="Owlusers" class="Owlusers owl-carousel owl-theme">
            @foreach($data->userMembers2 as $userMember2)
            <div class="item">
                <div class="itemDiv" style="border-color: {{ $userMember2->color }}">
                    <img src="{{ $userMember2->user->photo }}" />
                </div>
            </div>
            @endforeach
        </div>
    </div>
        
    <div class="members">
        <div class="container">
            <h2 class="titleStyle">أعضاء الشاب الريادي</h2>
            <div class="row">
                @foreach($data->userMembers as $key => $userMember)
                <div class="col-xs-6">
                    <div class="item">
                        <img src="{{ $userMember->user->photo }}" alt="" />
                        <h2 class="name">أ.{{ $userMember->user->name_ar }} </h2>
                        <a href="#" class="btnItem" data-toggle="modal" data-area="{{ $userMember->user_id }}" data-target="#profile">الملف الشخصي</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
        
    <div class="addProject">
        <div class="container">
            <h2 class="titleStyle">أضف مشروعك</h2>
            <div class="row">
                @foreach($data->projectCategories as $key => $category)
                <div class="col-xs-6">
                    <a class="item">
                        <i class="icon {{ $category->icon }}"></i>
                        <h2 class="title">{{ $category->title }}</h2>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('scripts')
 <script src="{{ asset('/assets/components/profile.js') }}"></script>
@endsection
@extends('Layouts.master')

@section('title','العضويات')

@section('styles')
@endsection

@section('content')
    <section class="membership--section">
        <div class="memebership--menu">
            <ul class="btnsTabs" id="tabs">
                @foreach($data->memberships as $key => $membership)
                <li id="plan-{{ $membership->id }}" class="{{ $key == 0 ? 'active' : '' }}">{{ $membership->title }}</li>
                @endforeach
            </ul>
        </div>
        <div class="membership--content tabs">

            @foreach($data->memberships as $key => $membership)
            <div class="membership--body tab plan-{{ $membership->id }}">
                <img src="{{ $membership->photo }}" class="img" alt="" />
                <div class="membership--price text-center">
                    <p>{{ $membership->price }} </p> <p>ريال</p>
                    <span>لمده {{ $membership->periodText }}</span>
                </div>
                <center>
                    <div class="membership-controller">
                        <a href="{{ URL::to('/memberships/requestMemberShip/'.$membership->id) }}" class="btnMem">اطلبها الان</a>
                        <a href="{{ URL::to('/memberships/features/'.$membership->id) }}" class="btnMem">المميزات</a>
                    </div>
                </center>
            </div>
            @endforeach
        </div>

         <div class="membership--offer text-center">
            يمكنك الحصول علي بطاقه رقميه او مطبوعه برسوم اضافيه 100 ريال
        </div> 

    </section>
@endsection

@section('scripts')

@endsection
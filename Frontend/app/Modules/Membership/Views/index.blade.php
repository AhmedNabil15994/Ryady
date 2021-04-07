@extends('Layouts.master')

@section('title','العضويات')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>العضويات</h2>
            <ul class="list-unstyled">
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li class="active">العضويات</li>
            </ul>
        </div>
    </div>
{{--        
    <div class="AboutSection">
        <div class="container">
            @foreach($data->advantages as $key => $oneAdvantage)
            <div class="col-md-3">
                <div class="item wow {{ $key % 2 == 0 ? 'fadeInDown' : 'fadeInUp' }}">
                    <i class="{{ $oneAdvantage->icon }}"></i>
                    <h2 class="title">{{ $oneAdvantage->title }}</h2>
                    <div class="desc">
                        {{ $oneAdvantage->description }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <div class="methodology">
        <div class="container">
            <div class="imgDiv">
                <img src="{{ asset('/assets/images/iMac.png') }}" alt="" />
            </div>
            <div class="details">
                <h2 class="title">منهجيتنا</h2>
                <ul class="listLinks">
                    @foreach($data->benefits as $benefit)
                    <li><a href="#">{{ $benefit->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div --}}>
    </div>
    
    <div class="groupMembers">
        <div class="container">
            <h2 class="title">الفئة المستهدفة</h2>
            @foreach($data->targets as $target)
            <div class="item">
                <i class="{{ $target->icon }}"></i>
                <div class="desc">{{ $target->title }}</div>
            </div>
            @endforeach
        </div>
    </div>
    
    <div class="plans">
        <div class="container">
            <h2 class="titleStyle">العضويات</h2>
            <div class="row wow zoomInDown">
                @foreach($data->memberships as $membership)
                <div class="col-md-4">
                    <div class="item">
                        <h2 class="title mb-25">اشتراك سنوي للعضوية</h2>
                        <img src="{{ $membership->photo }}" />
                        <h2 class="title">{{ $membership->title }}</h2>
                        <span class="price {{ $membership->discount_price != null ? 'hasDisc' : '' }}"><span class="value">{{ $membership->price }}</span> ر.س</span>
                        <span class="price discPrice"> @if($membership->discount_price != null)<span class="value">{{ $membership->discount_price }}</span> ر.س @endif</span>
                        <a href="{{ URL::to('/memberships/requestMemberShip/'.$membership->id) }}" class="btnStyle">اطلبها الآن</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    
    <div class="features">
        <div class="container">
            <h2 class="titleStyle"><span>مميزات العضوية</span> الشاب الريادي Business Pro</h2>
            <div class="table-responsive">
                <table class="tableMemb">
                <thead>
                  <tr>
                    <th colspan="2">مزايا العضوية</th>
                    @foreach($data->memberships as $membership)
                    <th>{{ $membership->title }} <span>{{ $membership->price }}</span></th>
                    @endforeach
                  </tr>
              </thead>
              <tbody>
                    @foreach($data->features as $feature)
                    <tr>
                        <td>{{ $feature->title }}</td>
                        <td>{{ $feature->description }}</td>
                        @foreach($data->memberships as $membership)
                            @if(in_array($feature->id, $membership->features))
                                @if($feature->title == 'شهادة عضوية')
                                    @if($membership->id == 2)
                                    <td>الكترونية</td>
                                    @elseif($membership->id == 3)
                                    <td>مطبوعة</td>
                                    @endif
                                @else
                                <td><i class="fa fa-check"></i></td>
                                @endif
                            @else
                            <td><i class="flaticon-remove"></i></td>
                            @endif
                        @endforeach
                    </tr>
                    @endforeach
              </tbody>
            </table>
            </div>
            
        </div>
    </div>
@endsection

@section('scripts')

@endsection
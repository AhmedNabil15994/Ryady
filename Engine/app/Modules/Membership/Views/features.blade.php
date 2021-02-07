@extends('Layouts.master')

@section('title','مميزات العضويات')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>مميزات العضويات</h2>
            <ul class="list-unstyled">
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li class="active"> مميزات العضويات</li>
            </ul>
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
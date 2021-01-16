@extends('Layouts.master')

@section('title','الصفحة الرئيسية')

@section('styles')
@endsection

@section('content')
	<div class="slider">
    	<div class="containerSlider clearfix">
    		<img src="{{ asset('/assets/images/slider.png') }}" class="wow fadeInLeft" alt="" />
    		<h2 class="title wow fadeInRight">
    			{{ $data->pages[0]->title }}
				{!! $data->pages[0]->description !!}
					
			</h2>
    	</div>
    </div>
   
    <div class="AboutSection">
    	<div class="container">
    		<div class="row">
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
    </div>
    
    <div class="getCard">
    	<div class="container">
	        <div id="OwlCards" class="OwlCards Owl wow zoomIn">
	            @foreach($data->slider as $slider)
	            <div class="item">
	            	<div class="itemCard clearfix">
		            	<img src="{{ $slider->photo }}" alt="" />
		            	<div class="details">
		            		<h2 class="title">
			            		{{ $slider->title }}		            		
							</h2>
		            		<div class="desc">
		            			{{ $slider->description }}
		            		</div>
		            		<a href="{{ URL::to('/memberships/requestMemberShip/'.$slider->sort) }}" class="btnStyle">اطلبها الآن</a>
		            	</div>
	            	</div>
	            </div>
                @endforeach
	        </div>
       
       </div>
    </div>
    
    <div class="plans">
    	<div class="container">
    		<div class="row wow zoomInDown">
    			@foreach($data->memberships as $membership)
                <div class="col-md-4">
                    <div class="item">
                        <img src="{{ $membership->photo }}" />
                        <h2 class="title">عضوية {{ $membership->title }}</h2>
                        <span class="price">{{ $membership->price }} ريال</span>
                        <span class="time">لمدة {{ $membership->periodText }}</span>
                        <a href="{{ URL::to('/memberships/requestMemberShip/'.$membership->id) }}" class="btnStyle">اطلبها الآن</a>
                    </div>
                </div>
                @endforeach
    		</div>
    	</div>
    </div>
    
    <div class="members">
    	<div class="container">
    		<h2 class="title">{{ $data->pages[1]->title }}</h2>
    		<div class="row">
                @foreach($data->userMembers as $key => $userMember)
    			<div class="col-md-3 wow fadeInUp">
    				<div class="memb">
    					<img src="{{ $userMember->user->photo }}" />
    					<h2 class="name">أ.{{ $userMember->user->name_ar }}</h2>
    					<a href="#" class="btnStyle" data-toggle="modal" data-area="{{ $userMember->user_id }}" data-target="#profile">الملف الشخصي</a>
    				</div>
    			</div>
                @endforeach
    		</div>
    	</div>
    </div>
    
    <div class="membersVip">
    	<div class="container">
    		<div class="details">
	    		<h2 class="title">{{ $data->pages[2]->title }}</h2>
	    		<a href="#" class="btnStyle">انضم الينا الآن</a>
    		</div>
    		<div class="left  wow fadeInLeft">
    			<div class="desc">{!! $data->pages[2]->description !!}</div>
    			<div class="divImgs">
    				<ul class="imgs clearfix">
                        @foreach($data->userMembers2 as $userMember2)
    					<li><img src="{{ $userMember2->user->photo }}" alt="" /></li>
                        @endforeach
    				</ul>
    				<a href="#" class="flaticon-plus iconPlus"></a>
    			</div>
    		</div>
    		
    	</div>
    </div>
    
    <div class="addProject">
    	<div class="container">
    		<h2 class="title">{{ $data->pages[3]->title }}</h2>
    		<div class="desc">{!! $data->pages[3]->description !!}</div>
    		<div class="clearfix hidden-sm hidden-xs wow bounceIn">
                @foreach($data->projectCategories as $key => $category)
                @if(in_array($key, [0,1,2,3,4]))
    			<a href="#" class="itemProject">
    				<i class="{{ $category->icon }}"></i>
    				<h2 class="titleItem">{{ $category->title }}</h2>
    			</a>
                @endif
                @endforeach
    		</div>
			
	        <div id="OwlProj" class="OwlProj visible-sm visible-xs Owl wow zoomIn">
                @foreach($data->projectCategories as $key => $category)
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
@endsection

@section('scripts')
<script src="{{ asset('/assets/js/profile.js') }}"></script>
@endsection
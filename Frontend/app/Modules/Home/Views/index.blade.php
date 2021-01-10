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
		            		<a href="#" class="btnStyle">اطلبها الآن</a>
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
    			<div class="col-md-4">
    				<div class="item">
    					<img src="{{ asset('/assets/images/plan1.png') }}" />
    					<h2 class="title">عضوية منتسب</h2>
    					<span class="price">175 ريال</span>
    					<span class="time">لمدة سنة</span>
    					<a href="{{ URL::to('/requestMemberShip') }}" class="btnStyle">اطلبها الآن</a>
    				</div>
    			</div>
    			<div class="col-md-4">
    				<div class="item">
    					<img src="{{ asset('/assets/images/plan2.png') }}" />
    					<h2 class="title">عضوية طموح</h2>
    					<span class="price">250 ريال</span>
    					<span class="time">لمدة سنة</span>
    					<a href="{{ URL::to('/requestMemberShip') }}" class="btnStyle">اطلبها الآن</a>
    				</div>
    			</div>
    			<div class="col-md-4">
    				<div class="item">
    					<img src="{{ asset('/assets/images/plan3.png') }}" />
    					<h2 class="title">عضوية ريادي</h2>
    					<span class="price">357 ريال</span>
    					<span class="time">لمدة سنة</span>
    					<a href="{{ URL::to('/requestMemberShip') }}" class="btnStyle">اطلبها الآن</a>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="members">
    	<div class="container">
    		<h2 class="title">{{ $data->pages[1]->title }}</h2>
    		<div class="row">
    			<div class="col-md-3 wow fadeInUp">
    				<div class="memb">
    					<img src="{{ asset('/assets/images/memb1.png') }}" />
    					<h2 class="name">أ.عبدالله بن مساعد</h2>
    					<a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
    				</div>
    			</div>
    			<div class="col-md-3 wow fadeInUp">
    				<div class="memb">
    					<img src="{{ asset('/assets/images/memb2.png') }}" />
    					<h2 class="name">أ.عبدالله بن مساعد</h2>
    					<a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
    				</div>
    			</div>
      			<div class="col-md-3 wow fadeInUp">
    				<div class="memb">
    					<img src="{{ asset('/assets/images/memb3.png') }}" />
    					<h2 class="name">أ.عبدالله بن مساعد</h2>
    					<a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
    				</div>
    			</div>
    			<div class="col-md-3 wow fadeInUp">
    				<div class="memb">
    					<img src="{{ asset('/assets/images/memb4.png') }}" />
    					<h2 class="name">أ.عبدالله بن مساعد</h2>
    					<a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
    				</div>
    			</div>
    			<div class="col-md-3 wow fadeInUp">
    				<div class="memb">
    					<img src="{{ asset('/assets/images/memb5.png') }}" />
    					<h2 class="name">أ.عبدالله بن مساعد</h2>
    					<a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
    				</div>
    			</div>
    			<div class="col-md-3 wow fadeInUp">
    				<div class="memb">
    					<img src="{{ asset('/assets/images/memb6.png') }}" />
    					<h2 class="name">أ.عبدالله بن مساعد</h2>
    					<a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
    				</div>
    			</div>
      			<div class="col-md-3 wow fadeInUp">
    				<div class="memb">
    					<img src="{{ asset('/assets/images/memb7.png') }}" />
    					<h2 class="name">أ.عبدالله بن مساعد</h2>
    					<a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
    				</div>
    			</div>
    			<div class="col-md-3 wow fadeInUp">
    				<div class="memb">
    					<img src="{{ asset('/assets/images/memb8.png') }}" />
    					<h2 class="name">أ.عبدالله بن مساعد</h2>
    					<a href="#" class="btnStyle" data-toggle="modal" data-target="#profile">الملف الشخصي</a>
    				</div>
    			</div>
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
    					<li><img src="{{ asset('/assets/images/memb1.png') }}" alt="" /></li>
    					<li><img src="{{ asset('/assets/images/memb2.png') }}" alt="" /></li>
    					<li><img src="{{ asset('/assets/images/memb3.png') }}" alt="" /></li>
    					<li><img src="{{ asset('/assets/images/memb4.png') }}" alt="" /></li>
    					<li><img src="{{ asset('/assets/images/memb5.png') }}" alt="" /></li>
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
    			<a href="#" class="itemProject">
    				<i class="flaticon-hospital"></i>
    				<h2 class="titleItem">مستشفيات وعيادات</h2>
    			</a>
    			<a href="#" class="itemProject">
    				<i class="flaticon-restaurant"></i>
    				<h2 class="titleItem">مطاعم وكافيهات</h2>
    			</a>
    			<a href="#" class="itemProject">
    				<i class="flaticon-running"></i>
    				<h2 class="titleItem">رياضة وترفيه</h2>
    			</a>
    			<a href="#" class="itemProject">
    				<i class="flaticon-store"></i>
    				<h2 class="titleItem">متاجر الكترونية</h2>
    			</a>
    			<a class="itemProject">
    				<i class="flaticon-presentation"></i>
    				<h2 class="titleItem">مدارس ومراكز تعليم</h2>
    			</a>
    		</div>
			
	        <div id="OwlProj" class="OwlProj visible-sm visible-xs Owl wow zoomIn">
	            <div class="item">
	    			<a href="#" class="itemProject">
	    				<i class="flaticon-hospital"></i>
	    				<h2 class="titleItem">مستشفيات وعيادات</h2>
	    			</a>
	            </div>
	            <div class="item">
	    			<a href="#" class="itemProject">
	    				<i class="flaticon-restaurant"></i>
	    				<h2 class="titleItem">مطاعم وكافيهات</h2>
	    			</a>
	            </div>
	            <div class="item">
	    			<a href="#" class="itemProject">
	    				<i class="flaticon-running"></i>
	    				<h2 class="titleItem">رياضة وترفيه</h2>
	    			</a>
	            </div>
	            <div class="item">
	    			<a href="#" class="itemProject">
	    				<i class="flaticon-store"></i>
	    				<h2 class="titleItem">متاجر الكترونية</h2>
	    			</a>
	            </div>
	            <div class="item">
	    			<a href="#" class="itemProject">
	    				<i class="flaticon-presentation"></i>
	    				<h2 class="titleItem">مدارس ومراكز تعليم</h2>
	    			</a>
	            </div>
	        </div>
    	</div>
    </div>
@endsection

@section('scripts')

@endsection
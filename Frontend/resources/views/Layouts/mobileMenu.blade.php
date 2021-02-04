<div class="menuMobile">
	<div class="BgClose"></div>
	<div class="menuContent">
		<div class="headMenu">
			<a href="{{ URL::to('/') }}" data-scroll-nav="1" class="logoMenu"><img src="{{ asset('/assets/images/logo.png') }}" alt="" /></a>
			<i class="fa fa-close closeX"></i>
		</div>
		<ul class="menuRes">
			@php
			$sideMenu = \App\Models\SideMenu::NotDeleted()->where('status',1)->orderBy('sort','ASC')->get();
			@endphp
			@foreach($sideMenu as $key => $item)
		        @if($item->link != '')
		          	@if($item->link == '#login')
		        		@if(\Session::has('user_id')  && Session::has('username'))
		        			<li><a href="{{ URL::to('/profile') }}" >الملف الشخصي</a></li>
		        			<li><a href="{{ URL::to('/profile/logout') }}" >تسجيل الخروج</a></li>
		        		@else
				          	<li><a href="#" data-toggle="modal" data-target="{{ $item->link }}">{{ $item->title }}</a></li>
		        		@endif
		        	@else
		          	<li><a href="#" data-toggle="modal" data-target="{{ $item->link }}">{{ $item->title }}</a></li>
		        	@endif
		        @else
		          	@if($item->id == 1)
		          	<li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
		          	@elseif($item->id == 2)
					<li><a href="{{ URL::to('/blogs') }}">المدونة</a></li>
		          	@elseif($item->id == 3)
		          	<li><a href="{{ URL::to('/vip') }}">شبكة  VIP</a></li>
		          	@elseif($item->id == 5)
		          	<li><a href="{{ URL::to('/memberships') }}">العضويات</a></li>
		          	@elseif($item->id == 6)
		          		@if(\Session::has('user_id')  && Session::has('username') )
		          		<li><a href="{{ URL::to('/profile/addProject') }}">اضف مشروعك</a></li>
		          		@endif
		          	@elseif($item->id == 7)
		          	<li><a href="{{ URL::to('/order') }}">طلب خدمة</a></li>
		          	@elseif($item->id == 8)
		          	<li><a href="{{ URL::to('/contactUs') }}">الاتصال بنا</a></li>
		          	@elseif($item->id == 9)
		          	<li><a href="{{ URL::to('/memberships/features') }}">مميزات العضوية</a></li>
		          	@elseif($item->id == 10)
					<li><a href="{{ URL::to('/projects') }}">مشاريع الاعضاء</a></li>
		          	@elseif($item->id == 11)
		          	<li><a href="{{ URL::to('/members') }}">أعضاء الشاب الريادي</a></li>
		          	@endif
		        @endif
		    @endforeach
		</ul>
	</div>
</div>
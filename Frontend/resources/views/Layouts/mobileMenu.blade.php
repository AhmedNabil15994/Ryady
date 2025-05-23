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
			@if(\Session::has('user_id')  && Session::has('username'))
		        <li><a href="{{ URL::to('/profile') }}" >{{ \App\Models\User::getOne(\Session::get('user_id'))->name_ar }}</a></li>
		    @endif
			@foreach($sideMenu as $key => $item)
		        @if($item->link != '')
		          	@if($item->link == '#login')
		        		@if(\Session::has('user_id')  && Session::has('username'))
		        			<li><a href="{{ URL::to('/profile/logout') }}" >تسجيل الخروج</a></li>
		        		@else
				          	<li><a href="#" data-toggle="modal" data-target="{{ $item->link }}">{{ $item->title }}</a></li>
		        		@endif
		        	@else
		          	<li><a href="#" data-toggle="modal" data-target="{{ $item->link }}">{{ $item->title }}</a></li>
		        	@endif
		        @else
		          	@if($item->id == 1)
		          	<li><a href="{{ URL::to('/') }}">{{ $item->title }}</a></li>
		          	@elseif($item->id == 2)
					<li><a href="{{ URL::to('/blogs') }}">{{ $item->title }}</a></li>
		          	@elseif($item->id == 3)
		          	<li><a href="{{ URL::to('/vip') }}">{{ $item->title }}</a></li>
		          	@elseif($item->id == 5)
		          	<li><a href="{{ URL::to('/memberships') }}">{{ $item->title }}</a></li>
		          	@elseif($item->id == 14)
		          	<li><a href="{{ URL::to('/events') }}">{{ $item->title }}</a></li>
		          	@elseif($item->id == 6)
		          		@if(\Session::has('user_id')  && Session::has('username') )
		          		<li><a href="{{ URL::to('/profile/addProject') }}">{{ $item->title }}</a></li>
		          		@endif
		          	@elseif($item->id == 7)
		          	<li><a href="{{ URL::to('/order') }}">{{ $item->title }}</a></li>
		          	@elseif($item->id == 8)
		          	<li><a href="{{ URL::to('/contactUs') }}">{{ $item->title }}</a></li>
		          	@elseif($item->id == 9)
		          	<li><a href="{{ URL::to('/memberships/features') }}">{{ $item->title }}</a></li>
		          	@elseif($item->id == 10)
					<li><a href="{{ URL::to('/projects') }}">{{ $item->title }}</a></li>
		          	@elseif($item->id == 11)
		          	<li><a href="{{ URL::to('/members') }}">{{ $item->title }}</a></li>
		          	@elseif($item->id == 13)
		          	<li><a href="{{ URL::to('/whoUs') }}">{{ $item->title }}</a></li>
		          	@endif
		        @endif
		    @endforeach
		</ul>
	</div>
</div>
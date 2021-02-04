<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<ul class="linksFooter clearfix">
					@php 
				    $bottomMenu = \App\Models\BottomMenu::NotDeleted()->where('status',1)->orderBy('sort','ASC')->get();
				    @endphp
					@foreach($bottomMenu as $key => $item)
				        @if($item->link != '')
				        	@if($item->link == '#login')
				        		@if(\Session::has('user_id')  && Session::has('username'))
				        			<li><a href="{{ URL::to('/profile') }}" >الملف الشخصي</a></li>
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
				          	@elseif($item->id == 6)
		          				@if(\Session::has('user_id')  && Session::has('username'))
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
				          	@endif
				        @endif
				    @endforeach
				</ul>
			</div>
			<div class="col-md-3">
				<div class="followUs">
					<h2 class="titleFollow">تابعنا هنا</h2>
					<ul class="socialFooter clearfix">
						<li><a href="{{ \App\Models\Variable::getVar('رابط الفيس بوك:') }}" target="_blank" class="fa fa-facebook"></a></li>
						<li><a href="{{ \App\Models\Variable::getVar('رابط السناب شات:') }}" target="_blank" class="fa fa-snapchat"></a></li>
						<li><a href="{{ \App\Models\Variable::getVar('رابط تويتر:') }}" target="_blank" class="fa fa-twitter"></a></li>
						<li><a href="{{ \App\Models\Variable::getVar('رابط يوتيوب:') }}" target="_blank" class="fa fa-youtube"></a></li>
						<li><a href="{{ \App\Models\Variable::getVar('رابط انستجرام:') }}" target="_blank" class="fa fa-instagram"></a></li>
					</ul>
				</div>
				<a href="{{ \App\Models\Variable::getVar('رابط ال ios:') }}" target="_blank" class="mob"><img src="{{ asset('/assets/images/logoApple.png') }}" /></a>
				<a href="{{ \App\Models\Variable::getVar('رابط الاندرويد:') }}" target="_blank" class="mob"><img src="{{ asset('/assets/images/logoGoogle.png') }}" /></a>
			</div>
		</div>
	</div>
	<div class="footerDown">
		<div class="container clearfix">
			<a href="https://servers.com.sa/" class="logoServers2 wow fadeInLeft"><img src="{{ asset('/assets/images/logoServers.png') }}" /></a>
			<p class="copyRights text-center">© {{ date('Y') }} جميع الحقوق محفوظة لبرنامج الشاب الريادي </p>
			<a href="https://businesspro.sa/" class="logoServers wow fadeInRight"><img src="{{ asset('/assets/images/BP.svg') }}" /></a>
			<div class="clearfix"></div>
		</div>
	</div>
</div>	    
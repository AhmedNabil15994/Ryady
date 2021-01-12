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
				          <li><a href="#" data-toggle="modal" data-target="{{ $item->link }}">{{ $item->title }}</a></li>
				        @else
				          	@if($item->id == 1)
				          	<li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
				          	@elseif($item->id == 2)
							<li><a href="{{ URL::to('/blogs') }}">المدونة</a></li>
				          	@elseif($item->id == 3)
				          	<li><a href="{{ URL::to('/vip') }}">شبكة  VIP</a></li>
				          	@elseif($item->id == 5)
				          	<li><a href="{{ URL::to('/memberShip') }}">العضويات</a></li>
				          	@elseif($item->id == 6)
				          	<li><a href="{{ URL::to('/addProject') }}">اضف مشروعك</a></li>
				          	@elseif($item->id == 7)
				          	<li><a href="{{ URL::to('/order') }}">طلب خدمة</a></li>
				          	@elseif($item->id == 9)
				          	<li><a href="{{ URL::to('/packageFeatures') }}">مميزات العضوية</a></li>
				          	@elseif($item->id == 10)
							<li><a href="{{ URL::to('/membersProjects') }}">مشاريع الاعضاء</a></li>
				          	@elseif($item->id == 11)
				          	<li><a href="{{ URL::to('/members') }}">أعضاء الشاب الريادي</a></li>
				          	@endif
				        @endif
				    @endforeach
				</ul>
			</div>
			<div class="col-md-3">
				<div class="followUs">
					<h2 class="titleFollow">تابعنا هنا</h2>
					<ul class="socialFooter clearfix">
						<li><a href="#" class="fa fa-facebook"></a></li>
						<li><a href="#" class="fa fa-snapchat"></a></li>
						<li><a href="#" class="fa fa-twitter"></a></li>
						<li><a href="#" class="fa fa-youtube"></a></li>
						<li><a href="#" class="fa fa-instagram"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="footerDown">
		<div class="container clearfix">
			<span class="dowloadTitle">حمل التطبيق</span>
			<a href="#" class="mob"><img src="{{ asset('/assets/images/logoApple.png') }}" /></a>
			<a href="#" class="mob"><img src="{{ asset('/assets/images/logoGoogle.png') }}" /></a>
			<p class="copyRights">© {{ date('Y') }} جميع الحقوق محفوظة للشاب الريادي</p>
			<a href="#" class="logoServers wow fadeInLeft"><img src="{{ asset('/assets/images/logoServers.png') }}" /></a>
		</div>
	</div>
</div>	    
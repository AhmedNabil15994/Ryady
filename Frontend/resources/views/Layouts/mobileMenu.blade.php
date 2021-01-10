<div class="menuMobile">
	<div class="BgClose"></div>
	<div class="menuContent">
		<div class="headMenu">
			<a href="{{ URL::to('/') }}" data-scroll-nav="1" class="logoMenu"><img src="{{ asset('/assets/images/logo.png') }}" alt="" /></a>
			<i class="fa fa-close closeX"></i>
		</div>
		<ul class="menuRes">
			@foreach($data->sideMenu as $key => $item)
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
</div>
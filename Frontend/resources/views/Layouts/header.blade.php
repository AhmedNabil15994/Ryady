<header class="header">
  <div class="container-fluid">
    <i class="iconMenu">
      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="22" viewBox="0 0 30 22">
        <g id="Group_1166" data-name="Group 1166" transform="translate(-31 -40)">
          <rect id="Rectangle_2210" data-name="Rectangle 2210" width="5" height="2" transform="translate(31 40)" fill="#a7abad"/>
          <rect id="Rectangle_2211" data-name="Rectangle 2211" width="20" height="2" transform="translate(41 40)" fill="#fff"/>
          <rect id="Rectangle_2212" data-name="Rectangle 2212" width="5" height="2" transform="translate(31 50)" fill="#a7abad"/>
          <rect id="Rectangle_2213" data-name="Rectangle 2213" width="20" height="2" transform="translate(41 50)" fill="#fff"/>
          <rect id="Rectangle_2214" data-name="Rectangle 2214" width="5" height="2" transform="translate(31 60)" fill="#a7abad"/>
          <rect id="Rectangle_2215" data-name="Rectangle 2215" width="20" height="2" transform="translate(41 60)" fill="#fff"/>
        </g>
      </svg>
    </i>
    <a href="#" class="login"  data-toggle="modal" data-target="#login">تسجيل الدخول</a>
    <ul class="links">
      @foreach($data->topMenu as $key => $item)
        @if($item->link != '')
          @if($item->link != '#login')
          <li><a href="#" data-toggle="modal" data-target="{{ $item->link }}">{{ $item->title }}</a></li>
          @endif
        @else
          @if($item->id == 1)
          <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
          @elseif($item->id == 2)
          <li><a href="{{ URL::to('/memberShip') }}">العضويات</a></li>
          @elseif($item->id == 3)
          <li><a href="{{ URL::to('/members') }}">الشركاء</a></li>
          @elseif($item->id == 4)
          <li><a href="{{ URL::to('/blogs') }}">المدونة</a></li>
          @elseif($item->id == 5)
          <li><a href="{{ URL::to('/contactUs') }}">اتصل بنا</a></li>
          @elseif($item->id == 6)
          <li><a href="{{ URL::to('/addProject') }}">أضف مشروعك</a></li>
          @endif
        @endif
      @endforeach
    </ul>
      <a href="{{ URL::to('/') }}" class="logo"><img src="{{ asset('/assets/images/logo.png') }}" /></a>              
  </div>
</header>
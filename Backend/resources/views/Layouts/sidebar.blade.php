<!--begin::Aside-->
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
	<!--begin::Brand-->
	<div class="brand flex-column-auto" id="kt_brand">
		<!--begin::Logo-->
		<a href="index.html" class="brand-logo">
			<img alt="Logo" src="{{ asset('/assets/images/logoServers.png') }}" />
		</a>
		<!--end::Logo-->
		<!--begin::Toggle-->
		<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
			<span class="svg-icon svg-icon svg-icon-xl">
				<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
						<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</button>
		<!--end::Toolbar-->
	</div>
	<!--end::Brand-->
	<!--begin::Aside Menu-->
	<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
		<!--begin::Menu Container-->
		<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
			<!--begin::Menu Nav-->
			<ul class="menu-nav">
                <li class="menu-item {{ Active(URL::to('/')) }}" aria-haspopup="true">
                    <a href="{{ URL::to('/') }}" class="menu-link ">
                        <i class="menu-icon flaticon-dashboard"></i>
                        <span class="menu-text">الرئيسية</span>
                    </a>
                </li>

                @if(\Helper::checkRules('list-pages,list-sliders,list-advantages,list-benefits,list-cities,list-targets'))
                <li class="menu-item menu-item-submenu {{ Active(URL::to('/ourAdvantages*'),'menu-item-open active') }} {{ Active(URL::to('/benefits*'),'menu-item-open active') }} {{ Active(URL::to('/cities*'),'menu-item-open active') }} {{ Active(URL::to('/pages*'),'menu-item-open active') }} {{ Active(URL::to('/slider*'),'menu-item-open active') }} {{ Active(URL::to('/targets*'),'menu-item-open active') }}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon flaticon-home-2"></i>
                        <span class="menu-text">الواجهة الرئيسية</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="80">
                        <span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">الواجهة الرئيسية</span>
                                </span>
                            </li>
                            @if(\Helper::checkRules('list-pages'))
                            <li class="menu-item {{ Active(URL::to('/pages*')) }} " aria-haspopup="true">
                                <a href="{{ URL::to('/pages') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">الصفحات</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-sliders'))
                            <li class="menu-item {{ Active(URL::to('/sliders*')) }} " aria-haspopup="true">
                                <a href="{{ URL::to('/sliders') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">الاسلايدر</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-advantages'))
                            <li class="menu-item {{ Active(URL::to('/ourAdvantages*')) }} " aria-haspopup="true">
                                <a href="{{ URL::to('/ourAdvantages') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">مميزاتنا</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-benefits'))
                            <li class="menu-item {{ Active(URL::to('/benefits*')) }} " aria-haspopup="true">
                                <a href="{{ URL::to('/benefits') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">منهجيتنا</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-targets'))
                            <li class="menu-item {{ Active(URL::to('/targets*')) }} " aria-haspopup="true">
                                <a href="{{ URL::to('/targets') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">الفئة المستهدفة</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-cities'))
                            <li class="menu-item {{ Active(URL::to('/cities*')) }} " aria-haspopup="true">
                                <a href="{{ URL::to('/cities') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">المدن</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(\Helper::checkRules('list-topMenus,list-bottomMenus,list-sideMenus'))
                <li class="menu-item menu-item-submenu {{ Active(URL::to('/topMenu*'),'menu-item-open active') }} {{ Active(URL::to('/bottomMenu*'),'menu-item-open active') }} {{ Active(URL::to('/sideMenu*'),'menu-item-open active') }}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon flaticon-menu-1"></i>
                        <span class="menu-text">القوائم</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="80">
                        <span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">القوائم</span>
                                </span>
                            </li>
                            @if(\Helper::checkRules('list-topMenus'))
                            <li class="menu-item {{ Active(URL::to('/topMenu*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/topMenu') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">القوائم العلوية</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-bottomMenus'))
                            <li class="menu-item {{ Active(URL::to('/bottomMenu*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/bottomMenu') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">القوائم السفلية</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-sideMenus'))
                            <li class="menu-item {{ Active(URL::to('/sideMenu*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/sideMenu') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">القوائم الجانبية</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(\Helper::checkRules('list-contactUs'))
                <li class="menu-item menu-item-submenu {{ Active(URL::to('/contactUs*'),'menu-item-open active') }}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon flaticon-email"></i>
                        <span class="menu-text">الاتصال بنا</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="80">
                        <span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">الاتصال بنا</span>
                                </span>
                            </li>
                            <li class="menu-item {{ Active(URL::to('/contactUs*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/contactUs') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">الاتصال بنا</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if(\Helper::checkRules('list-memberships,list-features'))
                <li class="menu-item menu-item-submenu {{ Active(URL::to('/memberships*'),'menu-item-open active') }} {{ Active(URL::to('/features*'),'menu-item-open active') }}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon far fa-id-card"></i>
                        <span class="menu-text">العضويات</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="80">
                        <span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">العضويات</span>
                                </span>
                            </li>
                            @if(\Helper::checkRules('list-memberships'))
                            <li class="menu-item {{ Active(URL::to('/memberships*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/memberships') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">العضويات</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-features'))
                            <li class="menu-item {{ Active(URL::to('/features*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/features') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">مميزات العضويات</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(\Helper::checkRules('list-user-cards,list-user-requests,list-user-certificates,list-card-promotion'))
                <li class="menu-item menu-item-submenu {{ Active(URL::to('/userCards*'),'menu-item-open active') }} {{ Active(URL::to('/userRequests*'),'menu-item-open active') }} {{ Active(URL::to('/cardPromotions*'),'menu-item-open active') }} {{ Active(URL::to('/userCertificates*'),'menu-item-open active') }}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon far fa-credit-card"></i>
                        <span class="menu-text">بطاقات الاعضاء</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="80">
                        <span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">بطاقات الاعضاء</span>
                                </span>
                            </li>
                            @if(\Helper::checkRules('list-user-cards'))
                            <li class="menu-item {{ Active(URL::to('/userCards*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/userCards') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">بطاقات الاعضاء</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-user-requests'))
                            <li class="menu-item {{ Active(URL::to('/userRequests*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/userRequests') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">طلبات البطاقة المطبوعة</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-card-promotions'))
                            <li class="menu-item {{ Active(URL::to('/cardPromotions*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/cardPromotions') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">ترقيات البطاقات</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-user-certificates'))
                            <li class="menu-item {{ Active(URL::to('/userCertificates*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/userCertificates') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">شهادات العضوية</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(\Helper::checkRules('list-user-members'))
                <li class="menu-item menu-item-submenu {{ Active(URL::to('/userMembers*'),'menu-item-open active') }}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon fa fa-user-tie"></i>
                        <span class="menu-text">اعضاء الشاب الريادي</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="80">
                        <span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">اعضاء الشاب الريادي</span>
                                </span>
                            </li>
                            <li class="menu-item {{ Active(URL::to('/userMembers*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/userMembers') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">اعضاء الشاب الريادي</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if(\Helper::checkRules('list-orders,list-order-categories'))
                <li class="menu-item menu-item-submenu {{ Active(URL::to('/orders*'),'menu-item-open active') }} {{ Active(URL::to('/orderCategories*'),'menu-item-open active') }}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon flaticon2-rectangular"></i>
                        <span class="menu-text">طلبات الخدمات</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="80">
                        <span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">طلبات الخدمات</span>
                                </span>
                            </li>
                            @if(\Helper::checkRules('list-orders'))
                            <li class="menu-item {{ Active(URL::to('/orders*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/orders') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">طلبات خدمات الاعضاء</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-order-categories'))
                            <li class="menu-item {{ Active(URL::to('/orderCategories*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/orderCategories') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">تصنيفات الخدمات</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(\Helper::checkRules('list-projects,list-project-categories'))
                <li class="menu-item menu-item-submenu {{ Active(URL::to('/projects*'),'menu-item-open active') }} {{ Active(URL::to('/projectCategories*'),'menu-item-open active') }}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon fas fa-project-diagram"></i>
                        <span class="menu-text">مشاريع الاعضاء</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="80">
                        <span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">مشاريع الاعضاء</span>
                                </span>
                            </li>
                            @if(\Helper::checkRules('list-projects'))
                            <li class="menu-item {{ Active(URL::to('/projects*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/projects') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">مشاريع الاعضاء</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-project-categories'))
                            <li class="menu-item {{ Active(URL::to('/projectCategories*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/projectCategories') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">تصنيفات المشاريع</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(\Helper::checkRules('list-blogs,list-blog-categories'))
                <li class="menu-item menu-item-submenu {{ Active(URL::to('/blogs*'),'menu-item-open active') }} {{ Active(URL::to('/blogCategories*'),'menu-item-open active') }}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon fas fa-blog"></i>
                        <span class="menu-text">المدونة</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="80">
                        <span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">المدونة</span>
                                </span>
                            </li>
                            @if(\Helper::checkRules('list-blogs'))
                            <li class="menu-item {{ Active(URL::to('/blogs*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/blogs') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">المدونة</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-blog-categories'))
                            <li class="menu-item {{ Active(URL::to('/blogCategories*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/blogCategories') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">تصنيفات المدونة</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(\Helper::checkRules('list-coupons'))
                <li class="menu-item menu-item-submenu {{ Active(URL::to('/coupons*'),'menu-item-open active') }}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon fa fa-tag"></i>
                        <span class="menu-text">كوبونات الخصم</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="80">
                        <span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">كوبونات الخصم</span>
                                </span>
                            </li>
                            <li class="menu-item {{ Active(URL::to('/coupons*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/coupons') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">كوبونات الخصم</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if(\Helper::checkRules('list-groups,list-users,list-logs'))
                <li class="menu-item menu-item-submenu {{ Active(URL::to('/groups*'),'menu-item-open active') }} {{ Active(URL::to('/users*'),'menu-item-open active') }} {{ Active(URL::to('/logs*'),'menu-item-open active') }}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon flaticon-users"></i>
                        <span class="menu-text">المشرفين والاداريين</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="80">
                        <span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">المشرفين والاداريين</span>
                                </span>
                            </li>
                            @if(\Helper::checkRules('list-groups'))
                            <li class="menu-item {{ Active(URL::to('/groups*')) }} " aria-haspopup="true">
                                <a href="{{ URL::to('/groups') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">مجموعات المشرفين</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-users'))
                            <li class="menu-item {{ Active(URL::to('/users*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/users') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">المشرفين والاداريين</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-logs'))
                            <li class="menu-item {{ Active(URL::to('/logs*')) }} " aria-haspopup="true">
                                <a href="{{ URL::to('/logs') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">سجلات الدخول للنظام</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(\Helper::checkRules('list-variables,list-blockedUsers'))
                <li class="menu-item menu-item-submenu {{ Active(URL::to('/generalSettings*'),'menu-item-open active') }} {{ Active(URL::to('/panelSettings*'),'menu-item-open active') }} {{ Active(URL::to('/blockedUsers*'),'menu-item-open active') }}" aria-haspopup="true" data-menu-toggle="hover">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon flaticon-settings-1"></i>
                        <span class="menu-text">ادارة النظام</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu" kt-hidden-height="80">
                        <span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item  menu-item-parent" aria-haspopup="true">
                                <span class="menu-link">
                                    <span class="menu-text">ادارة النظام</span>
                                </span>
                            </li>
                            @if(\Helper::checkRules('list-variables'))
                            <li class="menu-item {{ Active(URL::to('/generalSettings*')) }}" aria-haspopup="true">
                                <a href="{{ URL::to('/generalSettings') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">اعدادات عامة</span>
                                </a>
                            </li>
                            <li class="menu-item {{ Active(URL::to('/panelSettings*')) }} " aria-haspopup="true">
                                <a href="{{ URL::to('/panelSettings') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">اعدادات لوحة التحكم</span>
                                </a>
                            </li>
                            @endif
                            @if(\Helper::checkRules('list-blockedUsers'))
                            <li class="menu-item {{ Active(URL::to('/blockedUsers*')) }} " aria-haspopup="true">
                                <a href="{{ URL::to('/blockedUsers') }}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"></i>
                                    <span class="menu-text">الاعضاء المحظورة</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif
                <li class="menu-item {{ Active(URL::to('/logout/')) }}" aria-haspopup="true">
                    <a href="{{ URL::to('/logout/') }}" class="menu-link ">
                        <i class="menu-icon flaticon-logout"></i>
                        <span class="menu-text">تسجيل الخروج</span>
                    </a>
                </li>
            </ul>
			<!--end::Menu Nav-->
		</div>
		<!--end::Menu Container-->
	</div>
	<!--end::Aside Menu-->
</div>
<!--end::Aside-->
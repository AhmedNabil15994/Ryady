@extends('Layouts.master')

@section('title','التفاصيل')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>المدونة</h2>
            <ul class="list-unstyled">
                <li class="active"><a href="index.html">الرئيسية</a></li>
                <li><a href="#">المدونة</a></li>
                <li>ما هو مفهوم دراسة الجدوى وكيفية انشائها</li>
            </ul>
        </div>
    </div>
    
    <div class="postDetails">
        <div class="container">
            <div class="row">
                <div class="col-md-10 center-block">
                    <a href="#" class="mask" data-toggle="modal" data-target="#video">
                        <img src="{{ asset('/assets/images/postImg.png') }}" alt="" />
                        <i class="flaticon-play"></i>
                    </a>
                    <div class="authorDetails clearfix">
                        <div class="user">
                            <img src="{{ asset('/assets/images/memb1.png') }}" alt="" />
                            <span>نشر بواسطة</span>
                            <h3 class="name">أ.عبدالله بن مساعد</h3>
                        </div>
                        
                        <span class="date">2020 - 06 - 23 <i class="flaticon-school-calendar"></i></span>
                        <a href="#" class="btnProj">المشاريع</a>
                        <div class="share">
                            <span class="openShare">شارك الموضوع</span>
                            <ul class="listSocial">
                                <li><a href="#" class="facebook"><i class="fa fa-facebook"></i> Facebook</a></li>
                                <li><a href="#" class="twitter"><i class="fa fa-twitter"></i> Twitter</a></li>
                                <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i> LinkedIn</a></li>
                                <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i> Google+</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <h2 class="titlePost">ما هو مفهوم دراسة الجدوى وكيفية انشائها</h2>
                    <div class="descPost">
                        تعرف دراسة الجدوى (بالإنجليزية: Feasibility Study) بأنها تحليل لمشروع مقترح وتقييمه لتحديد ما إذا كان مجدي من النواحي المادية سواء بالربح المتوقع أو التكلفة، والتقنية، حيث يتم إجراء هذه الدراسات في المشاريع التي تتطلب مبالغ مالية كبيرة،[١]وذلك لحصر إيجابيات وسلبيات المشروع قبل استثمار الكثير من المال والوقت فيه، حيث توفر دراسة الجدوى معلومات مهمة للشركات يمكن أن تمنعهم من الدخول بشكل أعمى في أعمال محفوفة بالمخاطر
                        <br><br>
                        تهدف دراسة الجدوى بشكل رئيسي إلى الفهم الشامل لجميع جوانب المشروع، وإدراك أي معوقات محتملة الحدوث خلال عملية التنفيذ، وفيما يأتي أهم النقاط التي تستعرض أهمية عمل دراسة الجدوى للمشاريع
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="morePosts">
        <div class="container">
            <h2 class="titleMore">مواضيع ذات صلة</h2>
            <div class="sliderMore">
                <div id="OwlMore" class="OwlMore Owl">
                    <div class="item">
                        <div class="itemBlog">
                            <a href="#" class="mask">
                                <img src="{{ asset('/assets/images/woman-using-tablet-planning-digital-marketing-with-chart-hologram-effect_105092-874.png') }}" alt="" />
                                <span>الاقتصاد</span>
                            </a>
                            <div class="details">
                                <div class="paddingTitle">
                                    <a href="#" class="titleItem">
                                        كيفية تنمية المشروعات الصغيرة
                                        والتخطيط للنجاح
                                    </a>
                                </div>
                                <div class="userDetails">
                                    <img src="{{ asset('/assets/images/memb1.png') }}" alt="" />
                                    <h2 class="author">نشر بواسطة <span>أ.عبدالله بن مساعد</span></h2>
                                </div>
                                <div class="date clearfix">
                                    <span class="time"><i class="flaticon-school-calendar"></i> 2020 - 06 - 23</span>
                                    <a href="#" class="moreDetails">التفاصيل</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="itemBlog">
                            <a href="#" class="mask">
                                <img src="{{ asset('/assets/images/woman-using-tablet-planning-digital-marketing-with-chart-hologram-effect_105092-874.png') }}" alt="" />
                                <span>الاقتصاد</span>
                            </a>
                            <div class="details">
                                <div class="paddingTitle">
                                    <a href="#" class="titleItem">
                                        كيفية تنمية المشروعات الصغيرة
                                        والتخطيط للنجاح
                                    </a>
                                </div>
                                <div class="userDetails">
                                    <img src="{{ asset('/assets/images/memb1.png') }}" alt="" />
                                    <h2 class="author">نشر بواسطة <span>أ.عبدالله بن مساعد</span></h2>
                                </div>
                                <div class="date clearfix">
                                    <span class="time"><i class="flaticon-school-calendar"></i> 2020 - 06 - 23</span>
                                    <a href="#" class="moreDetails">التفاصيل</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="itemBlog">
                            <a href="#" class="mask">
                                <img src="{{ asset('/assets/images/woman-using-tablet-planning-digital-marketing-with-chart-hologram-effect_105092-874.png') }}" alt="" />
                                <span>الاقتصاد</span>
                            </a>
                            <div class="details">
                                <div class="paddingTitle">
                                    <a href="#" class="titleItem">
                                        كيفية تنمية المشروعات الصغيرة
                                        والتخطيط للنجاح
                                    </a>
                                </div>
                                <div class="userDetails">
                                    <img src="{{ asset('/assets/images/memb1.png') }}" alt="" />
                                    <h2 class="author">نشر بواسطة <span>أ.عبدالله بن مساعد</span></h2>
                                </div>
                                <div class="date clearfix">
                                    <span class="time"><i class="flaticon-school-calendar"></i> 2020 - 06 - 23</span>
                                    <a href="#" class="moreDetails">التفاصيل</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="itemBlog">
                            <a href="#" class="mask">
                                <img src="{{ asset('/assets/images/woman-using-tablet-planning-digital-marketing-with-chart-hologram-effect_105092-874.png') }}" alt="" />
                                <span>الاقتصاد</span>
                            </a>
                            <div class="details">
                                <div class="paddingTitle">
                                    <a href="#" class="titleItem">
                                        كيفية تنمية المشروعات الصغيرة
                                        والتخطيط للنجاح
                                    </a>
                                </div>
                                <div class="userDetails">
                                    <img src="{{ asset('/assets/images/memb1.png') }}" alt="" />
                                    <h2 class="author">نشر بواسطة <span>أ.عبدالله بن مساعد</span></h2>
                                </div>
                                <div class="date clearfix">
                                    <span class="time"><i class="flaticon-school-calendar"></i> 2020 - 06 - 23</span>
                                    <a href="#" class="moreDetails">التفاصيل</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
            
        </div>
    </div>

    
    <div class="join">
        <img src="{{ asset('/assets/images/bgJoin.png') }}" class="bg" alt="" />
        <div class="container">
            <div class="desc">
                نرحب بنشر جميع مقالات في جميع
                يمكنك تعبئة النموذج الآتي
            </div>
            <a href="#" class="btnStyle">انضم الينا</a>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
@extends('Layouts.master')

@section('title','المدونة')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>المدونة</h2>
            <ul class="list-unstyled">
                <li class="active"><a href="index.html">الرئيسية</a></li>
                <li>المدونة</li>
            </ul>
        </div>
    </div>
        
    <div class="blog">
        <div class="container">
            <h2 class="titleBlog">مقالات الأعضاء</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="itemBlog">
                        <a href="{{ URL::to('/blogDetails') }}" class="mask">
                            <img src="{{ asset('/assets/images/woman-using-tablet-planning-digital-marketing-with-chart-hologram-effect_105092-874.png') }}" alt="" />
                            <span>الاقتصاد</span>
                        </a>
                        <div class="details">
                            <div class="paddingTitle">
                                <a href="{{ URL::to('/blogDetails') }}" class="titleItem">
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
                                <a href="{{ URL::to('/blogDetails') }}" class="moreDetails">التفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="itemBlog">
                        <a href="{{ URL::to('/blogDetails') }}" class="mask">
                            <img src="{{ asset('/assets/images/woman-using-tablet-planning-digital-marketing-with-chart-hologram-effect_105092-874.png') }}" alt="" />
                            <span>الاقتصاد</span>
                        </a>
                        <div class="details">
                            <div class="paddingTitle">
                                <a href="{{ URL::to('/blogDetails') }}" class="titleItem">
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
                                <a href="{{ URL::to('/blogDetails') }}" class="moreDetails">التفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="itemBlog">
                        <a href="{{ URL::to('/blogDetails') }}" class="mask">
                            <img src="{{ asset('/assets/images/woman-using-tablet-planning-digital-marketing-with-chart-hologram-effect_105092-874.png') }}" alt="" />
                            <span>الاقتصاد</span>
                        </a>
                        <div class="details">
                            <div class="paddingTitle">
                                <a href="{{ URL::to('/blogDetails') }}" class="titleItem">
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
                                <a href="{{ URL::to('/blogDetails') }}" class="moreDetails">التفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="itemBlog">
                        <a href="#" class="mask">
                            <img src="{{ asset('/assets/images/woman-using-tablet-planning-digital-marketing-with-chart-hologram-effect_105092-874.png') }}" alt="" />
                            <span>الاقتصاد</span>
                        </a>
                        <div class="details">
                            <div class="paddingTitle">
                                <a href="{{ URL::to('/blogDetails') }}" class="titleItem">
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
                                <a href="{{ URL::to('/blogDetails') }}" class="moreDetails">التفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="itemBlog">
                        <a href="{{ URL::to('/blogDetails') }}" class="mask">
                            <img src="{{ asset('/assets/images/woman-using-tablet-planning-digital-marketing-with-chart-hologram-effect_105092-874.png') }}" alt="" />
                            <span>الاقتصاد</span>
                        </a>
                        <div class="details">
                            <div class="paddingTitle">
                                <a href="{{ URL::to('/blogDetails') }}" class="titleItem">
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
                                <a href="{{ URL::to('/blogDetails') }}" class="moreDetails">التفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="itemBlog">
                        <a href="{{ URL::to('/blogDetails') }}" class="mask">
                            <img src="{{ asset('/assets/images/woman-using-tablet-planning-digital-marketing-with-chart-hologram-effect_105092-874.png') }}" alt="" />
                            <span>الاقتصاد</span>
                        </a>
                        <div class="details">
                            <div class="paddingTitle">
                                <a href="{{ URL::to('/blogDetails') }}" class="titleItem">
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
                                <a href="{{ URL::to('/blogDetails') }}" class="moreDetails">التفاصيل</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="pagiDiv clearfix">
                <a href="#" class="next">التالي</a>
                <ul class="pagination">
                      <li><a href="#" class="active">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                      <li><a href="#">...</a></li>
                      <li><a href="#">19</a></li>
                </ul>
                <a href="#" class="prev">السابق</a>
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
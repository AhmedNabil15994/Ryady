@extends('Layouts.master')

@section('title','العضويات')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>العضويات</h2>
            <ul class="list-unstyled">
                <li class="active"><a href="index.html">الرئيسية</a></li>
                <li>العضويات</li>
            </ul>
        </div>
    </div>
       
    <div class="AboutSection">
        <div class="container">
            <div class="col-md-3">
                <div class="item wow fadeInUp">
                    <i class="flaticon-witness"></i>
                    <h2 class="title">رؤيتنا</h2>
                    <div class="desc">
                        أفضل مجتمع أعمال حيوي
                        يضم 10.000 عضو بحلول 2025م 
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="item wow fadeInDown">
                    <i class="flaticon-flag"></i>
                    <h2 class="title">رسالتنا</h2>
                    <div class="desc">
                        مجتمع شباب اعمال حيوي متفرد
                        لتبادل الخبرات وتنمية المهارات
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="item wow fadeInUp">
                    <i class="flaticon-teamwork"></i>
                    <h2 class="title">مهمتنا</h2>
                    <div class="desc">
                        تكوين مجتمع شباب
                        أعمال حيوي متفرد
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="item wow fadeInDown">
                    <i class="flaticon-idea"></i>
                    <h2 class="title">قيمنا</h2>
                    <div class="desc">
                        ,بناء العلاقات,إثراء المعرفة
                        نجاح مشترك
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="methodology">
        <div class="container">
            <div class="imgDiv">
                <img src="{{ asset('/assets/images/iMac.png') }}" alt="" />
            </div>
            <div class="details">
                <h2 class="title">منهجيتنا</h2>
                <ul class="listLinks">
                    @foreach($data->benefits as $benefit)
                    <li><a href="#">{{ $benefit->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
    <div class="groupMembers">
        <div class="container">
            <h2 class="title">الفئة المستهدفة</h2>
            <div class="item">
                <i class="flaticon-presentation"></i>
                <div class="desc">
                    أصحاب المشاريع
                    الناشئة والصغيرة
                </div>
            </div>
            <div class="item">
                <i class="flaticon-idea-1"></i>
                <div class="desc">
                    أصحاب الأفكار
                    الخلاقة والواعدة
                </div>
            </div>
            <div class="item">
                <i class="flaticon-profits"></i>
                <div class="desc">
                    طلاب الإدارة والاقتصاد
                    وريادة الاعمال
                </div>
            </div>
            <div class="item">
                <i class="flaticon-economy"></i>
                <div class="desc">
                    المهتمين بمجال المال
                    والأعمال وريادة الاعمال
                </div>
            </div>
            <div class="item">
                <i class="flaticon-goal"></i>
                <div class="desc">
                    الباحثين عن تأسيس
                    مشاريعهم التجارية
                </div>
            </div>
        </div>
    </div>
    
    <div class="plans">
        <div class="container">
            <h2 class="titleStyle">العضويات</h2>
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

    
    <div class="features">
        <div class="container">
            <h2 class="titleStyle"><span>مميزات العضوية</span> الشاب الريادي Business Pro</h2>
            <div class="table-responsive">
                <table class="tableMemb">
                <thead>
                  <tr>
                    <th colspan="2">مزايا العضوية</th>
                    <th>منتسب <span>175</span></th>
                    <th>طموح <span>250</span></th>
                    <th>ريادي <span>375</span></th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                    <td>مجتمع تفاعلي</td>
                    <td>منصة تفاعلية (موقع – تطبيق) يجمع الأعضاء في مكان واحد للاستفادة من الخدمات</td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                  </tr>
                  <tr>
                    <td>مدونة اعمال</td>
                    <td>مدونة تحتوي على مقالات في مجال قطاع المال والاعمال</td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                  </tr>
                  <tr>
                    <td>شبكة علاقات</td>
                    <td>القدرة على الالتقاء والتواصل بمجتمع الشاب الريادي لتكوين علاقات قوية تساهم في نمو أعمالك</td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                  </tr>
                  <tr>
                    <td>شهادة عضوية</td>
                    <td>شهادة pdf معتمدة برقم تسلسلي من Business Pro</td>
                    <td><i class="flaticon-remove"></i></td>
                    <td>الكترونية</td>
                    <td>مطبوعة</td>
                  </tr>
                  <tr>
                    <td>كتابة محتوى</td>
                    <td>إمكانية نشر مقالات بالمدونة في مجال قطاع المال والاعمال حسب السياسات والشروط</td>
                    <td><i class="flaticon-remove"></i></td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                  </tr>
                  <tr>
                    <td>فيديوهات</td>
                    <td>فيديوهات خاصة بـمنصة الشاب الريادي في مجال المال والاعمال</td>
                    <td><i class="flaticon-remove"></i></td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                  </tr>
                  <tr>
                    <td>صوتيات</td>
                    <td>صوتيات خاصة بـمنصة الشاب الريادي في مجال المال والاعمال</td>
                    <td><i class="flaticon-remove"></i></td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                  </tr>
                  <tr>
                    <td>نماذج تطبيقية</td>
                    <td>نماذج عمل تطبيقية تساعد العضو في بناء وتأسيس المشاريع الصغيرة</td>
                    <td><i class="flaticon-remove"></i></td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                  </tr>
                  <tr>
                    <td>شبكة تنفيذية  VIP</td>
                    <td>شبكة علاقات تنفيذية تساهم في تكوين علاقات تجارية وشراكات استراتيجية بين الأعضاء ورواد الأعمال</td>
                    <td><i class="flaticon-remove"></i></td>
                    <td><i class="flaticon-remove"></i></td>
                    <td><i class="fa fa-check"></i></td>
                  </tr>                   
                  <tr>
                    <td>تجارب وحوارات</td>
                    <td>عرض تجارب وحوارات مع قادة المال والاعمال</td>
                    <td><i class="flaticon-remove"></i></td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                  </tr>
                  <tr>
                    <td>محادثات قمة</td>
                    <td>محادثات قمة التنفيذيين في قطاع المال والاعمال لحلول المشاكل والصعاب لرواد الاعمال</td>
                    <td><i class="flaticon-remove"></i></td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                  </tr>                   
                  <tr>
                    <td>نشرة اعمال</td>
                    <td>نشرة دورية تحتوي على اهم المعارف والخبرات في مجال ريادة الاعمال</td>
                    <td><i class="flaticon-remove"></i></td>
                    <td><i class="fa fa-check"></i></td>
                    <td><i class="fa fa-check"></i></td>
                  </tr>                       
                                      
              </tbody>
            </table>
            </div>
            
        </div>
    </div>
@endsection

@section('scripts')

@endsection
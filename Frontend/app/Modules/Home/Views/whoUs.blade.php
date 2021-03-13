@extends('Layouts.master')

@section('title','من نحن')

@section('styles')
@endsection

@section('content')
	<div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>من نحن</h2>
            <ul class="list-unstyled">
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li class="active">من نحن</li>
            </ul>
        </div>
    </div>

    <div class="aboutDetails">
        <div class="container clearfix">
            <img src="{{ asset('/assets/images/aboutDetailsImg.png') }}" alt="" class="bg" />
            <div class="content">
                <h2 class="title">نبني الاستراتيـجات بـرؤية مختلفة</h2>
                <div class="desc">
                    نفخر أننا نضع حلول استشارية رائعة ، أتت من الأفكار والرؤى في عالم ريادة السوق المتلائمة مع
                    الواقع الجديد ، بهدف تطوير الاعمال الحديثة على يد عدد من الخبراء الذين يقودون عملنا نحو المستقبل
                    لتحقيق نتائج متوقعة ، قابلة للتطبيق بأدوات واستراتيجيات دقيقة ، لتطوير المنظمات وقـادة الاعـمـال
                    ليكونوا أكثر قوة من ذي قبل ، مما يجعلنا نفكر دوماً في التطوير برؤية مختلفة ، والتي جعلت منا الأفضل ل
                    لتحقيق متطلباتهم ، فقيَّمنا التي ننطلق منها في
                    Business Pro ®
                    والحلول التي قدمناها ، والتجارب التي 
                    خضناها وجنينا ثمارها خلال الـ 10 سنوات الماضية حتى الآن ، هي من منحتنا الثقة في رحلتنا نحو المستقبل
                     لبناء الاستراتيجيات ، وتطوير المنظمات ، وتنمية قادة الاعمال ، لتحقيق أهدافهم ومتطلبات منظماتهم
                </div>
                <span class="text">نتقدم نحو المتسقبل لتطوير المنظمات وقادة الأعمال برؤية مختلفة</span>
            </div>
        </div>
   </div>
   
   <div class="Strategies">
        <div class="container">
            <h2 class="title">استراتيجيات النمو التصاعدية</h2>
            <div class="desc">جلب استراتيجية البقاء لضمان استباقية الفوز والنمو التصاعدي</div>
            <div class="desc">
                خبراتنا الاستباقية مبنية على توفير الشراكات الاستراتيجية والتحالفات التجارية لتقليل المصاريف ، حتى
                نساهم في اطلاق مشاريع ناشئة ، واعادة تصميم نموذج العمل التجاري للمشاريع المتعثرة ، لتحقيق
                نمو في الايرادات وزيادة تصاعدية في الارباح
            </div>
        </div>
   </div>
   
   <div class="methodology">
        <img src="{{ asset('/assets/images/methodology.jpg') }}" alt="" class="bg" />
        <div class="container old">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="title">الاستراتيجية والمنهجية</h2>
                </div>
                <div class="col-md-6">
                    <h3 class="subTitle">قـنـاعـتـنـا الـراسـخـة هي الـتـطـويـر بـرؤيـة مـخـتـلـفـة</h3>
                    <div class="desc">
                        إننا نعمل مع أولئك الذين يملكون العقول المبدعة ، التي تسعى للمضي
                        في تطوير منظماتها ، لتكون في مقدمة صناعة المستقبل في مجال التنافسية
                        ضمن نشاطها ، خبراتنا المتراكمة عبر السنين ، سمعتنا القوية التي اكسبناها عبر
                        عملائنا ، ساعدتنا على بناء نجاحات متوالية تلو الأخرى ، ساهمت في بناء مشاريع
                        تجارية ناجحة ، ذو قيمة تنافسية متميزة
                    </div>
                </div>
            </div>
        </div>
   </div>
   
    <div class="Reviews">
        <div class="container">
            <h2 class="title">قالوا عنا</h2>
            <div id="OwlReviews" class="OwlReviews Owl">
                
                <div class="item">
                    <div class="review">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="imgDiv">
                                    <img src="{{ asset('/assets/images/reviewImg.png') }}" alt="" />
                                    <h3 class="name">مصنع حديد بن دعجم</h3>
                                    <span class="job">مؤسس وشريك</span>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="desc">
                                    تجربتنا السابقة معكم ولدت داخل مجلس اداراتنا الثقة الكبيرة 
                                    لتكرار العمل كشراكة استراتيجية مع بزنس برو للمساهمة في تطوير 
                                    مشارينا داخل المملكة العربية السعودية .م.بندر بن دعجم 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="item">
                    <div class="review">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="imgDiv">
                                    <img src="{{ asset('/assets/images/reviewImg.png') }}" alt="" />
                                    <h3 class="name">مصنع حديد بن دعجم</h3>
                                    <span class="job">مؤسس وشريك</span>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="desc">
                                    تجربتنا السابقة معكم ولدت داخل مجلس اداراتنا الثقة الكبيرة 
                                    لتكرار العمل كشراكة استراتيجية مع بزنس برو للمساهمة في تطوير 
                                    مشارينا داخل المملكة العربية السعودية .م.بندر بن دعجم 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="item">
                    <div class="review">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="imgDiv">
                                    <img src="{{ asset('/assets/images/reviewImg.png') }}" alt="" />
                                    <h3 class="name">مصنع حديد بن دعجم</h3>
                                    <span class="job">مؤسس وشريك</span>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="desc">
                                    تجربتنا السابقة معكم ولدت داخل مجلس اداراتنا الثقة الكبيرة 
                                    لتكرار العمل كشراكة استراتيجية مع بزنس برو للمساهمة في تطوير 
                                    مشارينا داخل المملكة العربية السعودية .م.بندر بن دعجم 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
       
            </div>
               
        </div>
     </div>

    <div class="OurAdvisors">
        <div class="container">
            <h2 class="title">مستشارونا الخبراء</h2>
            <span class="subTitle">نحن هنا لمساعدتك</span>
            <div id="OwlAdvisors" class="OwlAdvisors Owl">
                
                <div class="item">
                    <div class="itemAdvisors">
                        <img src="{{ asset('/assets/images/AdvisorImg1.png') }}" alt="" />
                        <h3 class="name">أ. أحمد المنهبي</h3>
                        <span class="job"></span>
                        <center>
                                <ul class="socialList clearfix">
                                    <li><a href="#" class="fa fa-facebook"></a></li>
                                    <li><a href="#" class="fa fa-twitter"></a></li>
                                    <li><a href="#" class="fa fa-linkedin"></a></li>
                                    <li><a href="#" class="fa fa-instagram"></a></li>
                                </ul>
                        </center>
                    </div>

                </div>  
        
                <div class="item">
                    <div class="itemAdvisors">
                        <img src="{{ asset('/assets/images/AdvisorImg2.png') }}" alt="" />
                        <h3 class="name">م. وليد قوقندي</h3>
                        <span class="job"></span>
                        <center>
                                <ul class="socialList clearfix">
                                    <li><a href="#" class="fa fa-facebook"></a></li>
                                    <li><a href="#" class="fa fa-twitter"></a></li>
                                    <li><a href="#" class="fa fa-linkedin"></a></li>
                                    <li><a href="#" class="fa fa-instagram"></a></li>
                                </ul>
                        </center>
                    </div>

                </div>  
                <div class="item">
                    <div class="itemAdvisors">
                        <img src="{{ asset('/assets/images/AdvisorImg3.png') }}" alt="" />
                        <h3 class="name">أ. بندر الكلي</h3>
                        <span class="job"></span>
                        <center>
                                <ul class="socialList clearfix">
                                    <li><a href="#" class="fa fa-facebook"></a></li>
                                    <li><a href="#" class="fa fa-twitter"></a></li>
                                    <li><a href="#" class="fa fa-linkedin"></a></li>
                                    <li><a href="#" class="fa fa-instagram"></a></li>
                                </ul>
                        </center>
                    </div>

                </div>  
                <div class="item">
                    <div class="itemAdvisors">
                        <img src="{{ asset('/assets/images/AdvisorImg4.png') }}" alt="" />
                        <h3 class="name">أ. صالح الشهري</h3>
                        <span class="job"></span>
                        <center>
                                <ul class="socialList clearfix">
                                    <li><a href="#" class="fa fa-facebook"></a></li>
                                    <li><a href="#" class="fa fa-twitter"></a></li>
                                    <li><a href="#" class="fa fa-linkedin"></a></li>
                                    <li><a href="#" class="fa fa-instagram"></a></li>
                                </ul>
                        </center>
                    </div>

                </div>  
                <div class="item">
                    <div class="itemAdvisors">
                        <img src="{{ asset('/assets/images/AdvisorImg1.png') }}" alt="" />
                        <h3 class="name">أ. أحمد المنهبي</h3>
                        <span class="job"></span>
                        <center>
                                <ul class="socialList clearfix">
                                    <li><a href="#" class="fa fa-facebook"></a></li>
                                    <li><a href="#" class="fa fa-twitter"></a></li>
                                    <li><a href="#" class="fa fa-linkedin"></a></li>
                                    <li><a href="#" class="fa fa-instagram"></a></li>
                                </ul>
                        </center>
                    </div>

                </div>  
        
            </div>
               
        </div>
    </div>

   
    <div class="clients">
        <div class="container">
            <div id="OwlClients" class="OwlClients Owl wow bounceInUp">
                
                <div class="item">
                    <div class="LogoBrand">
                        <img src="{{ asset('/assets/images/client1.png') }}" />
                    </div>
                </div>  
                <div class="item">  
                    <div class="LogoBrand">
                        <img src="{{ asset('/assets/images/client2.jpg') }}" />
                    </div>
                </div>  
                <div class="item">  
                    <div class="LogoBrand">
                        <img src="{{ asset('/assets/images/client3.png') }}" />
                    </div>
                </div>  
                <div class="item">  
                    <div class="LogoBrand">
                        <img src="{{ asset('/assets/images/client4.png') }}" />
                    </div>
                </div>  
                <div class="item">
                    <div class="LogoBrand">
                        <img src="{{ asset('/assets/images/client1.png') }}" />
                    </div>
                </div>  
                <div class="item">  
                    <div class="LogoBrand">
                        <img src="{{ asset('/assets/images/client2.jpg') }}" />
                    </div>
                </div>  
                <div class="item">  
                    <div class="LogoBrand">
                        <img src="{{ asset('/assets/images/client3.png') }}" />
                    </div>
                </div>  
       
            </div>
               
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('/assets/js/whoUs.js') }}"></script>
@endsection
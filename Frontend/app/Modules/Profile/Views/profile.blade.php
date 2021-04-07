@extends('Layouts.master')

@section('title','الملف الشخصي')

@section('styles')
<link href="{{ asset('/assets/css/summernote.css') }}" rel="stylesheet">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/font-awesome5.css') }}"> --}}
<style type="text/css" media="screen">
    a.edit{
        position: absolute;
        z-index: 99;
        right: 30px;
        top: 10px;
        font-size: 20px;
        color: #777;
        background: #FFF;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        padding: 1px 2px;
    }
    .messages .PartProjects .item .details img{
        top: 20px;
        left: unset;
        right: 5px;
    }
    .messages .PartProjects .item .details .location{
        white-space: pre-wrap;
    }
    .messages .PartProjects .item .details .date{
        font-size: 13px;
        margin-bottom: 10px;
    }
    .messages .PartProjects .item .details .title,
    .messages .PartProjects .item .details .location{
        display: block;
        margin-right: 100px;
        min-height: unset;
    }
    .cardStyle{
        height: 210px;
        padding: 50px 40px;
    }
    .cardStyle .logo{
        height: 60px;
        left: 5px;
        top: 15px;
    }
    .cardStyle .titleAr{
        font-size: 20px;
        margin-bottom: 5px;
    }
    .cardStyle .titleEn{
        font-size: 15px;
    }
    .cardStyle .details{
        bottom: 20px;
    }
    .cardStyle .details .date{
        font-size: 13px;
        margin-bottom: 0;
    }
    .cardStyle .details svg{
        left: 30px;
        top: 15px;
    }
    .cardStyle .details .code{
        letter-spacing: 3px;
    }
    .cardStyle .state{
        bottom: 25px;
        font-size: 14px;
    }
    .cardStyle .state:before{
        top: 2px;
        height: 15px;
    }
    .btnStyle{
        background-color: #001C54;
        color: #FFF;
    }
    .inputStyle, .selectStyle .ui-selectmenu-button.ui-button, .textareaStyle, .labelFile,.inputSt .inputStyle{
        background-color: #FFF;
    }
    .textareaStyle{
        padding-top: 20px;
        min-width: 100%;
        max-width: 100%;
        min-height: 70px;
        max-height: 150px;
    }
    label{
        color: #001C54;
        font-size: 18px;
    }
    .profile .titleStyle{
        width: auto;
        padding: 0 10px;
    }
    .labelFile .imgs{
        background-color: transparent;
    }
    li.last a{
        padding-right: 25px !important;
    }
    li.last a i{
        font-size: 28px;
        margin-left: 23px;
    }
    .wallets{
        display: block;
        margin: auto;
        width: 200px;
        height: fit-content;
        height: -webkit-fit-content;
        height: -moz-fit-content;
        height: -o-fit-content;
        padding: 0;
        line-height: 0;
        border-radius: 15px;
        border: 0;
        border-color: #F6F8FA;
    }
    .cardHead .row .col-md-7{
        float: unset;
        display: block;
        margin: auto;
    }
    .profile .userProfile span{
        margin-bottom: 10px;
    }
    .profile .userProfile p.name{
        margin-bottom: 30px;
        font-size: 18px;
    }
    .PartProjects .item{
        border: 1px solid #DDD;
    }
    p.noProjs{
        font-size: 18px;
    }
    .fa{
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
</style>
@endsection

@section('content')
    <div class="breadcrumbs">
        <img class="bg" src="{{ asset('/assets/images/breadBg.png') }}" alt="" />
        <div class="container">
            <h2>الملف الشخصي</h2>
            <ul class="list-unstyled">
                <li><a href="{{ URL::to('/') }}">الرئيسية</a></li>
                <li class="active">الملف الشخصي</li>
            </ul>
        </div>
    </div>
    
    <div class="profile">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="userProfile">
                        <center>
                            <form class="userImg">
                                <label>
                                    <img src="{{ $data->user->photo }}" class="img main" alt="" />
                                    <i class="camera"><img src="{{ asset('/assets/images/photo-camera.svg') }}" /></i>
                                    <input type="file" name="image" />
                                </label>
                            </form>
                        </center>
                        <h2 class="name">{{ $data->user->name_ar }}</h2>
                        @if($data->membership != null)
                        <span style="color: {{ $data->membership->membership->color }}">{{ $data->membership->membership->title }}</span>
                        @endif
                        <p class="name">لديك {{ $data->points }} نقطة</p>
                        <ul class="listProfile">
                            <li><a href="{{ URL::to('/profile') }}" class="{{ Active( URL::to('/profile')) }}">العضوية 
                                <img src="{{ asset('/assets/images/024-name.svg') }}" />
                                </a></li>
                            <li><a href="{{ URL::to('/profile/personalInfo') }}" class="{{ Active( URL::to('/profile/personalInfo')) }}">البيانات الشخصية 
                                <img src="{{ asset('/assets/images/024-name.svg') }}" />
                                </a></li>
                            <li><a href="{{ URL::to('/profile/messages') }}" class="{{ Active( URL::to('/profile/messages')) }}">صندوق الرسائل 
                                <img src="{{ asset('/assets/images/026-document.svg') }}" />
                                </a></li>

                            {{-- @if($data->membership->membership_id == 3)
                            <li><a href="{{ URL::to('/profile/download/'.$data->membership->id) }}" class="{{ Active( URL::to('/profile/certificate')) }}">شهادة العضوية 
                                <img src="{{ asset('/assets/images/026-document.svg') }}" />
                            </a></li>
                            @endif --}}
                            @if($data->membership != null && $data->membership->membership_id != 1)
                            <li><a href="{{ URL::to('/profile/addBlog') }}" class="{{ Active( URL::to('/profile/addBlog')) }}">اضف مقالة 
                                <img src="{{ asset('/assets/images/025-content-writing.svg') }}" />
                            </a></li>
                            @endif
                            
                            @if($data->membership != null && $data->membership->membership_id == 3)
                            <li><a href="{{ URL::to('/profile/newProject') }}" class="{{ Active( URL::to('/profile/newProject')) }}">اضف مشروعك 
                                <img src="{{ asset('/assets/images/027-add.svg') }}" />
                            </a></li>
                            <li><a href="{{ URL::to('/profile/projects') }}" class="{{ Active( URL::to('/profile/projects')) }}">استعرض مشروعاتك 
                                <img src="{{ asset('/assets/images/027-add.svg') }}" />
                            </a></li>
                            @endif
                            @if(\App\Models\Variable::getVar('REQUEST_SERVICE') == 1)
                            <li><a href="{{ URL::to('/profile/newOrder') }}" class="{{ Active( URL::to('/profile/newOrder')) }}">اطلب خدمة 
                                <img src="{{ asset('/assets/images/028-support.svg') }}" />    
                            </a></li>
                            @endif
                            <li class="last"><a href="{{ URL::to('/profile/logout') }}" class="{{ Active( URL::to('/profile/logout')) }}">
                                <i class="fa fa-sign-out"></i>
                                تسجيل الخروج 
                            </a></li>
                        </ul>
                    </div>
                </div>
                @if(Request::segment(2) == 'personalInfo')
                <div class="col-md-8">
                    <div class="profileDetails">
                        <div class="tabs">
                            <div class="tab1 tab">
                                
                                <form class="formStyle" method="POST" action="{{ URL::to('/profile/update') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">الاسم عربي</label>
                                            <input type="text" class="inputStyle" readonly name="name_ar" placeholder="الاسم عربي" value="{{ $data->user->name_ar }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">الاسم إنجليزي</label>
                                            <input type="text" class="inputStyle" readonly name="name_en" placeholder="الاسم إنجليزي"  value="{{ $data->user->name_en }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">رقم الجوال</label>
                                            <input type="text" class="inputStyle" readonly name="phone" placeholder="رقم الجوال" value="{{ $data->user->phone }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">البريد الالكتروني</label>
                                            <input type="email" class="inputStyle" name="email" placeholder="البريد الالكتروني" value="{{ $data->user->email }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">كلمة المرور</label>
                                            <input type="password" class="inputStyle" name="password" placeholder="كلمة المرور"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">النوع</label>
                                            <div class="selectStyle">
                                                <select class="selectmenu" id="selectmenu2" name="gender">
                                                    <option value="1"{{ $data->user->gender == 1 ? 'selected' : '' }}>ذكر</option>
                                                    <option value="2"{{ $data->user->gender == 2 ? 'selected' : '' }}>انثي</option>
                                                </select>
                                                <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">رابط فيسبوك</label>
                                            <input type="text" class="inputStyle" name="facebook" placeholder="رابط فيسبوك" value="{{ $data->user->facebook }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">رابط سناب شات</label>
                                            <input type="text" class="inputStyle" name="snapchat" placeholder="رابط سناب شات" value="{{ $data->user->snapchat }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">رابط تويتر</label>
                                            <input type="text" class="inputStyle" name="twitter" placeholder="رابط تويتر" value="{{ $data->user->twitter }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">رابط يوتيوب</label>
                                            <input type="text" class="inputStyle" name="youtube" placeholder="رابط يوتيوب" value="{{ $data->user->youtube }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">رابط انستجرام</label>
                                            <input type="text" class="inputStyle" name="instagram" placeholder="رابط انستجرام" value="{{ $data->user->instagram }}" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">نبذة تعريفية</label>
                                            <textarea name="brief" class="textareaStyle" placeholder="نبذة تعريفية">{{ $data->user->brief }}</textarea>
                                        </div>
                                    </div>
                                    <button class="btnForm">تحديث البيانات</button>
                                    
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                @elseif(Request::segment(2) == null && $data->membership != null)
                <div class="col-md-8">
                    <div class="profileDetails">
                        <div class="tabsHead">
                            <ul class="btnsTabs clearfix" id="tabs">
                                <li id="tab1" class="active">معلومات العضوية</li>
                                @if($data->membership->membership_id != 3)
                                <li id="tab4">ترقية العضوية</li>
                                @endif
                                <li id="tab2" class="hidden">النقاط</li>
                                <li id="tab3">مميزات العضوية</li>
                            </ul>
                        </div>
                        <div class="tabs" style="padding: 55px 15px 50px;">
                            <div class="tab1 tab" style="padding-left: 25px;padding-right: 25px;">
                                <div class="cardHead">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="cardStyle">
                                                @php 
                                                    $img = '';
                                                    $class = '';
                                                    if($data->membership->membership->id == 1){
                                                        $img = 'Purple.png';
                                                        $class = 'bgPurple';
                                                    }else if($data->membership->membership->id == 2){
                                                        $img = 'green.png';
                                                        $class = 'bgGreen';
                                                    }else if($data->membership->membership->id == 3){
                                                        $img = 'blue.png';
                                                        $class = 'bgBlue';
                                                    }
                                                @endphp    
                                                <img src="{{ asset('/assets/images/'.$img) }}" alt="" class="bg" />
                                                <h2 class="titleAr" id="lblValue">{{ $data->user->name_ar }}</h2>
                                                <h2 class="titleEn" id="lblValue2">{{ $data->user->name_en }}</h2>
                                                <img class="logo" src="{{ asset('/assets/images/logo.svg') }}" alt="" />
                                                <div class="details">
                                                    {!! $data->qrCode !!}
                                                    <span class="date">{{ date('m/Y',strtotime($data->membership->end_date)) }}</span>
                                                    <span class="code" style="color: {{ $data->membership->membership->color }}">{{ $data->membership->code }}</span>
                                                </div>
                                                <span class="state {{ $class }}">{{ $data->membership->membership->title }}</span>
                                            </div>
                                            <form action="{{ URL::to('/profile/addToWallet') }}" method="post" accept-charset="utf-8">
                                                @csrf
                                                <button type="submit" class="btnStyle wallets"> <img src="{{ asset('/assets/images/wallet.svg') }}" alt=""></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <form class="formStyle" method="post" action="{{ URL::to('/profile/addRequest') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">اسمك على البطاقة بالعربي</label>
                                            <input type="text" class="inputStyle" readonly name="name_ar" placeholder="اسمك على البطاقة بالعربي" value="{{ $data->user->name_ar }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">اسمك على البطاقة بالإنجليزي</label>
                                            <input type="text" class="inputStyle" readonly name="name_en" placeholder="اسمك على البطاقة بالإنجليزي"  value="{{ $data->user->name_en }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">تاريخ البداية</label>
                                            <div class="dateStyle">
                                                <input type="text" class="inputStyle" readonly name="start_date" placeholder="بداية من" value="{{ date('d/m/Y',strtotime($data->membership->start_date)) }}" />
                                                <i class="flaticon-school-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">تاريخ الانتهاء</label>
                                            <div class="dateStyle">
                                                <input type="text" class="inputStyle" readonly name="end_date" placeholder="الانتهاء الي" value="{{ date('d/m/Y',strtotime($data->membership->end_date)) }}" />
                                                <i class="flaticon-school-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">رقم البطاقة</label>
                                            <input type="text" class="inputStyle" name="code" placeholder="رقم البطاقة" readonly value="{{ $data->membership->code }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">العضوية</label>
                                            <input type="text" class="inputStyle" name="membership" placeholder="العضوية" readonly value="{{ $data->membership->membership->title }}"/>
                                        </div>
                                    </div>  
                                    @if(\App\Models\Variable::getVar('PRINTED_CARDS') == 1 && $data->printCards == null)
                                    <button class="btnStyle">طلب بطاقة مطبوعة</button>     
                                    @endif                           
                                </form>
                            </div>
                            <div class="tab4 tab">
                                <div class="cardHead">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="cardStyle">
                                                @php 
                                                    $img = '';
                                                    $class = '';
                                                    if($data->membership->membership->id == 1){
                                                        $img = 'Purple.png';
                                                        $class = 'bgPurple';
                                                    }else if($data->membership->membership->id == 2){
                                                        $img = 'green.png';
                                                        $class = 'bgGreen';
                                                    }else if($data->membership->membership->id == 3){
                                                        $img = 'blue.png';
                                                        $class = 'bgBlue';
                                                    }
                                                @endphp    
                                                <img src="{{ asset('/assets/images/'.$img) }}" alt="" class="bg" />
                                                <h2 class="titleAr" id="lblValue">{{ $data->user->name_ar }}</h2>
                                                <h2 class="titleEn" id="lblValue2">{{ $data->user->name_en }}</h2>
                                                <img class="logo" src="{{ asset('/assets/images/logo.svg') }}" alt="" />
                                                <div class="details">
                                                    {!! $data->qrCode !!}
                                                    <span class="date">{{ date('m/Y',strtotime($data->membership->end_date)) }}</span>
                                                    <span class="code" style="color: {{ $data->membership->membership->color }}">{{ $data->membership->code }}</span>
                                                </div>
                                                <span class="state {{ $class }}">{{ $data->membership->membership->title }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <center>
                                                <div class="memberStyle">
                                                    <h2 class="titleMem">الحالية : {{ $data->membership->membership->title }}</h2>
                                                    <input type="hidden" name="oldPrice" value="{{ $data->membership->membership->price }}">
                                                    <span class="time hidden">فرق الترقية</span>
                                                    <span class="price hidden">0 ريال</span>
                                                </div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                
                                <form class="formStyle" method="POST" action="{{ URL::to('/profile/upgrade') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">اختر العضوية</label>
                                            <div class="selectStyle">
                                                <select class="selectmenu" id="selectmenu" name="new_membership_id">
                                                    @foreach($data->memberships as $membership)
                                                    @if($membership->id >= $data->membership->membership->id)
                                                    <option data-area="{{ $membership->price }}" value="{{ $membership->id }}" {{ $data->membership->membership_id == $membership->id ? 'selected' : '' }}>عضوية {{ $membership->title . ' ' . $membership->price }} ريال</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">كود الخصم</label>
                                            <div class="coupons">
                                                <div class="inputSt">
                                                    <input type="text" class="inputStyle" name="coupons[]" placeholder="كود الخصم :" />
                                                </div>
                                            </div>
                                        </div>
                                        @if(\App\Models\Variable::getVar('PRINTED_CARDS') == 1)
                                        <div class="col-md-6">
                                            <label class="checkStyle">
                                                <input type="checkbox" checked name="user_request" />
                                                <i></i>
                                                بطاقة مطبوعة رسوم اضافية 100 ريال
                                            </label>
                                        </div>
                                        @endif
                                        <div class="col-md-6">
                                            <label class="checkStyle">
                                                <input type="checkbox" checked />
                                                <i></i>
                                                الشروط والحكام
                                            </label>
                                        </div>
                                    </div>
                                    <button class="btnForm">ارسال الطلب</button>
                                    
                                </form>

                            </div>
                            <div class="tab2 tab hidden">
                                <h2 class="titleMem">لديك {{ $data->points }} نقطة</h2>
                            </div>
                            <div class="tab3 tab">
                                <div class="table-responsive">
                                    <table class="tableMemb">
                                        <thead>
                                          <tr>
                                            <th colspan="2">مزايا العضوية</th>
                                            <th>{{ $data->mainMembership->title }}</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                            @foreach($data->features as $feature)
                                            <tr>
                                                <td>{{ $feature->title }}</td>
                                                <td>{{ $feature->description }}</td>
                                                @if($feature->title == 'شهادة عضوية')
                                                    @if($data->mainMembership->id == 2)
                                                    <td>الكترونية</td>
                                                    @elseif($data->mainMembership->id == 3)
                                                    <td>مطبوعة</td>
                                                    @endif
                                                @else
                                                <td><i class="fa fa-check"></i></td>
                                                @endif
                                            </tr>
                                            @endforeach
                                      </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
                @elseif(Request::segment(2) == 'addBlog' && $data->membership->membership_id != 1)
                <div class="col-md-8">
                    <div class="profileDetails">
                        <div class="tabs">
                            <div class="tab1 tab">
                                <form class="center-block">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">العنوان عربي :</label>
                                            <input type="text" class="inputStyle" name="title" placeholder="العنوان عربي :" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">التصنيف :</label>
                                            <div class="selectStyle">
                                                <select class="selectmenu" name="order_category_id" id="selectmenu">
                                                    <option value="" disabled selected>اختر التصنيف :</option>
                                                    @foreach($data->categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">المرفقات :</label>
                                            <div class="labelFile">
                                                <label>
                                                    <span>المرفقات :</span>
                                                    <input type="file" name="file" />
                                                    <i class="fa fa-upload"></i>
                                                </label>
                                                <ul class="imgs">
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="">الوصف عربي :</label>
                                    <textarea class="textareaStyle summernote" name="description" placeholder="الوصف عربي :"></textarea>
                                    
                                    <button class="btnStyle addBlog">ارسل الآن</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif(Request::segment(2) == 'newProject' && $data->membership->membership_id == 3)
                <div class="col-md-8">
                    <div class="profileDetails">
                        <div class="tabs">
                            <div class="tab1 tab">
                                <form class="center-block">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">اسم المشروع :</label>
                                            <input type="text" class="inputStyle" name="title" placeholder="اسم المشروع :" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">التصنيف :</label>
                                            <div class="selectStyle">
                                                <select class="selectmenu" name="category_id" id="selectmenu">
                                                    <option value="" disabled selected>اختر التصنيف :</option>
                                                    @foreach($data->categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">نبذة عن المشروع :</label>
                                            <textarea class="textareaStyle" name="brief" placeholder="نبذة عن المشروع :"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">حالة المشروع :</label>
                                            <div class="selectStyle">
                                                <select class="selectmenu" name="type" id="selectmenu3">
                                                    <option value="" disabled selected>اختر حالة المشروع :</option>
                                                    <option value="تحت التأسيس">تحت التأسيس</option>
                                                    <option value="قائم">قائم</option>
                                                    <option value="متعثر">متعثر</option>
                                                    <option value="@">أخري</option>
                                                </select>
                                            </div>
                                            <input type="text" class="inputStyle hidden" name="type_text" placeholder="أخري :" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">رأس مال المشروع :</label>
                                            <div class="coupons">
                                                <div class="inputSt">
                                                    <input type="text" class="inputStyle" name="coupons" placeholder="رأس مال المشروع :" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">المدينة :</label>
                                            <div class="selectStyle">
                                                <select class="selectmenu" name="city_id" id="selectmenu2">
                                                    <option value="" disabled selected>اختر المدينة :</option>
                                                    @foreach($data->cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->title }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">الموقع الجغرافي :</label>
                                            <div class="inputSt">
                                                <input type="text" class="inputStyle" name="gmaps" placeholder="خرائط جوجل :" />
                                                <img class="iconImg locations" data-toggle="modal" data-target=".modal-location" src="{{ asset('/assets/images/google-maps (2).png') }}" />
                                                <input type="hidden" name="lat" value="24.774265">
                                                <input type="hidden" name="lng" value="46.738586">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">شعار النشاط :</label>
                                            <div class="labelFile">
                                                <label>
                                                    <span>شعار النشاط :</span>
                                                    <input type="file" name="logo" />
                                                    <i class="fa fa-upload"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">صور عن النشاط :</label>
                                            <div class="labelFile">
                                                <label>
                                                    <span>صور عن النشاط :</span>
                                                    <input type="file" name="images[]" />
                                                    <i class="fa fa-upload"></i>
                                                </label>
                                                <ul class="imgs">
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">رقم الجوال :</label>
                                            <input type="text" class="inputStyle" name="phone" placeholder="رقم الجوال :" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">البريد الالكتروني :</label>
                                            <input type="email" class="inputStyle" name="email" placeholder="البريد الالكتروني :" />
                                        </div>
                                    </div>
                                    <button class="btnStyle perform-btn pull-left">ارسل الآن</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif(Request::segment(2) == 'projects' && $data->membership->membership_id == 3)
                <div class="col-md-8">
                    <div class="profileDetails">
                        <div class="tabs PartProjects">
                            <div class="tab1 tab">
                                <div class="row">
                                    @if(!empty($data->projects))
                                        @foreach($data->projects as $project)
                                        <div class="col-md-6">
                                            <div class="item">
                                                <a href="{{ URL::to('/profile/editProject/'.$project->id) }}" class="edit"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ URL::to('/projects/'.$project->id) }}" class="mask">
                                                    <img src="{{ isset($project->images[0]) ? $project->images[0]->photo : $project->logo }}" alt="" />
                                                </a>
                                                <div class="details">
                                                    <img class="imgDetails" src="{{ $project->logo }}" alt="" />
                                                    <a href="{{ URL::to('/projects/'.$project->id) }}" class="title">{{ $project->title }}</a>
                                                    <p class="location" dir="rtl"><i class="flaticon-flag pull-right"></i> {{ $project->typeMessage }} </p>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                    <p class="noProjs">عفوا لا تتوفر اي مشاريع لك حتي الان .!</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif(Request::segment(2) == 'newOrder' && \App\Models\Variable::getVar('REQUEST_SERVICE') == 1)
                <div class="col-md-8">
                    <div class="profileDetails">
                        <div class="tabs">
                            <div class="tab1 tab">
                                <form class="center-block" method="POST" action="{{ URL::to('/profile/postOrder') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">الاسم :</label>
                                            <input type="text" class="inputStyle" name="name" readonly value="{{ $data->user->name_ar }}" placeholder="الاسم :" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">رقم الجوال :</label>
                                            <input type="number" class="inputStyle" name="phone" value="{{ $data->user->phone }}" placeholder="رقم الجوال :" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">البريد الالكتروني :</label>
                                            <input type="email" class="inputStyle" name="email" value="{{ $data->user->email }}" placeholder="البريد الالكتروني :" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">نوع الخدمة :</label>
                                            <div class="selectStyle">
                                                <select class="selectmenu" id="selectmenu" name="category_id">
                                                    <option value="" selected disabled>حدد نوع الخدمة :</option>
                                                    @foreach($data->data as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>{{ $category->title }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">شرح الخدمة</label>
                                            <textarea name="service_brief" class="textareaStyle" placeholder="شرح الخدمة" maxlength="140">{{ $data->user->brief }}</textarea>
                                        </div>
                                    </div>
                                    <button class="btnStyle">ارسل الآن</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif(Request::segment(2) == 'messages')
                <div class="col-md-8 messages">
                    <div class="profileDetails">
                        <div class="tabs PartProjects">
                            <div class="tab1 tab">
                                <div class="row">
                                    @if(!empty($data->messages))
                                        @foreach($data->messages as $message)
                                        <div class="col">
                                            <div class="item">
                                                <div class="details">
                                                    <img class="imgDetails" src="{{ $message->creator->photo }}" alt="" />
                                                    <a  class="title">{{ $message->creator->name_ar }}</a>
                                                    <div class="clearfix"></div>
                                                    <span class="location date" dir="rtl"><i class="flaticon-school-calendar pull-right"></i> {{ $message->creator->created_at }}</span>
                                                    <p class="location" dir="rtl"><i class="flaticon-email pull-right"></i> {{ $message->message }} </p>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                    <p class="noProjs">عفوا لا تتوفر اي رسائل في الصندوق حتي الان .!</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif(Request::segment(2) == 'editProject' && $data->membership->membership_id == 3)
                <div class="col-md-8">
                    <div class="profileDetails">
                        <div class="tabs">
                            <div class="tab1 tab">
                                <form class="center-block">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">اسم المشروع :</label>
                                            <input type="text" class="inputStyle" name="title" value="{{ $data->data->title }}" placeholder="اسم المشروع :" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">التصنيف :</label>
                                            <div class="selectStyle">
                                                <select class="selectmenu" name="category_id" id="selectmenu">
                                                    <option value="" disabled selected>اختر التصنيف :</option>
                                                    @foreach($data->categories as $category)
                                                    <option value="{{ $category->id }}" {{ $data->data->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">نبذة عن المشروع :</label>
                                            <textarea class="textareaStyle" name="brief" placeholder="نبذة عن المشروع :">{{ $data->data->brief }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">حالة المشروع :</label>
                                            <div class="selectStyle">
                                                <select class="selectmenu" name="type" id="selectmenu3">
                                                    <option value="" disabled selected>اختر حالة المشروع :</option>
                                                    <option value="تحت التأسيس" {{ $data->data->type == "تحت التأسيس" ? 'selected' : '' }}>تحت التأسيس</option>
                                                    <option value="قائم" {{ $data->data->type == "قائم" ? 'selected' : '' }}>قائم</option>
                                                    <option value="متعثر" {{ $data->data->type == "متعثر" ? 'selected' : '' }}>متعثر</option>
                                                    <option value="@" {{ $data->data->type == "أخري" ? 'selected' : '' }}>أخري</option>
                                                </select>
                                            </div>
                                            <input type="text" class="inputStyle {{ $data->data->type != 'أخري' ? 'hidden' : '' }}" name="type_text" value="{{ $data->data->type == 'أخري' ? $data->data->type_text : "" }}" placeholder="أخري :" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">رأس مال المشروع :</label>
                                            <div class="coupons">
                                                <div class="inputSt">
                                                    <input type="text" class="inputStyle" name="coupons" value="{{ $data->data->coupons }}" placeholder="رأس مال المشروع :" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">المدينة :</label>
                                            <div class="selectStyle">
                                                <select class="selectmenu" name="city_id" id="selectmenu2">
                                                    <option value="" disabled selected>اختر المدينة :</option>
                                                    @foreach($data->cities as $city)
                                                    <option value="{{ $city->id }}" {{ $data->data->city_id == $city->id ? 'selected' : '' }}>{{ $city->title }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="selectmenu" class="iconLeft fa fa-angle-down"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">الموقع الجغرافي :</label>
                                            <div class="inputSt">
                                                <input type="text" class="inputStyle" name="gmaps" placeholder="خرائط جوجل :" />
                                                <img class="iconImg locations" data-toggle="modal" data-target=".modal-location" src="{{ asset('/assets/images/google-maps (2).png') }}" />
                                                <input type="hidden" name="lat" value="{{ $data->data->lat }}">
                                                <input type="hidden" name="lng" value="{{ $data->data->lng }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">شعار النشاط :</label>
                                            <div class="labelFile">
                                                <label>
                                                    <span>شعار النشاط :</span>
                                                    <input type="file" name="logo" />
                                                    <i class="fa fa-upload"></i>
                                                </label>
                                                <ul class="imgs">
                                                    <li>
                                                        <img src="{{ $data->data->logo }}" alt="">
                                                        <i class="fa fa-close" data-area="0"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">صور عن النشاط :</label>
                                            <div class="labelFile">
                                                <label>
                                                    <span>صور عن النشاط :</span>
                                                    <input type="file" name="images[]" />
                                                    <i class="fa fa-upload"></i>
                                                </label>
                                                <ul class="imgs">
                                                    @foreach($data->data->images as $key=> $image)
                                                    <li>
                                                        <img src="{{ $image->photo }}" alt="">
                                                        <i class="fa fa-close" data-area="{{ $key }}"></i>
                                                    </li>
                                                    @endforeach 
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">رقم الجوال :</label>
                                            <input type="text" class="inputStyle" value="{{ $data->data->phone }}" name="phone" placeholder="رقم الجوال :" />
                                        </div>
                                        <input type="hidden" name="areas" value="{{ $data->data->id }}">
                                        <div class="col-md-6">
                                            <label for="">البريد الالكتروني :</label>
                                            <input type="email" class="inputStyle" value="{{ $data->data->email }}" name="email" placeholder="البريد الالكتروني :" />
                                        </div>
                                    </div>
                                    <button class="btnStyle update-btn pull-left">تعديل البيانات</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div> 
@endsection

@section('modals')
@include('Partials.locationModal')
@endsection

@section('scripts')
<script src='https://maps.google.com/maps/api/js?key=&sensor=false&libraries=places'></script>
<script src="{{ asset('/assets/js/summernote.js') }}"></script>
<script src="{{ asset('/assets/js/locationpicker.jquery.js') }}"></script>
<script src="{{ asset('/assets/js/profile.js') }}"></script>
<script src="{{ asset('/assets/js/addProject.js') }}"></script>
@endsection
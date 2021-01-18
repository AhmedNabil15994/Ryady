<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <!-- IE Compatibility Meta -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- First Mobile Meta  -->
        <meta name="viewport" content="width=device-width, height=device-height ,  maximum-scale=1 , initial-scale=1">
        <title><?php echo e($title); ?></title>
        <link rel="stylesheet" href="<?php echo e(asset('/assets/pdf/bootstrap.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('/assets/pdf/bootstrap-rtl.css')); ?>" />
        <!--[if lt IE 9]>
            <script src="js/html5shiv.min.js"></script>
            <script src="js/respond.min.js"></script>
        <![endif]-->
        <style>
            @font-face {
                font-family: "Tajawal-Regular";
                src:url('<?php echo e(asset("/assets/fonts/Tajawal-Regular.ttf")); ?>') format('truetype');
                font-weight: normal;
                font-style: normal;
            }

            @font-face {
                font-family: "Tajawal-Bold";
                src: url('<?php echo e(asset("/assets/fonts/Tajawal-Bold.ttf")); ?>') format('truetype');
                font-weight: normal;
                font-style: normal;
            }

            @font-face {
                font-family: "Tajawal-ExtraBold";
                src: url('<?php echo e(asset('/assets/fonts/Tajawal-ExtraBold.ttf')); ?>') format('truetype');
                font-weight: normal;
                font-style: normal;
            }
            /* ------------------------------------------ */
            /*         certificate
            /* ------------------------------------------ */
            .certificate
            {
                display: block;
                width:100%;
                height:990px;
                margin: 0;
                background-color:#081E56;
                overflow:hidden;
                position:relative;
                z-index: 1;
                text-align:center;
                padding-top:250px;
                font-family: "Tajawal-Regular";
            }

            .certificate .bgCer
            {
                position: absolute;
                right:0;
                top:0;
                min-width:100%;
                min-height:100%;
                z-index: -1;
            }

            .certificate .logo
            {
                position: absolute;
                right:40px;
                top:40px;
                width:265px;
                height:150px;
            }

            .certificate .content
            {
                color:#fff
            }

            .certificate .title
            {
                font-size:31px;
                font-family: "STC-Bold";
                margin-bottom:25px;
                font-family: "Tajawal-Bold";
                font-weight: bold;
            }

            .certificate .subTitle
            {
                font-size:25px;
                margin-bottom:20px;
            }

            .certificate .name
            {
                text-align: center;
                display:block;
                font-size:38px;
                margin-bottom:20px;
                font-family: "Tajawal-Bold";
                font-weight: bold;
            }

            .certificate .name span
            {
                margin-left:50px;
                display:inline-block
            }

            .certificate .subTitle2
            {
                font-size:31px;
                margin-bottom:23px;
            }

            .certificate .desc
            {
                font-size:20px;
            }

            .certificate .desc span
            {
                display:block;
                margin-top:15px;
                font-size:30px;
            }

            .certificate .ceo
            {
                float:left;
                width:424px;
                text-align: right;
                color:#fff;
                margin-top:45px;
                margin-bottom:6px;
            }

            .certificate .ceo .ceoTitle
            {
                text-align:center;
                font-size:15px;
                margin-bottom:20px;
                font-family: "Tajawal-Bold";
                font-weight: bold;
            }

            .certificate .ceo .ceoName
            {
                font-size:13px;
                margin-bottom:5px;
                display:block
            }

            .certificate .ceo .ceoPosition
            {
                font-size:13px;
                display:block
            }

            .certificate .cerFooter
            {
                position: absolute;
                display: block;
                width: 100%;
                left: 0;
                bottom: 0;
                color:#fff;
                font-size:13px;
                text-align:right;
                padding:10px 30px 0;
                display:flex;
                justify-content:space-between
            }

            .certificate .cerFooter .date
            {
                align-self:flex-end
            }

            .certificate .cerFooter .text
            {
                display:block;
                margin-bottom:5px;
            }

            .certificate .cerFooter .webSite
            {
                align-self:flex-end
            }

            .certificate .cerFooter .copyRights
            {
                align-self:flex-end
            }
            .certificate .cerFooter .copyRights span
            {
                display:block;
            }
        </style>
    </head>
    <body>
        <div class="certificate">
            <center class="content">
                <img src="<?php echo e(asset('/assets/images/bgCER.png')); ?>" class="bgCer" alt="" />
                <img src="<?php echo e(asset('/assets/images/logo.svg')); ?>" class="logo" alt="" />
                <h2 class="title">شهادة عضوية</h2>
                <h3 class="subTitle">تصادق Business Pro للإستشارات</h3>
                <h4 class="name"><span>على مـنـح</span>     <?php echo e($user); ?></h4>
                <h5 class="subTitle2">عضوية  | <?php echo e($membership_name); ?> الشاب الريادي</h5>
                <div class="desc">وذلك بعد إتمام شروط ومتطلبات العضوية حسب اللوائح والسياسات المعتمدة من <span>Business Pro</span></div>
            </center>
            <div class="clearfix">
                <div class="ceo">
                    <h2 class="ceoTitle">اعتماد توقيع منح العضوية</h2>
                    <span class="ceoName">أ. أحمد بن عبدالله المنهبي</span>
                    <span class="ceoPosition">الرئيس التنفيذي لمجتمع الشاب الريادي</span>
                </div>
            </div>
            <div class="cerFooter">
                <div class="col-xs-4 date">
                    <span class="text">رقـم الاعـتـمـاد # <?php echo e($code); ?>-452673</span>
                    <span class="text">صلاحـيـة الشهادة الى <?php echo e($end_date[0] . ' ' . $end_date[1] . ' ' . $end_date[2]); ?></span>
                    <span class="text">معتمدة الشهادة منذ <?php echo e($start_date[0] . ' ' . $start_date[1] . ' ' . $start_date[2]); ?></span>
                </div>
                <span class="col-xs-4 webSite text-center">www.alshabalriyadi.com</span>
                <p class="col-xs-4 copyRights text-left">علامة تجارية مسجلة لـ <span>www.businesspro.sa</span></p>
            </div>
        </div>
    </body>

</html><?php /**PATH /var/www/Server/Projects/Ryady/Backend/app/Modules/UserCertificate/Views/certificate.blade.php ENDPATH**/ ?>
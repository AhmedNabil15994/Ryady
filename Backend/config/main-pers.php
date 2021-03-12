<?php


return [


    'mainIndexes' => [
        'DashboardControllers@Dashboard' => [
            'title'=>'list-dashboard',
            'viewTitle'=>'الرئيسية',
            'modulePermissions' => '',
        ],
        'TopMenuControllers@index' => [
            'title'=>'list-topMenus',
            'viewTitle'=>'القوائم العلوية',
            'modulePermissions' => 'edit-topMenu,add-topMenu,delete-topMenu,sort-topMenu,charts-topMenu',
        ],
        'BottomMenuControllers@index' => [
            'title'=>'list-bottomMenus',
            'viewTitle'=>'القوائم السفلية',
            'modulePermissions' => 'edit-bottomMenu,add-bottomMenu,delete-bottomMenu,sort-bottomMenu,charts-bottomMenu',
        ],
        'SideMenuControllers@index' => [
            'title'=>'list-sideMenus',
            'viewTitle'=>'القوائم الجانبية',
            'modulePermissions' => 'edit-sideMenu,add-sideMenu,delete-sideMenu,sort-sideMenu,charts-sideMenu',
        ],
        'PageControllers@index' => [
            'title'=>'list-pages',
            'viewTitle'=>'الصفحات',
            'modulePermissions' => 'edit-page,add-page,delete-page,sort-page,charts-page,uploadImage-page,deleteImage-page',
        ],
        'SliderControllers@index' => [
            'title'=>'list-sliders',
            'viewTitle'=>'الاسلايدر',
            'modulePermissions' => 'edit-slider,add-slider,delete-slider,sort-slider,charts-slider,uploadImage-slider,deleteImage-slider',
        ],
        'EventControllers@index' => [
            'title'=>'list-events',
            'viewTitle'=>'الفعاليات',
            'modulePermissions' => 'edit-event,add-event,delete-event,sort-event,charts-event,uploadImage-event,deleteImage-event',
        ],
        'AdvantageControllers@index' => [
            'title'=>'list-advantages',
            'viewTitle'=>'مميزاتنا',
            'modulePermissions' => 'edit-advantage,add-advantage,delete-advantage,sort-advantage,charts-advantage',
        ],
        'BenefitControllers@index' => [
            'title'=>'list-benefits',
            'viewTitle'=>'منهجيتنا',
            'modulePermissions' => 'edit-benefit,add-benefit,delete-benefit,sort-benefit,charts-benefit',
        ],
        'CityControllers@index' => [
            'title'=>'list-cities',
            'viewTitle'=>'المدن',
            'modulePermissions' => 'edit-city,add-city,delete-city,sort-city,charts-city',
        ],
        'ContactUsControllers@index' => [
            'title'=>'list-contactUs',
            'viewTitle'=>'الاتصال بنا',
            'modulePermissions' => 'edit-contactUs,delete-contactUs,reply-contactUs,charts-contactUs',
        ],
        'GroupsControllers@index' => [
            'title'=>'list-groups',
            'viewTitle'=>'مجموعات المشرفين',
            'modulePermissions' => 'edit-group,add-group,delete-group,sort-group,charts-group',
        ],
        'UsersControllers@index' => [
            'title'=>'list-users',
            'viewTitle'=>'المستخدمين',
            'modulePermissions' => 'edit-user,add-user,delete-user,sort-user,charts-user,uploadImage-user,deleteImage-user',
        ],
        'UsersControllers@admins' => [
            'title'=>'list-admins',
            'viewTitle'=>'المشرفين والاداريين',
            'modulePermissions' => 'edit-user,add-user,delete-user,sort-user,charts-user,uploadImage-user,deleteImage-user',
        ],
        'LogControllers@index' => [
            'title'=>'list-logs',
            'viewTitle'=>'سجلات الدخول للنظام',
            'modulePermissions' => 'edit-log,delete-log,sort-log,charts-log',
        ],
        'VariablesControllers@index' => [
            'title'=>'list-variables',
            'viewTitle'=>'اعدادات عامة',
            'modulePermissions' => 'edit-variable',
        ],
        'VariablesControllers@panel' => [
            'title'=>'list-variables2',
            'viewTitle'=>'اعدادات لوحة التحكم',
            'modulePermissions' => 'edit-variable2',
        ],
        'BlockedUsersControllers@index' => [
            'title'=>'list-blockedUsers',
            'viewTitle'=>'الاعضاء المحظورة',
            'modulePermissions' => 'edit-blockedUser,delete-blockedUser,sort-blockedUser,charts-blockedUser',
        ],  
        'TargetGroupControllers@index' => [
            'title'=>'list-targets',
            'viewTitle'=>'الفئة المستهدفة',
            'modulePermissions' => 'edit-target,add-target,delete-target,sort-target,charts-target',
        ],
        'MembershipControllers@index' => [
            'title'=>'list-memberships',
            'viewTitle'=>'العضويات',
            'modulePermissions' => 'edit-membership,add-membership,delete-membership,sort-membership,charts-membership,uploadImage-membership,deleteImage-membership',
        ],
        'FeatureGroupControllers@index' => [
            'title'=>'list-features',
            'viewTitle'=>'مميزات العضويات',
            'modulePermissions' => 'edit-feature,add-feature,delete-feature,sort-feature,charts-feature',
        ],
        'OrderCategoryControllers@index' => [
            'title'=>'list-order-categories',
            'viewTitle'=>'تصنيفات الطلبات',
            'modulePermissions' => 'edit-order-category,add-order-category,delete-order-category,sort-order-category,charts-order-category',
        ],
        'OrderControllers@index' => [
            'title'=>'list-orders',
            'viewTitle'=>'طلبات الخدمات',
            'modulePermissions' => 'edit-order,delete-order,sort-order,charts-order',
        ],
        'ProjectCategoryControllers@index' => [
            'title'=>'list-project-categories',
            'viewTitle'=>'تصنيفات المشاريع',
            'modulePermissions' => 'edit-project-category,add-project-category,delete-project-category,sort-project-category,charts-project-category',
        ],
        'ProjectControllers@index' => [
            'title'=>'list-projects',
            'viewTitle'=>'مشاريع الاعضاء',
            'modulePermissions' => 'edit-project,add-project,delete-project,sort-project,charts-project,uploadImage-project,deleteImage-project',
        ],
        'CouponControllers@index' => [
            'title'=>'list-coupons',
            'viewTitle'=>'كوبونات الخصم',
            'modulePermissions' => 'edit-coupon,add-coupon,delete-coupon,sort-coupon,charts-coupon',
        ],
        'BlogCategoryControllers@index' => [
            'title'=>'list-blog-categories',
            'viewTitle'=>'تصنيفات المدونة',
            'modulePermissions' => 'edit-blog-category,add-blog-category,delete-blog-category,sort-blog-category,charts-blog-category',
        ],
        'BlogControllers@index' => [
            'title'=>'list-blogs',
            'viewTitle'=>'المدونة',
            'modulePermissions' => 'edit-blog,add-blog,delete-blog,sort-blog,charts-blog,uploadImage-blog,deleteImage-blog',
        ],
        'UserCardControllers@index' => [
            'title'=>'list-user-cards',
            'viewTitle'=>'بطاقات الاعضاء',
            'modulePermissions' => 'edit-user-card,add-user-card,delete-user-card,sort-user-card,charts-user-card',
        ],
        'UserRequestControllers@index' => [
            'title'=>'list-user-requests',
            'viewTitle'=>'طلبات البطاقة المطبوعة',
            'modulePermissions' => 'edit-user-request,delete-user-request,sort-user-request,charts-user-request',
        ],
        'CardPromotionsControllers@index' => [
            'title'=>'list-card-promotions',
            'viewTitle'=>'ترقيات البطاقات',
            'modulePermissions' => 'edit-card-promotion,delete-card-promotion,sort-card-promotion,charts-card-promotion',
        ],
        'UserCertificateControllers@index' => [
            'title'=>'list-user-certificate',
            'viewTitle'=>'شهادات العضوية',
            'modulePermissions' => 'download-user-certificate',
        ],
        'UserMemberControllers@index' => [
            'title'=>'list-user-members',
            'viewTitle'=>'اعضاء الشاب الريادي',
            'modulePermissions' => 'edit-user-member,add-user-member,delete-user-member,sort-user-member,charts-user-member',
        ],

    ],

    


];

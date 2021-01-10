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


    ],

    


];

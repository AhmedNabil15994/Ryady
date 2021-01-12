<?php return array (
  'app' => 
  array (
    'name' => 'تكافل',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost',
    'asset_url' => NULL,
    'timezone' => 'UTC',
    'locale' => 'ar',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:X6D2osu9XeyBJ3ssjn02ucumpKTvKmb8N1lDRyDjfKM=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Watson\\Active\\ActiveServiceProvider',
      23 => 'Yajra\\DataTables\\DataTablesServiceProvider',
      24 => 'App\\Providers\\AppServiceProvider',
      25 => 'App\\Providers\\AuthServiceProvider',
      26 => 'App\\Providers\\EventServiceProvider',
      27 => 'App\\Providers\\RouteServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Active' => 'Watson\\Active\\Facades\\Active',
      'DataTables' => 'Yajra\\DataTables\\Facades\\DataTables',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'pusher',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/var/www/Server/Projects/Ryady/Backend/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => NULL,
        'secret' => NULL,
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'tkafl_cache',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'ryady',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'ryady',
        'username' => 'root',
        'password' => 'toor',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'ryady',
        'username' => 'root',
        'password' => 'toor',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'ryady',
        'username' => 'root',
        'password' => 'toor',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'tkafl_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
      'starts_with' => false,
    ),
    'index_column' => 'DT_RowIndex',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
      'resource' => 'Yajra\\DataTables\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => ':column :direction NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/Server/Projects/Ryady/Backend/storage/app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/var/www/Server/Projects/Ryady/Backend/storage/app/public',
        'url' => 'http://localhost/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
        'url' => NULL,
        'endpoint' => NULL,
      ),
    ),
    'links' => 
    array (
      '/var/www/Server/Projects/Ryady/Backend/public/storage' => '/var/www/Server/Projects/Ryady/Backend/storage/app/public',
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/var/www/Server/Projects/Ryady/Backend/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/var/www/Server/Projects/Ryady/Backend/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => '/var/www/Server/Projects/Ryady/Backend/storage/logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'smtp',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'host' => 'mail.3z9.org',
        'port' => '465',
        'encryption' => 'SSL',
        'username' => 'board@servers.com.sa',
        'password' => 'nBvt[42hgw.s',
        'timeout' => NULL,
        'auth_mode' => NULL,
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'mailgun' => 
      array (
        'transport' => 'mailgun',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
    ),
    'from' => 
    array (
      'address' => 'noreply@board.servers.com.sa',
      'name' => 'تكافل',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/var/www/Server/Projects/Ryady/Backend/resources/views/vendor/mail',
      ),
    ),
  ),
  'main-pers' => 
  array (
    'mainIndexes' => 
    array (
      'DashboardControllers@Dashboard' => 
      array (
        'title' => 'list-dashboard',
        'viewTitle' => 'الرئيسية',
        'modulePermissions' => '',
      ),
      'TopMenuControllers@index' => 
      array (
        'title' => 'list-topMenus',
        'viewTitle' => 'القوائم العلوية',
        'modulePermissions' => 'edit-topMenu,add-topMenu,delete-topMenu,sort-topMenu,charts-topMenu',
      ),
      'BottomMenuControllers@index' => 
      array (
        'title' => 'list-bottomMenus',
        'viewTitle' => 'القوائم السفلية',
        'modulePermissions' => 'edit-bottomMenu,add-bottomMenu,delete-bottomMenu,sort-bottomMenu,charts-bottomMenu',
      ),
      'SideMenuControllers@index' => 
      array (
        'title' => 'list-sideMenus',
        'viewTitle' => 'القوائم الجانبية',
        'modulePermissions' => 'edit-sideMenu,add-sideMenu,delete-sideMenu,sort-sideMenu,charts-sideMenu',
      ),
      'PageControllers@index' => 
      array (
        'title' => 'list-pages',
        'viewTitle' => 'الصفحات',
        'modulePermissions' => 'edit-page,add-page,delete-page,sort-page,charts-page,uploadImage-page,deleteImage-page',
      ),
      'SliderControllers@index' => 
      array (
        'title' => 'list-sliders',
        'viewTitle' => 'الاسلايدر',
        'modulePermissions' => 'edit-slider,add-slider,delete-slider,sort-slider,charts-slider,uploadImage-slider,deleteImage-slider',
      ),
      'AdvantageControllers@index' => 
      array (
        'title' => 'list-advantages',
        'viewTitle' => 'مميزاتنا',
        'modulePermissions' => 'edit-advantage,add-advantage,delete-advantage,sort-advantage,charts-advantage',
      ),
      'BenefitControllers@index' => 
      array (
        'title' => 'list-benefits',
        'viewTitle' => 'منهجيتنا',
        'modulePermissions' => 'edit-benefit,add-benefit,delete-benefit,sort-benefit,charts-benefit',
      ),
      'CityControllers@index' => 
      array (
        'title' => 'list-cities',
        'viewTitle' => 'المدن',
        'modulePermissions' => 'edit-city,add-city,delete-city,sort-city,charts-city',
      ),
      'ContactUsControllers@index' => 
      array (
        'title' => 'list-contactUs',
        'viewTitle' => 'الاتصال بنا',
        'modulePermissions' => 'edit-contactUs,delete-contactUs,reply-contactUs,charts-contactUs',
      ),
      'GroupsControllers@index' => 
      array (
        'title' => 'list-groups',
        'viewTitle' => 'مجموعات المشرفين',
        'modulePermissions' => 'edit-group,add-group,delete-group,sort-group,charts-group',
      ),
      'UsersControllers@index' => 
      array (
        'title' => 'list-users',
        'viewTitle' => 'المشرفين والاداريين',
        'modulePermissions' => 'edit-user,add-user,delete-user,sort-user,charts-user,uploadImage-user,deleteImage-user',
      ),
      'LogControllers@index' => 
      array (
        'title' => 'list-logs',
        'viewTitle' => 'سجلات الدخول للنظام',
        'modulePermissions' => 'edit-log,delete-log,sort-log,charts-log',
      ),
      'VariablesControllers@index' => 
      array (
        'title' => 'list-variables',
        'viewTitle' => 'اعدادات عامة',
        'modulePermissions' => 'edit-variable',
      ),
      'VariablesControllers@panel' => 
      array (
        'title' => 'list-variables2',
        'viewTitle' => 'اعدادات لوحة التحكم',
        'modulePermissions' => 'edit-variable2',
      ),
      'BlockedUsersControllers@index' => 
      array (
        'title' => 'list-blockedUsers',
        'viewTitle' => 'الاعضاء المحظورة',
        'modulePermissions' => 'edit-blockedUser,delete-blockedUser,sort-blockedUser,charts-blockedUser',
      ),
      'TargetGroupControllers@index' => 
      array (
        'title' => 'list-targets',
        'viewTitle' => 'الفئة المستهدفة',
        'modulePermissions' => 'edit-target,add-target,delete-target,sort-target,charts-target',
      ),
      'MembershipControllers@index' => 
      array (
        'title' => 'list-memberships',
        'viewTitle' => 'العضويات',
        'modulePermissions' => 'edit-membership,add-membership,delete-membership,sort-membership,charts-membership,uploadImage-membership,deleteImage-membership',
      ),
      'FeatureGroupControllers@index' => 
      array (
        'title' => 'list-features',
        'viewTitle' => 'مميزات العضويات',
        'modulePermissions' => 'edit-feature,add-feature,delete-feature,sort-feature,charts-feature',
      ),
      'OrderCategoryControllers@index' => 
      array (
        'title' => 'list-order-categories',
        'viewTitle' => 'تصنيفات الطلبات',
        'modulePermissions' => 'edit-order-category,add-order-category,delete-order-category,sort-order-category,charts-order-category',
      ),
      'OrderControllers@index' => 
      array (
        'title' => 'list-orders',
        'viewTitle' => 'طلبات الخدمات',
        'modulePermissions' => 'edit-order,delete-order,sort-order,charts-order',
      ),
      'ProjectCategoryControllers@index' => 
      array (
        'title' => 'list-project-categories',
        'viewTitle' => 'تصنيفات المشاريع',
        'modulePermissions' => 'edit-project-category,add-project-category,delete-project-category,sort-project-category,charts-project-category',
      ),
      'ProjectControllers@index' => 
      array (
        'title' => 'list-projects',
        'viewTitle' => 'مشاريع الاعضاء',
        'modulePermissions' => 'edit-project,add-project,delete-project,sort-project,charts-project,uploadImage-project,deleteImage-project',
      ),
      'CouponControllers@index' => 
      array (
        'title' => 'list-coupons',
        'viewTitle' => 'كوبونات الخصم',
        'modulePermissions' => 'edit-coupon,add-coupon,delete-coupon,sort-coupon,charts-coupon',
      ),
      'BlogCategoryControllers@index' => 
      array (
        'title' => 'list-blog-categories',
        'viewTitle' => 'تصنيفات المدونة',
        'modulePermissions' => 'edit-blog-category,add-blog-category,delete-blog-category,sort-blog-category,charts-blog-category',
      ),
      'BlogControllers@index' => 
      array (
        'title' => 'list-blogs',
        'viewTitle' => 'المدونة',
        'modulePermissions' => 'edit-blog,add-blog,delete-blog,sort-blog,charts-blog,uploadImage-blog,deleteImage-blog',
      ),
    ),
  ),
  'permissions' => 
  array (
    'AuthControllers@login' => 'login',
    'AuthControllers@doLogin' => 'doLogin',
    'AuthControllers@logout' => 'logout',
    'AuthControllers@register' => 'register',
    'DashboardControllers@Dashboard' => 'list-dashboard',
    'UsersControllers@index' => 'list-users',
    'UsersControllers@edit' => 'edit-user',
    'UsersControllers@update' => 'edit-user',
    'UsersControllers@fastEdit' => 'edit-user',
    'UsersControllers@add' => 'add-user',
    'UsersControllers@create' => 'add-user',
    'UsersControllers@delete' => 'delete-user',
    'UsersControllers@arrange' => 'sort-user',
    'UsersControllers@sort' => 'sort-user',
    'UsersControllers@charts' => 'charts-user',
    'UsersControllers@uploadImage' => 'uploadImage-user',
    'UsersControllers@deleteImage' => 'deleteImage-user',
    'GroupsControllers@index' => 'list-groups',
    'GroupsControllers@edit' => 'edit-group',
    'GroupsControllers@update' => 'edit-group',
    'GroupsControllers@fastEdit' => 'edit-group',
    'GroupsControllers@add' => 'add-group',
    'GroupsControllers@create' => 'add-group',
    'GroupsControllers@delete' => 'delete-group',
    'GroupsControllers@arrange' => 'sort-group',
    'GroupsControllers@sort' => 'sort-group',
    'GroupsControllers@charts' => 'charts-group',
    'TopMenuControllers@index' => 'list-topMenus',
    'TopMenuControllers@edit' => 'edit-topMenu',
    'TopMenuControllers@update' => 'edit-topMenu',
    'TopMenuControllers@fastEdit' => 'edit-topMenu',
    'TopMenuControllers@add' => 'add-topMenu',
    'TopMenuControllers@create' => 'add-topMenu',
    'TopMenuControllers@delete' => 'delete-topMenu',
    'TopMenuControllers@arrange' => 'sort-topMenu',
    'TopMenuControllers@sort' => 'sort-topMenu',
    'TopMenuControllers@charts' => 'charts-topMenu',
    'BottomMenuControllers@index' => 'list-bottomMenus',
    'BottomMenuControllers@edit' => 'edit-bottomMenu',
    'BottomMenuControllers@update' => 'edit-bottomMenu',
    'BottomMenuControllers@add' => 'add-bottomMenu',
    'BottomMenuControllers@fastEdit' => 'edit-bottomMenu',
    'BottomMenuControllers@create' => 'add-bottomMenu',
    'BottomMenuControllers@delete' => 'delete-bottomMenu',
    'BottomMenuControllers@arrange' => 'sort-bottomMenu',
    'BottomMenuControllers@sort' => 'sort-bottomMenu',
    'BottomMenuControllers@charts' => 'charts-bottomMenu',
    'AdvantageControllers@index' => 'list-advantages',
    'AdvantageControllers@edit' => 'edit-advantage',
    'AdvantageControllers@fastEdit' => 'edit-advantage',
    'AdvantageControllers@update' => 'edit-advantage',
    'AdvantageControllers@add' => 'add-advantage',
    'AdvantageControllers@create' => 'add-advantage',
    'AdvantageControllers@delete' => 'delete-advantage',
    'AdvantageControllers@arrange' => 'sort-advantage',
    'AdvantageControllers@sort' => 'sort-advantage',
    'AdvantageControllers@charts' => 'charts-advantage',
    'BenefitControllers@index' => 'list-benefits',
    'BenefitControllers@edit' => 'edit-benefit',
    'BenefitControllers@update' => 'edit-benefit',
    'BenefitControllers@fastEdit' => 'edit-benefit',
    'BenefitControllers@add' => 'add-benefit',
    'BenefitControllers@create' => 'add-benefit',
    'BenefitControllers@delete' => 'delete-benefit',
    'BenefitControllers@arrange' => 'sort-benefit',
    'BenefitControllers@sort' => 'sort-benefit',
    'BenefitControllers@charts' => 'charts-benefit',
    'CityControllers@index' => 'list-cities',
    'CityControllers@edit' => 'edit-city',
    'CityControllers@update' => 'edit-city',
    'CityControllers@fastEdit' => 'edit-city',
    'CityControllers@add' => 'add-city',
    'CityControllers@create' => 'add-city',
    'CityControllers@delete' => 'delete-city',
    'CityControllers@arrange' => 'sort-city',
    'CityControllers@sort' => 'sort-city',
    'CityControllers@charts' => 'charts-city',
    'PageControllers@index' => 'list-pages',
    'PageControllers@edit' => 'edit-page',
    'PageControllers@update' => 'edit-page',
    'PageControllers@fastEdit' => 'edit-page',
    'PageControllers@add' => 'add-page',
    'PageControllers@create' => 'add-page',
    'PageControllers@delete' => 'delete-page',
    'PageControllers@arrange' => 'sort-page',
    'PageControllers@sort' => 'sort-page',
    'PageControllers@charts' => 'charts-page',
    'PageControllers@uploadImage' => 'uploadImage-page',
    'PageControllers@deleteImage' => 'deleteImage-page',
    'SliderControllers@index' => 'list-sliders',
    'SliderControllers@edit' => 'edit-slider',
    'SliderControllers@update' => 'edit-slider',
    'SliderControllers@fastEdit' => 'edit-slider',
    'SliderControllers@add' => 'add-slider',
    'SliderControllers@create' => 'add-slider',
    'SliderControllers@delete' => 'delete-slider',
    'SliderControllers@arrange' => 'sort-slider',
    'SliderControllers@sort' => 'sort-slider',
    'SliderControllers@charts' => 'charts-slider',
    'SliderControllers@uploadImage' => 'uploadImage-slider',
    'SliderControllers@deleteImage' => 'deleteImage-slider',
    'ContactUsControllers@index' => 'list-contactUs',
    'ContactUsControllers@edit' => 'edit-contactUs',
    'ContactUsControllers@fastEdit' => 'edit-contactUs',
    'ContactUsControllers@update' => 'edit-contactUs',
    'ContactUsControllers@reply' => 'reply-contactUs',
    'ContactUsControllers@postReply' => 'reply-contactUs',
    'ContactUsControllers@delete' => 'delete-contactUs',
    'ContactUsControllers@charts' => 'charts-contactUs',
    'LogControllers@index' => 'list-logs',
    'LogControllers@fastEdit' => 'edit-log',
    'LogControllers@delete' => 'delete-log',
    'LogControllers@arrange' => 'sort-log',
    'LogControllers@sort' => 'sort-log',
    'LogControllers@charts' => 'charts-log',
    'BlockedUsersControllers@index' => 'list-blockedUsers',
    'BlockedUsersControllers@fastEdit' => 'edit-blockedUser',
    'BlockedUsersControllers@delete' => 'delete-blockedUser',
    'BlockedUsersControllers@arrange' => 'sort-blockedUser',
    'BlockedUsersControllers@sort' => 'sort-blockedUser',
    'BlockedUsersControllers@charts' => 'charts-blockedUser',
    'VariablesControllers@index' => 'list-variables',
    'VariablesControllers@update' => 'edit-variable',
    'VariablesControllers@panel' => 'list-variables2',
    'VariablesControllers@uploadImage' => 'edit-variable2',
    'VariablesControllers@deleteImage' => 'edit-variable2',
    'SideMenuControllers@index' => 'list-sideMenus',
    'SideMenuControllers@edit' => 'edit-sideMenu',
    'SideMenuControllers@update' => 'edit-sideMenu',
    'SideMenuControllers@add' => 'add-sideMenu',
    'SideMenuControllers@fastEdit' => 'edit-sideMenu',
    'SideMenuControllers@create' => 'add-sideMenu',
    'SideMenuControllers@delete' => 'delete-sideMenu',
    'SideMenuControllers@arrange' => 'sort-sideMenu',
    'SideMenuControllers@sort' => 'sort-sideMenu',
    'SideMenuControllers@charts' => 'charts-sideMenu',
    'MembershipControllers@index' => 'list-memberships',
    'MembershipControllers@edit' => 'edit-membership',
    'MembershipControllers@update' => 'edit-membership',
    'MembershipControllers@fastEdit' => 'edit-membership',
    'MembershipControllers@add' => 'add-membership',
    'MembershipControllers@create' => 'add-membership',
    'MembershipControllers@delete' => 'delete-membership',
    'MembershipControllers@arrange' => 'sort-membership',
    'MembershipControllers@sort' => 'sort-membership',
    'MembershipControllers@charts' => 'charts-membership',
    'MembershipControllers@uploadImage' => 'uploadImage-membership',
    'MembershipControllers@deleteImage' => 'deleteImage-membership',
    'FeatureControllers@index' => 'list-features',
    'FeatureControllers@edit' => 'edit-feature',
    'FeatureControllers@update' => 'edit-feature',
    'FeatureControllers@fastEdit' => 'edit-feature',
    'FeatureControllers@add' => 'add-feature',
    'FeatureControllers@create' => 'add-feature',
    'FeatureControllers@delete' => 'delete-feature',
    'FeatureControllers@arrange' => 'sort-feature',
    'FeatureControllers@sort' => 'sort-feature',
    'FeatureControllers@charts' => 'charts-feature',
    'TargetGroupControllers@index' => 'list-targets',
    'TargetGroupControllers@edit' => 'edit-target',
    'TargetGroupControllers@update' => 'edit-target',
    'TargetGroupControllers@fastEdit' => 'edit-target',
    'TargetGroupControllers@add' => 'add-target',
    'TargetGroupControllers@create' => 'add-target',
    'TargetGroupControllers@delete' => 'delete-target',
    'TargetGroupControllers@arrange' => 'sort-target',
    'TargetGroupControllers@sort' => 'sort-target',
    'TargetGroupControllers@charts' => 'charts-target',
    'OrderCategoryControllers@index' => 'list-order-categories',
    'OrderCategoryControllers@edit' => 'edit-order-category',
    'OrderCategoryControllers@update' => 'edit-order-category',
    'OrderCategoryControllers@fastEdit' => 'edit-order-category',
    'OrderCategoryControllers@add' => 'add-order-category',
    'OrderCategoryControllers@create' => 'add-order-category',
    'OrderCategoryControllers@delete' => 'delete-order-category',
    'OrderCategoryControllers@arrange' => 'sort-order-category',
    'OrderCategoryControllers@sort' => 'sort-order-category',
    'OrderCategoryControllers@charts' => 'charts-order-category',
    'OrderControllers@index' => 'list-orders',
    'OrderControllers@softDelete' => 'delete-order',
    'OrderControllers@delete' => 'delete-order',
    'OrderControllers@fastEdit' => 'edit-order',
    'OrderControllers@changeStatus' => 'edit-order',
    'OrderControllers@charts' => 'charts-order',
    'ProjectControllers@index' => 'list-projects',
    'ProjectControllers@edit' => 'edit-project',
    'ProjectControllers@update' => 'edit-project',
    'ProjectControllers@fastEdit' => 'edit-project',
    'ProjectControllers@add' => 'add-project',
    'ProjectControllers@create' => 'add-project',
    'ProjectControllers@delete' => 'delete-project',
    'ProjectControllers@arrange' => 'sort-project',
    'ProjectControllers@sort' => 'sort-project',
    'ProjectControllers@charts' => 'charts-project',
    'ProjectControllers@uploadImage' => 'uploadImage-project',
    'ProjectControllers@deleteImage' => 'deleteImage-project',
    'ProjectControllers@deleteImages' => 'deleteImage-project',
    'ProjectCategoryControllers@index' => 'list-project-categories',
    'ProjectCategoryControllers@edit' => 'edit-project-category',
    'ProjectCategoryControllers@update' => 'edit-project-category',
    'ProjectCategoryControllers@fastEdit' => 'edit-project-category',
    'ProjectCategoryControllers@add' => 'add-project-category',
    'ProjectCategoryControllers@create' => 'add-project-category',
    'ProjectCategoryControllers@delete' => 'delete-project-category',
    'ProjectCategoryControllers@arrange' => 'sort-project-category',
    'ProjectCategoryControllers@sort' => 'sort-project-category',
    'ProjectCategoryControllers@charts' => 'charts-project-category',
    'CouponControllers@index' => 'list-coupons',
    'CouponControllers@edit' => 'edit-coupon',
    'CouponControllers@update' => 'edit-coupon',
    'CouponControllers@fastEdit' => 'edit-coupon',
    'CouponControllers@add' => 'add-coupon',
    'CouponControllers@create' => 'add-coupon',
    'CouponControllers@delete' => 'delete-coupon',
    'CouponControllers@arrange' => 'sort-coupon',
    'CouponControllers@sort' => 'sort-coupon',
    'CouponControllers@charts' => 'charts-coupon',
    'BlogCategoryControllers@index' => 'list-blog-categories',
    'BlogCategoryControllers@edit' => 'edit-blog-category',
    'BlogCategoryControllers@update' => 'edit-blog-category',
    'BlogCategoryControllers@fastEdit' => 'edit-blog-category',
    'BlogCategoryControllers@add' => 'add-blog-category',
    'BlogCategoryControllers@create' => 'add-blog-category',
    'BlogCategoryControllers@delete' => 'delete-blog-category',
    'BlogCategoryControllers@arrange' => 'sort-blog-category',
    'BlogCategoryControllers@sort' => 'sort-blog-category',
    'BlogCategoryControllers@charts' => 'charts-blog-category',
    'BlogControllers@index' => 'list-blogs',
    'BlogControllers@edit' => 'edit-blog',
    'BlogControllers@update' => 'edit-blog',
    'BlogControllers@fastEdit' => 'edit-blog',
    'BlogControllers@add' => 'add-blog',
    'BlogControllers@create' => 'add-blog',
    'BlogControllers@delete' => 'delete-blog',
    'BlogControllers@arrange' => 'sort-blog',
    'BlogControllers@sort' => 'sort-blog',
    'BlogControllers@charts' => 'charts-blog',
    'BlogControllers@uploadImage' => 'uploadImage-blog',
    'BlogControllers@deleteImage' => 'deleteImage-blog',
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => NULL,
        'secret' => NULL,
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'suffix' => NULL,
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/var/www/Server/Projects/Ryady/Backend/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'tkafl_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/var/www/Server/Projects/Ryady/Backend/resources/views',
      1 => '/var/www/Server/Projects/Ryady/Backend/app/Modules',
    ),
    'compiled' => '/var/www/Server/Projects/Ryady/Backend/storage/framework/views',
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => false,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
    ),
    'send_logs_as_events' => true,
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'active' => 
  array (
    'class' => 'active',
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 94,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);

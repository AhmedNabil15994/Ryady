<!DOCTYPE html>
<html lang="en" dir="{{DIRECTION}}">
    <head>
        @php
        
        $title = \App\Models\Variable::getVar('العنوان عربي');
        $desc = \App\Models\Variable::getVar('الوصف عربي');
        $metas = \App\Models\Variable::getVar('الكلمات الدليلية عربي');
        $meta = json_decode($metas)[0]->value;
        @endphp
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ $desc }}">
        <meta name="keywords" content="{{ $meta }}">
        <title>{{ $title }} - @yield('title')</title>
        @include('Layouts.head')
        @include('Partials.notf_messages')
    </head>
    <body>
        @include('Layouts.mobileMenu')    
        <div class="transformPage">
            @include('Layouts.header')
            @yield('content')
            @include('Layouts.footer')
        </div>

        @include('Partials.loginModal')
        @include('Partials.privacyModal')
        @include('Partials.profileModal')

        @yield('modals')
        
        @include('Layouts.scripts')
    </body>
</html>
@extends('Layouts.master')

@section('title','تسجيل الدخول')

@section('content')
<section class="signin--section">
	<div class="container">
	    <div class="signin--bg">
	        <div class="image">
	            <img src="./images/home1.png" alt="">
	        </div>
	        <div class="overlay">

	        </div>
	    </div>
	</div>
	<div class="singin--form white__theme">
	    <div class="container">
	        <form action="{{ URL::to('/profile/login') }}" method="POST" class="information-form">
	        	@csrf
	            <h2 class="text-center black__theme"> تسجيل الدخول</h2>
	            <input class="light__theme" name="phone" type="number" required placeholder="رقم الجوال">
	            <input class="light__theme" name="password" type="password" required placeholder="كلمة المرور">
	            <button class="btn btn__dark--theme" type="submit">ارسال</button>
	        </form>
	    </div>
	</div>
</section>
@endsection
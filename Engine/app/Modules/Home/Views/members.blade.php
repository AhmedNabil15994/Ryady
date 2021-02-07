@extends('Layouts.master')

@section('title','اعضاء الشاب الريادي')

@section('content')

    <div class="members">
        <div class="container">
            <div class="row">
                @foreach($data->data->data as $member)
                <div class="col-xs-6">
                    <div class="memb">
                        <img src="{{ $member->user->photo }}" />
                        <h2 class="name">أ.{{ $member->user->name_ar }}</h2>
                        <a href="#" class="btnStyle" data-toggle="modal" data-area="{{ $member->user_id }}" data-target="#profile">الملف الشخصي</a>
                    </div>
                </div>
                @endforeach
            </div>
            @include('Partials.pagination')
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('/assets/components/profile.js') }}"></script>
@endsection
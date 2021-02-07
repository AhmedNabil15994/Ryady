@extends('Layouts.master')

@section('title','شبكة تنفيذية VIP')

@section('content')
    <div class="vipPage">
        <div class="container">
            <div class="row">
                @foreach($data->data->data as $member)
                <div class="col-xs-6 col-sm-4">
                    <a href="#" data-toggle="modal" data-area="{{ $member->user_id }}" data-target="#profile" class="itemVip">
                        <img src="{{ $member->user->photo }}" alt="" />
                        <div class="mask">
                            <h2 class="title">أ.{{ $member->user->name_ar }}</h2>
                        </div>
                    </a>
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
@extends('Layouts.master')

@section('title','الشاب الريادي')

@section('content')
<!-- start section entrepreneur -->
<div class="entrepreneur">
    <div class="container">
        @foreach($data->advantages as $key => $oneAdvantage)
        <div class="entereItem">
            <i class="{{ $oneAdvantage->icon }} icon"></i>
            <h2 class="title">{{ $oneAdvantage->title }}</h2>
            <div class="desc">
                {{ $oneAdvantage->description }}
            </div>
        </div>
        @endforeach
        <div class="entereItem methodology">
            <i class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="31.481" height="31.481" viewBox="0 0 31.481 31.481">
                  <g id="presentation_1_" data-name="presentation (1)" transform="translate(-0.001)">
                    <g id="Group_1202" data-name="Group 1202" transform="translate(0.001)">
                      <g id="Group_1201" data-name="Group 1201" transform="translate(0)">
                        <path id="Path_940" data-name="Path 940" d="M30.252,3.443H16.971V1.23a1.23,1.23,0,0,0-2.459,0V3.443H1.231A1.23,1.23,0,0,0,0,4.673V24.348a1.23,1.23,0,0,0,1.23,1.23H11.3L5.271,29.2a1.23,1.23,0,1,0,1.265,2.109l9.205-5.523,9.205,5.523A1.23,1.23,0,0,0,26.212,29.2l-6.031-3.618H30.252a1.23,1.23,0,0,0,1.23-1.23V4.673A1.23,1.23,0,0,0,30.252,3.443Zm-1.23,19.675H2.46V5.9H29.023Z" transform="translate(-0.001)" fill="#8795af"/>
                      </g>
                    </g>
                    <g id="Group_1204" data-name="Group 1204" transform="translate(4.305 18.815)">
                      <g id="Group_1203" data-name="Group 1203">
                        <path id="Path_941" data-name="Path 941" d="M78.732,306h-7.5a1.23,1.23,0,0,0,0,2.459h7.5a1.23,1.23,0,0,0,0-2.459Z" transform="translate(-70.001 -305.998)" fill="#8795af"/>
                      </g>
                    </g>
                    <g id="Group_1206" data-name="Group 1206" transform="translate(4.305 7.747)">
                      <g id="Group_1205" data-name="Group 1205">
                        <path id="Path_942" data-name="Path 942" d="M91.644,126H71.231a1.23,1.23,0,0,0,0,2.459H91.644a1.23,1.23,0,0,0,0-2.459Z" transform="translate(-70.001 -125.999)" fill="#8795af"/>
                      </g>
                    </g>
                    <g id="Group_1208" data-name="Group 1208" transform="translate(4.305 13.281)">
                      <g id="Group_1207" data-name="Group 1207">
                        <path id="Path_943" data-name="Path 943" d="M84.881,216H71.231a1.23,1.23,0,0,0,0,2.459h13.65a1.23,1.23,0,1,0,0-2.459Z" transform="translate(-70.001 -215.999)" fill="#8795af"/>
                      </g>
                    </g>
                  </g>
                </svg>
            </i>
            <h2 class="title">منهجيتنا</h2>
            <ul class="links clearfix">
                @foreach($data->benefits as $benefit)
                <li><a><i class="flaticon-left-arrow"></i> {{ $benefit->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!-- end section entrepreneur -->


<div class="addProject">
    <div class="container">
        <h2 class="titleStyle">الفئات المستهدفة</h2>
        <div class="row">
            @foreach($data->targets as $target)
            <div class="col-xs-6">
                <a href="#" class="item">
                    <i class="icon {{ $target->icon }}"></i>
                    <h2 class="title">{{ $target->title }}</h2>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

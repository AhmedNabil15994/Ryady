@extends('Layouts.master')

@section('title','مميزات العضوية '.$data->membership->title)

@section('styles')
@endsection

@section('content')
	
    <div class="features">
        <div class="container">
            <div class="table-responsive">
                <table class="tableMemb">
                    <thead>
                      <tr>
                        <th colspan="2">مزايا العضوية</th>
                        <th>{{ $data->membership->title }} <span>{{ $data->membership->price }}</span></th>
                      </tr>
                  </thead>
                  <tbody>
                        @foreach($data->features as $feature)
                        <tr>
                            <td>{{ $feature->title }}</td>
                            <td>{{ $feature->description }}</td>
                                @if(in_array($feature->id, $data->membership->features))
                                    @if($feature->title == 'شهادة عضوية')
                                        @if($data->membership->id == 2)
                                        <td>الكترونية</td>
                                        @elseif($data->membership->id == 3)
                                        <td>مطبوعة</td>
                                        @else
                                        <td><i class="flaticon-remove"></i></td>
                                        @endif
                                    @else
                                    <td><i class="fa fa-check"></i></td>
                                    @endif
                                @else
                                <td><i class="flaticon-remove"></i></td>
                                @endif
                        </tr>
                        @endforeach
                  </tbody>
                </table>
            </div>
            
        </div>
    </div>
@endsection

@section('scripts')

@endsection
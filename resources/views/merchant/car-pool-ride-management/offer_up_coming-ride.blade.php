@extends('merchant.layouts.main')
@section('content')

    <div class="page">
        <div class="page-content">
            @include('merchant.shared.errors-and-messages')
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">

                    </div>
                    <h3 class="panel-title"><i class="far fa-car" aria-hidden="true"></i>
                        @lang("$string_file.up_coming") @lang("$string_file.ride")
                    </h3>
                </header>
                <div class="panel-body container-fluid">
                    <form action="{{route('merchant.carpool.offer_up_coming.rides.search')}}" method="get">
                        <div class="table_search row p-3">
                            <div class="col-md-2 col-xs-6 active-margin-top">@lang("$string_file.search") @lang("$string_file.by")
                            </div>
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <div class="input-group">
                                    <input type="text" name="id"
                                           placeholder=" @lang("$string_file.user") @lang("$string_file.ride") @lang("$string_file.id")"
                                           class="form-control col-md-12 col-xs-12">
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <div class="input-group">
                                    <input type="text" id="" name="date"
                                           placeholder="@lang("$string_file.from") @lang("$string_file.date")"
                                           class="form-control col-md-12 col-xs-12 customDatePicker2"
                                           id="datepickersearch" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <div class="input-group">
                                    <input type="text" id="" name="date1"
                                           placeholder="@lang("$string_file.to") @lang("$string_file.date")"
                                           class="form-control col-md-12 col-xs-12 customDatePicker2"
                                           id="datepickersearch" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-6 form-group active-margin-top">
                                <button class="btn btn-primary" type="submit"><i
                                            class="fa fa-search"
                                            aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                        <table id="customDataTable" class="display nowrap table table-hover table-striped w-full"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>@lang("$string_file.sn")</th>
                    
                                <th>@lang("$string_file.ride") @lang("$string_file.id")</th>
                                
                              
                                <th>@lang("$string_file.offer") @lang("$string_file.user") @lang("$string_file.details")</th>
                                <th>@lang("$string_file.area")</th>
                                <th>@lang("$string_file.promo") @lang("$string_file.code")</th>
                                
                                <th>@lang("$string_file.ride") @lang("$string_file.date")</th>
                            
                                <th>@lang("$string_file.payment") @lang("$string_file.status")</th>
                                <th>@lang("$string_file.ac_ride")</th>
                                <th>Action</th>
                                <th>@lang("$string_file.ride") @lang("$string_file.details")</th>
                               
                            </tr>
                            </thead>
                            <tbody>

                            @php $sr = $upcoming_ride->firstItem() @endphp
                            @foreach($upcoming_ride as $upcoming)
                                <tr>
                                    <td>{{$sr}}</td>

                                 

                                    <td>{{$upcoming->id}}</td>
                                   
                                    <td>
                                        
                                        {{ucwords($upcoming->User->first_name)." ".$upcoming->User->last_name}}
                                        <br>
                                        {{$upcoming->User->UserPhone ? : ''}}
                                        <br>
                                        {{$upcoming->User->email ? : ''}}
                                    </td>
                                    <td>{{$upcoming->CountryArea->CountryAreaName}}</td>
                                    <td>{{$upcoming->User->promo_code}}</td>

                                    <td>{{date('Y-m-d ',$upcoming->ride_timestamp)}}</td>

                                    <td>{{$upcoming->payment_status == 0 ? trans("$string_file.pending") : ($upcoming->payment_status == 1 ? trans("$string_file.success") : ' ')}}</td>
                                    <td>{{$upcoming->ac_ride == 0 ? trans("$string_file.no") : ($upcoming->ac_ride == 1 ? trans("$string_file.yes") : ' ')}}</td>
                                    <td>@if($upcoming->ride_status == 2 ||$upcoming->ride_status == 1)
                                                <a href="{{ route('merchant.carpool.all.active-deactive',['id'=>$upcoming->id,'status'=>5]) }}"
                                                   data-original-title="Cancel" data-toggle="tooltip"
                                                   data-placement="top"
                                                   class="btn btn-sm btn-danger menu-icon btn_eye_dis action_btn">
                                                    <i class="fa fa-eye-slash"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('merchant.carpool.all.active-deactive',['id'=>$upcoming->id,'status'=>2]) }}"
                                                   data-original-title="Active" data-toggle="tooltip"
                                                   data-placement="top"
                                                   class="btn btn-sm btn-success menu-icon btn_eye action_btn">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endif
                                    </td>
                                     <td>
                                        <a href="{{route('merchant.offer.user.details',['id'=>$upcoming->id])}}"
                                           data-original-title="@lang("$string_file.ride") @lang("$string_file.details") "
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           class="btn btn-sm btn-primary menu-icon btn_car action_btn">
                                            <i class="fa fa-car"></i> </a>
                                    </td>
                                </tr>
                                @php $sr++  @endphp
                            @endforeach
                            </tbody>
                            @include('merchant.shared.table-footer', ['table_data' => $upcoming_ride, 'data' =>$data])
                        </table>
                </div>
            </div>
            </div>
        </div>
@endsection
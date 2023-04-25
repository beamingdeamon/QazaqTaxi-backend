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
                        @lang("$string_file.cancel") @lang("$string_file.ride")
                    </h3>
                </header>
                <div class="panel-body container-fluid">
                    <form action="{{route('merchant.carpool.offer_cancel.rides.search')}}" method="get">
                        <div class="table_search row p-3">
                          
                             <div class="col-md-2 col-xs-6 active-margin-top">@lang("$string_file.search") @lang("$string_file.by")
                            </div>
                            <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                <div class="input-group">
                                    <input type="text" name="keyword"
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
                        <th>@lang("$string_file.ride") @lang("$string_file.details")</th>
                      

                    </tr>
                    </thead>
                    <tbody>
                    @php $sr = $cancel_ride->firstItem() @endphp
                    @foreach($cancel_ride as $cancel)
                        <tr>
                            <td>{{$sr}}</td>

                            <td>{{$cancel->id ? : ''}}</td>

                          
                          
                            <td>
                                {{ucwords($cancel->User->first_name)." ".$cancel->User->last_name}}
                                <br>
                                {{$cancel->User->UserPhone ? : ''}}
                                <br>
                                {{$cancel->User->email ? : ''}}
                            </td>
                            <td>{{$cancel->CountryArea->CountryAreaName}}</td>
                            <td>{{$cancel->promo_code}}</td>
                            <td>{{date('Y-m-d ',$cancel->ride_timestamp)}}</td>
                           
                            <td>{{$cancel->payment_status == 0 ? trans("$string_file.pending") : ($cancel->payment_status == 1 ? trans("$string_file.success") : ' ')}}</td>
                            <td>{{$cancel->ac_ride == 0 ? trans("$string_file.no") : ($cancel->ac_ride == 1 ? trans("$string_file.yes") : ' ')}}</td>
                          <td>
                                        <a href="{{route('merchant.offer.user.details',['id'=>$cancel->id])}}"
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
                </table>
            </div>
            </div>
        </div>
    </div>
@endsection
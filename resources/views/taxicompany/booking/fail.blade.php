@extends('merchant.layouts.main')
@section('content')
    <div class="app-content content">
        <div class="container-fluid">
            <div class="content-wrapper">

                <div class="card shadow mb-5">
                    <div class="card-header py-3">
                        <div class="content-header row">
                            <div class="content-header-left col-md-8 col-12 mb-2">
                                <h3 class="content-header-title mb-0 d-inline-block">
                                    <i class=" fa fa-car" aria-hidden="true"></i>
                                    @lang("$string_file.failed_rides")</h3>
                            </div>
                            <div class="content-header-right col-md-4 col-12">
                                <div class="btn-group float-md-right">
                                    <div class="heading-elements">
                                        <div class="btn-group float-md-right">
                                            <div class="heading-elements">
                                                <a href="{{route('excel.ridefailed')}}"
                                                   data-original-title="@lang("$string_file.export")" data-toggle="tooltip">
                                                    <button type="button" class="btn btn-icon btn-primary mr-1"><i
                                                                class="fa fa-download"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=" ">

                        <div class="content-body">
                            <section id="horizontal">
                                <div class="row">
                                    <div class="col-12">
                                        @if(session('noridefailedexport'))
                                            <div class="row container mx-auto">
                                                <div class="col-md-12 alert alert-icon-right alert-info alert-dismissible mb-2"
                                                     role="alert">
                                                    <span class="alert-icon"><i class="fa fa-info"></i></span>
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <strong>@lang('admin.message452')</strong>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="card">
                                            <div class="card-body card-header p-3">
                                                <form method="post" action="{{ route('merchant.failride.search') }}">
                                                    @csrf
                                                    <div class="table_search row ">
                                                        <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                                            Search By:
                                                        </div>
                                                        <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                                            <div class="input-group">
                                                                <input type="text" id="" name="booking_id"
                                                                       placeholder="@lang("$string_file.ride_id")"
                                                                       class="form-control col-md-12 col-xs-12">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 col-xs-12 form-group active-margin-top">
                                                            <div class="input-group">
                                                                <input type="text" id="" name="rider"
                                                                       placeholder="@lang("$string_file.user_details")"
                                                                       class="form-control col-md-12 col-xs-12">
                                                            </div>
                                                            <p>@lang('admin.searchhint')</p>
                                                        </div>
                                                        <div class="col-sm-2  col-xs-12 form-group active-margin-top">
                                                            <button class="btn btn-primary" type="submit"
                                                                    name="seabt12"><i
                                                                        class="fa fa-search" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="card-content collapse show" style="margin:1%">
                                                <table id="dataTable" class="table  table-striped table-bordered ">
                                                    <thead>
                                                    <tr>
                                                        <th>@lang("$string_file.ride_id")</th>
                                                        <th>@lang("$string_file.ride_type")</th>
                                                        <th>@lang("$string_file.user_details")</th>
                                                        <th>@lang("$string_file.ride_details")</th>
                                                        <th>@lang("$string_file.pickup_location")</th>
                                                        <th>@lang("$string_file.failed_reason")</th>
                                                        <th>@lang('admin.bookingdate')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($bookings as $booking)
                                                        <tr>
                                                            <td>{{ $booking->id }}
                                                            </td>
                                                            <td>
                                                                @if($booking->booking_type == 1)
                                                                    @lang("$string_file.ride_now")
                                                                @else
                                                                    @lang("$string_file.ride_later")
                                                                @endif
                                                            </td>

                                                            @if(Auth::user()->demo == 1)
                                                                <td>
                                                                 <span class="long_text">
                                                               {{ "********".substr($booking->User->UserName,-2) }}
                                                            <br>
                                                            {{ "********".substr($booking->User->UserPhone,-2) }}
                                                            <br>
                                                            {{ "********".substr($booking->User->email,-2) }}
                                                                </span>
                                                                </td>
                                                            @else
                                                                <td>
                                                                 <span class="long_text">
                                                                {{ $booking->User->UserName }}
                                                                <br>
                                                                {{ $booking->User->UserPhone }}
                                                                <br>
                                                                {{ $booking->User->email }}
                                                                </span>
                                                                </td>
                                                            @endif

                                                            <td>
                                                                {{ $booking->CountryArea->LanguageSingle == "" ? $booking->CountryArea->LanguageAny->AreaName : $booking->CountryArea->LanguageSingle->AreaName }}
                                                                <br>
                                                                @php
                                                                  $service_text = ($booking->ServiceType) ? $booking->ServiceType->serviceName : $booking->deliveryType->name ;
                                                                @endphp
                                                                {{ $service_text }}<br>
                                                                @if($booking->VehicleType) {{ $booking->VehicleType->VehicleTypeName }} @else
                                                                    ------- @endif</td>
                                                            <td><a class="long_text hyperLink" target="_blank"
                                                                   href="https://www.google.com/maps/place/{{ $booking->pickup_location }}">{{ $booking->pickup_location }}</a>
                                                            </td>
                                                            <td>
                                                                @if($booking->failreason == 1)
                                                                    @lang("$string_file.configuration_not_found")
                                                                @else
                                                                    @lang("$string_file.driver_not_found")
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{ $booking->created_at->toDayDateTimeString() }}
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="col-sm-12">
                                                <div class="pagination1">{{ $bookings->links() }}</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('merchant.layouts.main')
@section('content')
    <div class="page">
        <div class="page-content">
            @include('merchant.shared.errors-and-messages')
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    <div class="panel-actions">
                        @if(!empty($info_setting) && $info_setting->edit_text != "")
                            <button class="btn btn-icon btn-primary float-right" style="margin:10px"
                                    data-target="#examplePositionSidebar" data-toggle="modal" type="button">
                                <i class="wb-info ml-1 mr-1" title="Info" style=""></i>
                            </button>
                        @endif
                        <div class="btn-group float-right" style="margin:10px">
                            <a href="{{ route('country.index') }}">
                                <button type="button" class="btn btn-icon btn-success"><i class="wb-reply"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <h3 class="panel-title"><i class="wb-edit" aria-hidden="true"></i>
                        @lang("$string_file.edit_country")
                        (@lang("$string_file.you_are_adding_in") {{ strtoupper(Config::get('app.locale')) }})
                    </h3>
                </header>
                <div class="panel-body container-fluid">
                    <form method="POST" class="steps-validation wizard-notification"
                          enctype="multipart/form-data"
                          action="{{route('country.update', $country->id)}}">
                        {{method_field('PUT')}}
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstName3">
                                        @lang("$string_file.name")
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="name"
                                           name="name"
                                           placeholder=""
                                           value="@if(!empty($country->LanguageCountrySingle)) {{ $country->LanguageCountrySingle->name }} @endif"
                                           required>
                                    @if ($errors->has('name'))
                                        <label class="text-danger">{{ $errors->first('name') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ProfileImage">
                                        @lang("$string_file.isd_code")
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                          id="basic-addon1">+</span>
                                        </div>
                                        <input type="number" class="form-control" readonly
                                               id="phonecode"
                                               name="phonecode"
                                               value="{{  str_replace("+","",$country->phonecode) }}"
                                               placeholder="@lang("$string_file.isd_code")"
                                               required>
                                    </div>
                                    @if ($errors->has('phonecode'))
                                        <label class="text-danger">{{ $errors->first('phonecode') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastName3">
                                        @lang("$string_file.iso_code_detail")
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="isocode"
                                           name="isoCode"
                                           {{--                                           readonly--}}
                                           value="{{ $country->isoCode }}"
                                           placeholder=""
                                           required>
                                    @if ($errors->has('isoCode'))
                                        <label class="text-danger">{{ $errors->first('isoCode') }}</label>
                                    @endif
                                    <label class="text-danger">Eg:ISO code of $ is USD</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastName3">
                                        @lang("$string_file.country_code")
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="country_code" readonly
                                           name="country_code"
                                           value="{{ old('country_code',$country->country_code) }}"
                                           placeholder="@lang('admin.country_code')" required>
                                    @if ($errors->has('country_code'))
                                        <label class="text-danger">{{ $errors->first('country_code') }}</label>
                                    @endif
                                    <label class="text-danger">Eg:Country code of India is IN</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="location3">@lang("$string_file.distance_unit")
                                    </label>
                                    <select class="c-select form-control"
                                            id="distance_unit"
                                            name="distance_unit" required>
                                        <option value="1"
                                                @if($country->distance_unit == 1) selected @endif>@lang("$string_file.km")</option>
                                        <option value="2"
                                                @if($country->distance_unit == 2) selected @endif>@lang("$string_file.miles")</option>
                                    </select>
                                    @if ($errors->has('distance_unit'))
                                        <label class="text-danger">{{ $errors->first('distance_unit') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ProfileImage">
                                        @lang("$string_file.min_digits")
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control"
                                           id="min_digits"
                                           name="minNumPhone"
                                           placeholder=""
                                           value="{{ $country->minNumPhone }}" required
                                           min="1" max="25">
                                    @if ($errors->has('minNumPhone'))
                                        <label class="text-danger">{{ $errors->first('minNumPhone') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="max_digits">
                                        @lang("$string_file.max_digits")
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control"
                                           id="max_digits"
                                           name="maxNumPhone"
                                           placeholder=""
                                           value="{{ $country->maxNumPhone }}" required
                                           min="1" max="25">
                                    @if ($errors->has('maxNumPhone'))
                                        <label class="text-danger">{{ $errors->first('maxNumPhone') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="online_transaction">
                                        @lang("$string_file.online_transaction_code")
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="online_transaction"
                                           name="online_transaction" required
                                           value="{{ $country->transaction_code }}"
                                           placeholder="">
                                    @if ($errors->has('online_transaction'))
                                        <label class="text-danger">{{ $errors->first('online_transaction') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sequance">
                                        @lang("$string_file.sequence")
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="sequance"
                                           name="sequance" required value="{{ $country->sequance }}"
                                           placeholder="">
                                    @if ($errors->has('sequance'))
                                        <label class="text-danger">{{ $errors->first('sequance') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($applicationConfig->user_document == 1)
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>@lang("$string_file.document_configuration")</h4>
                                    <hr>
                                    <div class="form-group">
                                        <label for="Documents">
                                            @lang("$string_file.document_for_user")
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="select2 form-control" name="document[]"
                                                id="document"
                                                data-placeholder="@lang("$string_file.select_document")"
                                                multiple="multiple">
                                            @foreach($documents as $document)
                                                <option
                                                        @if(in_array($document->id, array_pluck($country->documents,'id'))) selected
                                                        @endif
                                                        value="{{ $document->id }}"
                                                >
                                                    {{ $document->DocumentName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('document'))
                                            <label class="text-danger">{{ $errors->first('document') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($carpooling_enable)
                            {{--@if ($configurations->countrywise_payment_gateway == 1)--}}
                                {{--<h5><i class="wb-cash"></i>@lang('common.payment')  @lang('common.gateway') @lang('common.configuration')</h5><hr>--}}
                                {{--<div class="row">--}}
                                {{--<div class="col-md-4">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="Documents">--}}
                                            {{--@lang("$string_file.carpooling")    @lang('common.cashin') @lang('common.configuration')--}}
                                            {{--<span class="text-danger">*</span>--}}
                                        {{--</label>--}}
                                        {{--<select class="select2 form-control"--}}
                                                {{--name="payment_option[]"--}}
                                                {{--id="payment_option"--}}
                                                {{--data-placeholder="@lang('common.select') @lang('common.payment') @lang('common.gateway')"--}}
                                                {{--multiple="multiple">--}}
                                            {{--@foreach($payment_options as $payment_option)--}}
                                                {{--<option @if(in_array($payment_option->id, array_pluck($country->paymentoption,'id'))) selected @endif value="{{ $payment_option->id }}">--}}
                                                    {{--{{ $payment_option->payment_gateway_provider }}--}}
                                                {{--</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                        {{--@if ($errors->has('payment_option'))--}}
                                            {{--<label class="text-danger">{{ $errors->first('payment_option') }}</label>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="Documents">--}}
                                        {{--@lang("$string_file.carpooling")    @lang('common.cashout') @lang('common.configuration')--}}
                                        {{--<span class="text-danger">*</span>--}}
                                    {{--</label>--}}
                                    {{--<label for="manual">--}}
                                        {{--<input type="checkbox" id="manual" name="manual" value="1"--}}
                                                {{--@php if($country->manual_cashout==1){echo "checked";}@endphp>Bank Transfer</label><br>--}}
                                        {{--<select class="select2 form-control"--}}
                                                {{--name="payin_option[]"--}}
                                                {{--id="payin_option"--}}
                                                {{--data-placeholder=" @lang('common.select') @lang('common.payment') @lang('common.method')"--}}
                                                {{--multiple="multiple">--}}
                                            {{--@foreach($payment_options as $payment_option)--}}
                                                {{--<option @if(in_array($payment_option->id, array_pluck($country->paymentcashout,'id'))) selected @endif value="{{ $payment_option->id }}">--}}
                                                    {{--{{ $payment_option->payment_gateway_provider }}--}}
                                                {{--</option>--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--@if ($errors->has('payin_option'))--}}
                                        {{--<label class="text-danger">{{ $errors->first('payin_option') }}</label>--}}
                                    {{--@endif--}}
                                    {{--<div class="from-group">--}}
                                        {{--<label><input type="checkbox" id="automatic_cashin" name="automatic_cashin" value="1" @php if($country->automatic_cashout==1){echo "checked";}@endphp>--}}
                                            {{--Please register with number that have a wallet activate on it--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--@endif--}}
                            <h5><i class="wb-cash"></i> @lang('common.commission') @lang('common.configuration')</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="wallet_to_bank">
                                            @lang('common.wallet_to_bank')
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" class="form-control" id="wallet_to_bank"
                                               name="wallet_to_bank"
                                               value="{{ $country->wallet_to_bank }}"
                                               placeholder="">
                                        @if ($errors->has('wallet_to_bank'))
                                            <label class="text-danger">{{ $errors->first('wallet_to_bank') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="bank_to_wallet">
                                            @lang('common.bank_to_wallet')
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" class="form-control" id="bank_to_wallet"
                                               name="bank_to_wallet"
                                               value="{{ $country->bank_to_wallet }}"
                                               placeholder="">
                                        @if ($errors->has('bank_to_wallet'))
                                            <label class="text-danger">{{ $errors->first('bank_to_wallet') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <h5><i class="wb-cash"></i>@lang("$string_file.carpooling")   @lang('common.amount') @lang('common.configuration')</h5><hr>
                            <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="minimum_amount">
                                        @lang('common.minimum_payin')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="minimum_payin"
                                           name="minimum_payin"
                                           value="{{$country->minimum_payin}}"
                                           placeholder="">
                                    @if ($errors->has('minimum_payin'))
                                        <label class="text-danger">{{ $errors->first('minimum_payin') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="maximum_amount">
                                        @lang('common.maximum_payin')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="maximum_payin"
                                           name="maximum_payin"
                                           value="{{$country->maximum_payin}}"
                                           placeholder="">
                                    @if ($errors->has('maximum_payin'))
                                        <label class="text-danger">{{ $errors->first('maximum_payin') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="minimum_amount">
                                        @lang('common.minimum_payout')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="minimum_payout"
                                           name="minimum_payout"
                                           value="{{$country->minimum_payout}}"
                                           placeholder="">
                                    @if ($errors->has('minimum_payout'))
                                        <label class="text-danger">{{ $errors->first('minimum_payout') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="maximum_amount">
                                        @lang('common.maximum_payout')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="maximum_payout"
                                           name="maximum_payout"
                                           value="{{$country->maximum_payout}}"
                                           placeholder="">
                                    @if ($errors->has('maximum_payout'))
                                        <label class="text-danger">{{ $errors->first('maximum_payout') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        @if (isset($configurations->country_wise_payment_gateway) && $configurations->country_wise_payment_gateway == 1)
                            <h5><i class="wb-book"></i> @lang("$string_file.country_wise_payment_gateway")</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Documents">
                                            @lang("$string_file.payment_gateway")
                                        </label>
                                        <select class="select form-control"
                                                name="country_wise_payment_gateway"
                                                id="country_wise_payment_gateway">
                                            <option value="">@lang("$string_file.all")</option>
                                            @foreach($country_wise_payment_gateway_list as $key => $item)
                                                <option value="{{ $key }}" @if(isset($country->payment_option_ids) && $country->payment_option_ids == $key) selected @endif>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('country_wise_payment_gateway'))
                                            <label class="text-danger">{{ $errors->first('country_wise_payment_gateway') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($edit_permission)
                            <div class="form-actions d-flex flex-row-reverse p-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-check-circle"></i> @lang("$string_file.update")
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('merchant.shared.info-setting',['info_setting'=>$info_setting,'page_name'=>'edit_text'])
@endsection
@section('js')
    <script>
        $(document).ready(
            function () {
                $("input[name=additional_details]").each(function () {
                    // console.log($(this).attr('value'));
                    if ($(this).is(':checked')) {
                        if ($(this).attr('value') == 1) {
                            $('#parameter_name').attr('required', true);
                            $('#parameter_name').attr('disabled', false);
                            $('#parameter_name').parent().parent().removeClass('hide');
                            $('#placeholder').attr('required', true);
                            $('#placeholder').attr('disabled', false);
                            $('#placeholder').parent().parent().removeClass('hide');

                        }
                        //console.log("IN IF: "+$(this).attr('id')+' '+$(this).attr('value'));
                        // $(this).removeAttr('required');
                    }
                });
            });

        function extraparameters(data) {
            //console.log(data);
            if (data == 1) {
                $('#parameter_name').attr('required', true);
                $('#parameter_name').attr('disabled', false);
                $('#parameter_name').parent().parent().removeClass('hide');
                $('#placeholder').attr('required', true);
                $('#placeholder').attr('disabled', false);
                $('#placeholder').parent().parent().removeClass('hide');

            } else {
                $('#parameter_name').attr('required', false);
                $('#parameter_name').attr('disabled', true);
                $('#parameter_name').parent().parent().addClass('hide');
                $('#placeholder').attr('required', false);
                $('#placeholder').attr('disabled', true);
                $('#placeholder').parent().parent().addClass('hide');
            }
        }

        $(document).ready(function () {
            $('form#countryForm').submit(function () {
                $(this).find(':input[type=submit]').prop('disabled', true);
            });
        });
        $(function () {
            $("#manual").click(function () {
                if ($(this).is(":checked")) {
                    $("#payin_option").attr("disabled", "disabled");
                    $("#automatic_cashin").attr("disabled", "disabled");


                } else {
                    $("#payin_option").removeAttr("disabled");
                    $("#payin_option").focus();
                    $("#automatic_cashin").removeAttr("disabled");
                    $("#automatic_cashin").focus();
                }
            });
        });
    </script>
@endsection

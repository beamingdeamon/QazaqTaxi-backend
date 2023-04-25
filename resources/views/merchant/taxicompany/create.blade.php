@extends('merchant.layouts.main')
@section('content')
    <div class="page">
        <div class="page-content">
            @include('merchant.shared.errors-and-messages')
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <div class="panel-actions">
                        <div class="btn-group float-right" >
                            <a href="{{ route('merchant.taxi-company') }}">
                                <button type="button" class="btn btn-icon btn-success"style="margin:10px"><i
                                            class="wb-reply"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <h3 class="panel-title">
                        <i class="icon wb-plus" aria-hidden="true"></i>
                        @lang("$string_file.add_taxi_company")
                    </h3>
                </div>
                @php $id = isset($company->id) ? $company->id : NULL  @endphp
                <div class="panel-body container-fluid">
                    <section id="validation">
                        <form method="POST" class="steps-validation wizard-notification"
                              enctype="multipart/form-data" action="{{ route('merchant.taxi-company.save',$id) }}">
                            @csrf
                            {!!  Form::hidden('id',$id) !!}
                                   <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="firstName3">
                                                @lang("$string_file.name")
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="name"
                                                   name="name" value="{{isset($company->name) ? $company->name : NULL}}"
                                                   placeholder="" required>
                                            @if ($errors->has('name'))
                                                <label class="text-danger">{{ $errors->first('name') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="form-group">
                                           <label for="emailAddress5">
                                               @lang("$string_file.country")
                                               <span class="text-danger">*</span>
                                           </label>
                                           <select class="form-control" id="country" name="country">
                                               <option value=""> -- @lang("$string_file.select")--</option>
                                               @foreach($countries as $country)
                                                   <option value="{{$country->id}}" @if(!empty($company))@if($company->country_id == $country->id) selected @endif @endif>{{$country->CountryName}}</option>
                                               @endforeach
                                           </select>
                                           @if ($errors->has('country'))
                                               <label class="text-danger">{{ $errors->first('country') }}</label>
                                           @endif
                                       </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="firstName3">
                                                @lang("$string_file.phone")
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="phone"
                                                   name="phone" value="{{isset($company->phone) ? $company->phone : NULL}}"
                                                   placeholder="" required>
                                            @if ($errors->has('phone'))
                                                <label class="text-danger">{{ $errors->first('phone') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="emailAddress5">
                                                @lang("$string_file.company_contact_pers")
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="contact_person"
                                                   name="contact_person" value="{{isset($company->contact_person) ? $company->contact_person : NULL}}"
                                                   placeholder="" required>
                                            @if ($errors->has('contact_person'))
                                                <label class="text-danger">{{ $errors->first('contact_person') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lastName3">
                                                @lang("$string_file.email")
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" class="form-control" id="email"
                                                   name="email" value="{{isset($company->email) ? $company->email : NULL}}"
                                                   placeholder="" required>
                                            @if ($errors->has('email'))
                                                <label class="text-danger">{{ $errors->first('email') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="emailAddress5">
                                                @lang("$string_file.address")
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="address"
                                                   name="address" value="{{isset($company->address) ? $company->address : NULL}}"
                                                   placeholder="" required>
                                            @if ($errors->has('address'))
                                                <label class="text-danger">{{ $errors->first('address') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="areaList">
                                        <div class="form-group">
                                            <label for="emailAddress5">
                                                @lang("$string_file.password")
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input class="form-control" type="password" name="password" id="password" >
                                            @if ($errors->has('password'))
                                                <label class="text-danger">{{ $errors->first('password') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 corporate_inr">
                                        <div class="form-group">
                                            <label for="location3"> @lang("$string_file.logo")
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input style="height: 0%;" class="form-control" type="file" name="company_logo" id="company_logo">
                                            @if ($errors->has('company_logo'))
                                                <label class="text-danger">{{ $errors->first('company_logo') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <h4> @lang("$string_file.bank_details")</h4>
                            <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lastName3">
                                                 @lang("$string_file.bank_name")
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="bank_name"
                                                   name="bank_name" value="{{old('bank_name',isset($company->bank_name) ? $company->bank_name : NULL)}}"
                                                   placeholder="">
                                            @if ($errors->has('bank_name'))
                                                <label class="text-danger">{{ $errors->first('bank_name') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lastName3">
                                                @lang("$string_file.account_holder_name")
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                   id="account_holder_name" value="{{old('account_holder_name',isset($company->account_holder_name) ? $company->account_holder_name : NULL)}}"
                                                   name="account_holder_name">
                                            @if ($errors->has('account_holder_name'))
                                                <label class="text-danger">{{ $errors->first('account_holder_name') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lastName3">
                                                @lang("$string_file.account_number")
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control required"
                                                   id="account_number" value="{{isset($company->account_number) ? $company->account_number : NULL}}"
                                                   name="account_number"
                                                   >
                                            @if ($errors->has('account_number'))
                                                <label class="text-danger">{{ $errors->first('account_number') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location3" id="transaction_label">
                                                @lang("$string_file.online_transaction_code")
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                   id="online_transaction"
                                                   name="online_transaction"
                                                   value="{{old('online_transaction',isset($company->online_transaction) ? $company->online_transaction : NULL)}}"
                                                   placeholder="">
                                            @if ($errors->has('online_transaction'))
                                                <label class="text-danger">{{ $errors->first('online_transaction')
                                                                }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location3">@lang("$string_file.account_type")
                                                <span class="text-danger">*</span></label>
                                            <select type="text" class="form-control"
                                                    id="account_types"
                                                    name="account_types">
                                                @foreach($account_types as $account_type)
                                                    <option value="{{$account_type->id}}" value="{{$account_type->id}}" @if(!empty($company)) @if($company->account_type_id == $account_type->id) selected @endif @endif > @if($account_type->LangAccountTypeSingle){{$account_type->LangAccountTypeSingle->name}} @else {{$account_type->LangAccountTypeAny->name}} @endif</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('account_types'))
                                                <label class="text-danger">{{ $errors->first('account_types')
                                                                }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            <div class="form-actions d-flex flex-row-reverse p-2">
                                @if($id == NULL || $edit_permission)
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-check-circle"></i> @lang("$string_file.save")
                                    </button>
                                 @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
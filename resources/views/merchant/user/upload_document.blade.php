@extends('merchant.layouts.main')
@section('content')
    <div class="page">
        <div class="page-content">
            @include("merchant.shared.errors-and-messages")
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="{{route('users.index')}}" data-toggle="tooltip">
                            <button type="button" class="btn btn-icon btn-success float-right" style="margin: 10px;">
                                <i class="wb-reply" title="@lang('common.all') @lang('common.users')"></i>
                            </button>
                        </a>
                    </div>
                    <h3 class="panel-title"><i class="icon wb-plus" aria-hidden="true"></i>
                        @lang('common.upload') @lang('common.documents')</h3>
                </header>
                <div class="panel-body container-fluid">
                    <form method="POST" class="steps-validation wizard-notification"
                          enctype="multipart/form-data"
                          action="{{ route('user.save.document',$user->id) }}">
                        @csrf
                        <h5 class="form-section col-md-12" style="color: black;">
                            <i class="fa fa-file"></i> @lang("common.personal") @lang("common.document")
                        </h5>
                        <hr>
                        @php
                            $arr_uploaded_doc = [];
                        @endphp
                        @if(isset($uploaded_documents) && !empty($uploaded_documents))
                            @php
                                $arr_uploaded_doc = array_column($uploaded_documents,NULL,'document_id');
                            @endphp
                        @endif
                        @foreach($documents as $document)
                            @php $expire_date = null;
$document_file = null; @endphp
                            @if(isset($arr_uploaded_doc[$document['id']]))
                                @php
                                    $expire_date = $arr_uploaded_doc[$document['id']]['expire_date'];
                                    $document_file = $arr_uploaded_doc[$document['id']]['document_file'];
                                    $document_number = $arr_uploaded_doc[$document['id']]['document_number'];
                                @endphp
                            @endif
                            {!! Form::hidden('all_doc[]',$document['id']) !!}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="emailAddress5">
                                            {{ $document->DocumentName }}:
                                            <span class="text-danger">*</span>
                                        </label>
                                        @if(in_array($document['pivot']['document_id'],array_keys($arr_uploaded_doc)))
                                            <a href="{{get_image($document_file,'user_document')}}"
                                               target="_blank">@lang("common.view") </a>
                                        @endif
                                        <input type="file" class="form-control" id="document"
                                               name="document[{{$document['id']}}]"
                                               placeholder=""
                                               @if($document['documentNeed'] == 1 && empty($document_file)))
                                               required @endif>
                                        @if ($errors->has('documentname'))
                                            <label class="text-danger">{{ $errors->first('documentname') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if($document->expire_date == 1)
                                        <div class="form-group">
                                            <label for="datepicker">@lang("common.expire") @lang("common.date")
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                        <span class="input-group-text"><i class="icon wb-calendar"
                                                          aria-hidden="true"></i></span>
                                                </div>
                                                <input type="text"
                                                       class="form-control customDatePicker1"
                                                       name="expiredate[{{$document->id}}]"
                                                       value="{{$expire_date}}"
                                                       placeholder="@lang("common.expire") @lang("common.date")  "
                                                       @if($document['expire_date'] == 1 && empty($expire_date)) required
                                                       @endif
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                @if($document->document_number_required == 1)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="emailAddress5">
                                                @lang('common.document') @lang('common.number') :
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="document_number"
                                                   name="document_number[{{$document['id']}}]"
                                                   placeholder="@lang('common.document') @lang('common.number')"
                                                   value="{{isset($document_number) ? $document_number : ''}}"
                                                   required>
                                            @if ($errors->has('document_number'))
                                                <label class="text-danger">{{ $errors->first('document_number') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        <div class="form-actions float-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check-circle"></i> @lang('common.save')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.toast').toast('show');
    </script>
@endsection

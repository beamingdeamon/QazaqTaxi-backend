@extends('merchant.layouts.main')
@section('content')
    <div class="page">
        <div class="page-content">
            @include('merchant.shared.errors-and-messages')
            <div class="panel panel-bordered">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a class="heading-elements-toggle"><i
                                    class="ft-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <h3 class="panel-title">
                        <i class="fa-globe" aria-hidden="true"></i>
                        @lang("$string_file.website_headings")
                    </h3>
                </header>
                <div class="panel-body container-fluid">
                    <section id="validation">
                        <form method="POST" class="steps-validation wizard-notification"
                              enctype="multipart/form-data" action="{{ route('website-user-home-headings.store') }}">
                            @csrf
                            <h5 class="form-section col-md-12" ><i class="wb-add-file"></i> @lang("$string_file.header")
                            </h5>
                            <hr>
                            @php  $id =  !empty($details->id) ? $details->id : NULL; @endphp
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="app_logo">
                                            @lang("$string_file.app_logo") (512x512):
                                            <span class="text-danger">*</span>
                                            @if(!empty($details->logo))
                                                <a href="{{get_image($details->logo,'website_images')}}" target="_blank">@lang("$string_file.view")</a>
                                            @endif
                                        </label>
                                        <input type="file" class="form-control" id="app_logo"
                                               name="app_logo"
                                               placeholder="" @if(empty($details)) required @endif>

                                        @if ($errors->has('app_logo'))
                                            <label class="text-danger">{{ $errors->first('app_logo') }}</label>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="header_title">
                                            @lang("$string_file.title") :
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="title"
                                               name="app_title"
                                               placeholder="" value="{{!empty($details)  ? $details->WebsiteFeature->Title : ""}}" required>
                                    </div>
                                </div>
                            </div>

                            @if($total_segments > 1)
                                <h5 class="form-section col-md-12" ><i class="wb-add-file"></i> @lang("$string_file.home_screen_banner")
                                </h5>
                                <hr>
                                <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="banner_image">
                                            @lang("$string_file.banner_image") (1500x1000):
                                            <span class="text-danger">*</span>
                                            @if(!empty($details->user_banner_image))
                                                <a href="{{get_image($details->user_banner_image,'website_images')}}" target="_blank">@lang("$string_file.view")</a>
                                            @endif
                                        </label>
                                        <input type="file" class="form-control" id="banner_image"
                                               name="banner_image"
                                               placeholder="" value="" @if(empty($details)) required @endif>
                                        @if ($errors->has('banner_image'))
                                            <label class="text-danger">{{ $errors->first('banner_image') }}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="banner_title">
                                            @lang("$string_file.title") :
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="banner_title"
                                               name="banner[title]"
                                               placeholder="" value="{{isset($arr_feature_banner['title']) ? $arr_feature_banner['title'] : ""}}" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="banner_title">
                                            @lang("$string_file.description") :
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control" id="banner_description"
                                               name="banner[description]"
                                                  placeholder="" value="" required>
                                            {{isset($arr_feature_banner['description']) ? $arr_feature_banner['description'] : ""}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <hr>
                            <h5 class="form-section col-md-12" ><i class="wb-add-file"></i> @lang("$string_file.segment_banner")
                            </h5>
                            <hr>

                            @foreach($arr_segments as $segment)

                                @php $required =true; @endphp
                                <h6 class="form-section col-md-12" ><i class="wb-add-file"></i> {{$segment->Name($merchant_id)}} @lang("$string_file.home_screen_banner")
                                </h6>
                                <hr>
                                <div class="row">
                                    {{Form::hidden('arr_segment_id['.$segment->id.']',$segment->id)}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="banner_image">
                                                @lang("$string_file.banner_image") (1500x1000):
                                                <span class="text-danger">*</span>
                                                @if(isset($arr_component[$segment->id]) && !empty($arr_component[$segment->id]['banner_image']))
                                                    <a href="{{$arr_component[$segment->id]['banner_image']}}" target="_blank">@lang("$string_file.view")</a>
                                                    @php $required =false; @endphp
                                                @endif
                                            </label>
                                            <input type="file" class="form-control" id="banner_image"
                                                   name="segment_banner_image[{{$segment->id}}]"
                                                   placeholder="" value="" @if($required) required @endif>
                                            @if ($errors->has('banner_image'))
                                                <label class="text-danger">{{ $errors->first('banner_image') }}</label>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="banner_title">
                                                @lang("$string_file.title") :
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="banner_title"
                                                   name="segment_banner_title[{{$segment->id}}]"
                                                   placeholder="" value="{{isset($arr_component[$segment->id]) ? $arr_component[$segment->id]['banner_title'] : ""}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="banner_title">
                                                @lang("$string_file.description") :
                                                <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control" id="banner_description"
                                                      name="segment_banner_description[{{$segment->id}}]"
                                                      placeholder="" value="" required>
                                            {{isset($arr_component[$segment->id]) ? $arr_component[$segment->id]['banner_description'] : ""}}
                                        </textarea>
                                        </div>
                                    </div>
                                </div>

                            @endforeach



                            <h5 class="form-section col-md-12" ><i class="wb-add-file"></i> @lang("$string_file.theme")</h5>
                            <hr>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group px-2">
                                        <label>@lang("$string_file.bg_color_primary"):</label>
                                        <span class="text-danger">*</span>
                                        <input type="color" class="form-control" name="bg_color_primary"  value="{{isset($details['bg_color_primary']) ? $details['bg_color_primary'] : ""}}" required >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group px-2">
                                        <label>@lang("$string_file.bg_color_secondary"):</label>
                                        {{--<span class="text-danger">*</span>--}}
                                        <input type="color" class="form-control" name="bg_color_secondary"  value="{{isset($details['bg_color_secondary']) ? $details['bg_color_secondary'] : ''}}" required >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group px-2">
                                        <label>@lang("$string_file.text_color_primary"):</label>
                                        <span class="text-danger">*</span>
                                        <input type="color" class="form-control" name="text_color_primary" value="{{isset($details['text_color_primary']) ? $details['text_color_primary'] : ''}}" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group px-2">
                                        <label>@lang("$string_file.text_color_secondary"):</label>
                                        <span class="text-danger">*</span>
                                        <input type="color" class="form-control" name="text_color_secondary" value="{{isset($details['text_color_secondary']) ? $details['text_color_secondary'] : ''}}" required>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h5 class="form-section col-md-12"><i class="wb-add-file"></i> @lang("$string_file.footer")</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="app_logo">
                                            @lang("$string_file.footer_logo") (512x512):
                                            <span class="text-danger">*</span>
                                            @if(!empty($details->logo))
                                                <a href="{{get_image($details->logo,'website_images')}}" target="_blank">@lang("$string_file.view")</a>
                                            @endif
                                        </label>
                                        <input type="file" class="form-control" id="app_logo"
                                               name="app_logo"
                                               placeholder="" @if(empty($details)) required @endif>

                                        @if ($errors->has('app_logo'))
                                            <label class="text-danger">{{ $errors->first('app_logo') }}</label>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="header_title">
                                            @lang("$string_file.footer_title") :
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="title"
                                               name="footer_title"
                                               placeholder="" value="{{!empty($details)  ? $details->WebsiteFeature->Title : ""}}" required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h6 class="form-section col-md-12">1. @lang("$string_file.left_content")</h6>
                            <hr>
                            <div class="row">
                              <div class="col-md-5">
                               <div class="form-group">
                                <label for="">@lang("$string_file.short_content") :
                                <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="footer_left_content"
                                       name="footer_left_content[]"
                                       placeholder=""  required>
                                        {{ isset($arr_feature_footer_left[0]) ? $arr_feature_footer_left[0] : ""}}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-7">
                               <div class="form-group">
                                <label for="">@lang("$string_file.detail_content") :
                                <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="detail_content"
                                       name="footer_left_content[]"
                                       placeholder=""  required>
                                       {{ isset($arr_feature_footer_left[1]) ? $arr_feature_footer_left[1] : ""}}
                                    </textarea>
                                    </div>
                                </div>
                                </div>

                            <h6 class="form-section col-md-12">2. @lang("$string_file.right_content")</h6>
                            <hr>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">@lang("$string_file.service_title") :
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="service_title"
                                                  name="service_content[title]"
                                                  placeholder="" value=" {{ isset($arr_feature_footer_right['title']) ? $arr_feature_footer_right['title'] : ""}}" required>

                                    </div>
                                </div>
                            </div>
                            {{--<h7 class="form-section col-md-12">@lang("$string_file.service_list")</h7><span class="text-danger">*</span>--}}
                            {{--<hr>--}}
                            {{--<div class="" id="service_list_original">--}}

                                    {{--<input type="hidden" id="total_service_list" value="1">--}}
                                    {{--@if(!$add_status)--}}
                                     {{--@php $arr_services =  isset($arr_feature_footer_right['list']) ? $arr_feature_footer_right['list'] : []; @endphp--}}
                                     {{--@foreach($arr_services as $key=> $service_list)--}}
                                        {{--<div class="row" id="list_row_id_{{$key}}">--}}
                                        {{--<div class="col-md-8">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<input type="text" class="form-control" id="service_content_list"--}}
                                                       {{--name="service_content[list][]"--}}
                                                       {{--placeholder="" value=" {{ !empty($service_list) ? $service_list : ""}}" required>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                         {{--@if($key == 0)--}}
                                            {{--<div class="col-md-1">--}}
                                                {{--<div class="form-group">--}}
                                                    {{--<button class="btn btn-info btn-sm float-right" type="button" id="add_more_service_list">--}}
                                                        {{--<i class="fa fa-plus"></i>--}}
                                                    {{--</button>--}}

                                                {{--</div>--}}
                                            {{--</div>--}}
                                         {{--@else--}}
                                            {{--<div class="col-md-1">--}}
                                                {{--<div class="form-group">--}}
                                                    {{--<label for="name"></label>--}}
                                                    {{--<button type="button" class="btn btn-danger btn-sm list_remove_button" id="{{$key}}"><i class="fa fa-remove"></i>--}}
                                                        {{--</button>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                         {{--@endif--}}
                                        {{--</div>--}}
                                     {{--@endforeach--}}
                                    {{--@else--}}
                                        {{--<div class="row" id="list_row_id_0">--}}
                                        {{--<div class="col-md-8">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<input type="text" class="form-control" id="service_content_list"--}}
                                                   {{--name="service_content[list][]"--}}
                                                   {{--placeholder="" value="" required>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-1">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<button class="btn btn-info btn-sm float-right" type="button" id="add_more_service_list">--}}
                                                    {{--<i class="fa fa-plus"></i>--}}
                                                {{--</button>--}}

                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                    {{--@endif--}}
                                {{--</div>--}}

                            <h7 class="form-section col-md-12">@lang("$string_file.service_points")</h7><span class="text-danger">*</span>
                            <hr>
                            <div class="" id="service_point_original">
                                <input type="hidden" id="total_service_list" value="1">

                                    @if(!$add_status)
                                        @php $arr_services =  isset($arr_feature_footer_right['point']) ? $arr_feature_footer_right['point'] : []; @endphp
                                        @foreach($arr_services as $key1=> $service_list)
                                            <div class="row" id="point_row_id_{{$key1}}">
                                            <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="service_content_list"
                                                       name="service_content[point][]"
                                                       placeholder="" value=" {{ !empty($service_list) ? $service_list : ""}}" required>
                                            </div>
                                            </div>
                                            @if($key1 == 0)
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <button class="btn btn-info btn-sm float-right" type="button" id="add_more_service_point">
                                                        <i class="fa fa-plus"></i>
                                                    </button>

                                                </div>
                                            </div>
                                            @else
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="name"></label>
                                                    <button type="button" class="btn btn-danger btn-sm point_remove_button" id="{{$key1}}"><i class="fa fa-remove"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                            </div>
                                        @endforeach
                                    @else
                                    <div class="row" id="point_row_id_0">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="service_content_point"
                                                      name="service_content[point][]"
                                                      placeholder="" value=" " required>
                                        </div>
                                    </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <button class="btn btn-info btn-sm float-right" type="button" id="add_more_service_point">
                                                    <i class="fa fa-plus"></i>
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
<div class="form-actions float-right">
        @if($id == NULL || $edit_permission)
            <button type="submit" class="btn btn-primary">
            <i class="fa fa-check-square-o"></i> @lang("$string_file.save")
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
@section('js')
    <script type="text/javascript">

        // add more slots
        $(document).ready(function (e) {
            $(document).on("click", "#add_more_service_list", function (e) {
                var total_service_list = $("#total_service_list").val();
                var row_id = total_service_list;
                var next_row = parseInt(row_id) + 1;
                $("#total_service_list").val(next_row);
                var new_row ='<div class="row" id="list_row_id_' + row_id +'"><div class="col-md-8"><div class="form-group">' +
                    '{!! Form::text('service_content[list][]',old('distance_to[]',''),['class'=>'form-control','id'=>'distance_from','placeholder'=>'','required'=>true]) !!}' +
                    '@if ($errors->has('distance_to'))' +
                    '<span class="help-block"><strong>{{ $errors->first('distance_from') }}</strong></span>' +
                    '@endif' +
                    '</div>' +
                    '</div>'  +
                    '<div class="col-md-1">' +
                    '<div class="form-group">' +
                    '<label for="name"></label>' +
                    '<button type="button" class="btn btn-danger btn-sm list_remove_button" id="' + row_id + '"><i class="fa fa-remove"></i>' +
                    '</button>'+
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $("#service_list_original").append(new_row);

            });
        });

        $(document).ready(function (e)
        {
            $(document).on("click", ".list_remove_button", function (e)
            {
                var row_id = $(this).attr('id');
                $("#list_row_id_"+row_id).remove();
            });
        });

        $(document).ready(function (e) {
            $(document).on("click", "#add_more_service_point", function (e) {
                var total_service_point = $("#total_service_point").val();
                var row_id = total_service_point;
                var next_row = parseInt(row_id) + 1;
                $("#total_service_point").val(next_row);
                var new_row ='<div class="row" id="point_row_id_' + row_id + '"><div class="col-md-8"><div class="form-group">' +
                    '{!! Form::text('service_content[point][]',old('distance_to[]',''),['class'=>'form-control','id'=>'distance_from','placeholder'=>'','required'=>true]) !!}' +
                    '@if ($errors->has('distance_to'))' +
                    '<span class="help-block"><strong>{{ $errors->first('distance_from') }}</strong></span>' +
                    '@endif' +
                    '</div>' +
                    '</div>'  +
                    '<div class="col-md-1">' +
                    '<div class="form-group">' +
                    '<label for="name"></label>' +
                    '<button type="button" class="btn btn-danger btn-sm point_remove_button" id="' + row_id + '"><i class="fa fa-remove"></i>' +
                    '</button>'+
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                $("#service_point_original").append(new_row);

            });
        });

        $(document).ready(function (e)
        {
            $(document).on("click", ".point_remove_button", function (e)
            {
                var row_id = $(this).attr('id');
                $("#point_row_id_"+row_id).remove();
            });
        });

    </script>

@endsection
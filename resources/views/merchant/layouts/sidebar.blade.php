@php
    $merchant = get_merchant_id(false);
    $merchant_id = $merchant->id;
    $payment_config = \App\Models\PaymentConfiguration::firstOrCreate(['merchant_id' => $merchant_id])->first();
    $all_grocery_clone = \App\Models\Segment::where("sub_group_for_app",2)->get()->pluck("slag")->toArray();
    $all_food_clone = \App\Models\Segment::where("sub_group_for_app",1)->get()->pluck("slag")->toArray();
    $all_food_grocery_clone = \App\Models\Segment::whereIn("sub_group_for_app",[1,2])->get()->pluck("slag")->toArray();
    $grocery_clone = (count(array_intersect($merchant_segment, $all_grocery_clone)) > 0) ? true :false;
    $grocery_food_exist = (count(array_intersect($merchant_segment, $all_food_grocery_clone)) > 0) ? true :false;
    $food_clone = (count(array_intersect($merchant_segment, $all_food_clone)) > 0) ? true :false;
    // $grocery_clone = (in_array('GROCERY',$merchant_segment) || in_array('PHARMACY',$merchant_segment) || in_array('GAS_DELIVERY',$merchant_segment)|| in_array('WATER_TANK_DELIVERY',$merchant_segment)|| in_array('MEAT_SHOP',$merchant_segment)|| in_array('SWEET_SHOP',$merchant_segment)|| in_array('PAAN_SHOP',$merchant_segment)|| in_array('ARTIFICIAL_JEWELLERY',$merchant_segment) || in_array('GIFT_SHOP',$merchant_segment)|| in_array('CONVENIENCE_SHOP',$merchant_segment) || in_array('ELECTRONIC_SHOP',$merchant_segment) || in_array('WINE_DELIVERY',$merchant_segment) || in_array('FLOWER_DELIVERY',$merchant_segment) || in_array('PET_SHOP',$merchant_segment));
@endphp
<div class="site-menubar site-menubar-light">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu" id="myMenu">
                    @if(Auth::user('merchant')->can('dashboard'))
                        <li class="site-menu-item">
                            <a href="{{ route('merchant.dashboard') }}">
                                <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.dashboard")</span>
                            </a>
                        </li>
                    @endif
                    @if($config->website_module == 1 && (Auth::user('merchant')->hasAnyPermission(['website_user_home','website_driver_home'])))
                        <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon fa-globe" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.website_management")</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                @if(Auth::user('merchant')->can('website_user_home'))
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{ route('website-user-home-headings.index') }}">
                                            <span class="site-menu-title">@lang("$string_file.website_user_home")</span>
                                        </a>
                                    </li>
                                @endif
                                {{--@if(Auth::user('merchant')->can('website_driver_home'))--}}
                                    {{--<li class="site-menu-item">--}}
                                        {{--<a class="animsition-link"--}}
                                           {{--href="{{ route('website-driver-home-headings.index') }}">--}}
                                            {{--<span class="site-menu-title">@lang("$string_file.website_driver_home")</span>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--@endif--}}
                            </ul>
                        </li>
                    @endif
                    @if((in_array('TAXI',$merchant_segment) && Auth::user('merchant')->can('TAXI')) || (in_array('DELIVERY',$merchant_segment) && Auth::user('merchant')->can('DELIVERY')))
                        @if(($config->company_admin == 1 || Auth::user('merchant')->hotel_active == 1 || $config->corporate_admin == 1 || Auth::user('merchant')->franchisees_active == 1 || $config->driver_agency == 1) && ( Auth::user('merchant')->hasAnyPermission(['taxi_company','taxi_company_DELIVERY','corporate','hotel','franchisee','driver_agency'])))
                            <li class="site-menu-category" id="general-title">@lang("$string_file.associates")</li>
                            @if((Auth::user('merchant')->can('taxi_company') || Auth::user('merchant')->can('taxi_company_DELIVERY')) && $config->company_admin == 1)
                                <li class="site-menu-item">
                                    <a href="{{ route('merchant.taxi-company') }}">
                                        <i class="site-menu-icon fa-handshake-o" aria-hidden="true"></i>
                                        <span class="site-menu-title">@lang("$string_file.taxi_company") @lang("$string_file.panels")</span>
                                    </a>
                                </li>
                            @endif
                            {{--@if($config->driver_agency == 1 && Auth::user('merchant')->can('driver_agency'))--}}
                            @if($config->driver_agency == 1)
                                <li class="site-menu-item">
                                    <a href="{{ route('merchant.driver-agency') }}">
                                        <i class="site-menu-icon fa-handshake-o" aria-hidden="true"></i>
                                        <span class="site-menu-title">@lang("$string_file.driver_agency")</span>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user('merchant')->hotel_active == 1 && Auth::user('merchant')->can('hotel'))
                                <li class="site-menu-item">
                                    <a href="{{ route('hotels.index') }}">
                                        <i class="site-menu-icon fa-hotel" aria-hidden="true"></i>
                                        <span class="site-menu-title">@lang("$string_file.hotel_panels")</span>
                                    </a>
                                </li>
                            @endif
                            @if((Auth::user('merchant')->can('corporate') || Auth::user('merchant')->can('corporate_DELIVERY')) && $config->corporate_admin == 1)
                                <li class="site-menu-item">
                                    <a href="{{ route('corporate.index') }}">
                                        <i class="site-menu-icon fa-industry" aria-hidden="true"></i>
                                        <span class="site-menu-title">@lang("$string_file.corporate_panels")</span>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user('merchant')->franchisees_active == 1 && Auth::user('merchant')->can('franchisee'))
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{ route('franchisee.index') }}">
                                        <span class="site-menu-title">@lang('admin.message559')</span>
                                    </a>
                                </li>
                            @endif
                        @endif
                    @endif
                    @if(Auth::user('merchant')->hasAnyPermission(['view_pricing_parameter','view_documents','view_vehicle_model','view_vehicle_make','view_countries','view_area','view_vehicle_type']))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.mandatory_setup")</li>
                        @if(Auth::user('merchant')->hasAnyPermission('view_pricing_parameter','view_documents','view_vehicle_model','view_vehicle_make','view_countries','view_area','view_vehicle_type'))
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon fa-cog" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.basic_setup")</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    @if(Auth::user('merchant')->can('view_countries'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('country.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.countries")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->can('view_area'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('countryareas.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.service_area")</span>
                                            </a>
                                        </li>
                                    @endif
                                    <!--count($merchant_segment) == 1 && -->
                                    <!--count($merchant_segment) == 2 && -->
                                    @if((
                                        (in_array('TAXI',$merchant_segment) && $app_config->home_screen_view == 1)
                                     || (in_array('TAXI',$merchant_segment) && in_array('DELIVERY',$merchant_segment) && $app_config->home_screen_view == 1)
                                     || (in_array('FOOD',$merchant_segment) || $grocery_clone || $food_clone)
                                   ) && (Auth::user('merchant')->hasAnyPermission(['TAXI','DELIVERY']) || Auth::user('merchant')->hasAnyPermission($all_food_grocery_clone) || Auth::user('merchant')->hasAnyPermission($all_food_clone)))
                                        <li class="site-menu-item">
                                            <a class="animsition-link"
                                               href="{{ route('merchant.category') }}">
                                                <span class="site-menu-title">@lang("$string_file.categories")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(isset($config->category_type_view) && $config->category_type_view == 1)
                                        <li class="site-menu-item">
                                            <a class="animsition-link"
                                               href="{{ route('merchant.brands') }}">
                                                <span class="site-menu-title">@lang("$string_file.brands")</span>
                                            </a>
                                        </li>
                                        <li class="site-menu-item">
                                            <a class="animsition-link"
                                               href="{{ route('merchant.home-screen.design-config') }}">
                                                <span class="site-menu-title">@lang("$string_file.home_screen_design_config")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if($merchant->advertisement_module == 1 && Auth::user('merchant')->can('view_banner'))
                                        <li class="site-menu-item">
                                            <a href="{{ route('advertisement.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.banner_management")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if((in_array('FOOD',$merchant_segment) || $food_clone|| in_array('DELIVERY',$merchant_segment)|| $grocery_clone) && (Auth::user('merchant')->hasAnyPermission(['DELIVERY','FOOD']) || Auth::user('merchant')->hasAnyPermission($all_grocery_clone) || Auth::user('merchant')->hasAnyPermission($all_food_clone)))
                                            <li class="site-menu-item">
                                                <a class="animsition-link" href="{{route('weightunit.index')}}">
                                                    <span class="site-menu-title">@lang("$string_file.weight_unit")</span>
                                                </a>
                                            </li>
                                        @if((in_array('FOOD',$merchant_segment) && Auth::user('merchant')->can('FOOD')) || $food_clone && Auth::user('merchant')->can($all_food_clone))
                                            <li class="site-menu-item">
                                                <a class="animsition-link"
                                                   href="{{route('merchant.option-type.index')}}">
                                                    <span class="site-menu-title">@lang("$string_file.option_type")</span>
                                                </a>
                                            </li>

                                            <li class="site-menu-item">
                                                <a class="animsition-link"
                                                   href="{{ route('merchant.style-management')}}">
                                                    <span class="site-menu-title">@lang("$string_file.style_management")</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                    @if(in_array(1,$merchant_segment_group) || in_array(3, $merchant_segment_group))
                                        @if(Auth::user('merchant')->can('view_vehicle_type'))
                                            <li class="site-menu-item">
                                                <a class="animsition-link" href="{{ route('vehicletype.index') }}">
                                                    <span class="site-menu-title">@lang("$string_file.vehicle_type")</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if(Auth::user('merchant')->can('view_vehicle_make') && $app_config->vehicle_make_text != 1)
                                            <li class="site-menu-item">
                                                <a class="animsition-link" href="{{ route('vehiclemake.index') }}">
                                                    <span class="site-menu-title">@lang("$string_file.vehicle_make")</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if(Auth::user('merchant')->can('view_vehicle_model') && $app_config->vehicle_model_text != 1)
                                            <li class="site-menu-item">
                                                <a class="animsition-link" href="{{ route('vehiclemodel.index') }}">
                                                    <span class="site-menu-title">@lang("$string_file.vehicle_model")</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                    @if(Auth::user('merchant')->can('view_documents'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('documents.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.documents")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->can('view_pricing_parameter') && (in_array('TAXI',$merchant_segment) || in_array('DELIVERY',$merchant_segment) || in_array('CARPOOLING',$merchant_segment) ) && (Auth::user('merchant')->hasAnyPermission(['TAXI','DELIVERY','CARPOOLING'])))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('pricingparameter.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.pricing_parameter")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(((isset($config->bank_details_enable) && $config->bank_details_enable == 1) || (isset($config->user_bank_details_enable) && $config->user_bank_details_enable == 1)) && Auth::user('merchant')->can('view-account-types'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('account-types.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.account_type")</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if(in_array('TAXI',$merchant_segment) && Auth::user('merchant')->can('TAXI'))
                            @if(isset($config->geofence_module) && $config->geofence_module == 1)
                                <li class="site-menu-item has-sub">
                                    <a href="javascript:void(0)">
                                        <i class="site-menu-icon wb-map" aria-hidden="true"></i>
                                        <span class="site-menu-title">@lang("$string_file.geofence_area")</span>
                                        <span class="site-menu-arrow"></span>
                                    </a>
                                    <ul class="site-menu-sub">
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('geofence.restrict.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.restricted_area_management")
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endif
                        @if((Auth::user('merchant')->hasAnyPermission(['TAXI','DELIVERY','HANDYMAN','CARPOOLING']) || (Auth::user('merchant')->hasAnyPermission($all_food_grocery_clone))) && (in_array(1,$merchant_segment_group) || in_array(2,$merchant_segment_group) || in_array(3,$merchant_segment_group)))
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon fa fa-money" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.price_card")</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    @if(in_array(1,$merchant_segment_group) || in_array(3,$merchant_segment_group))
                                        @if((in_array('TAXI',$merchant_segment) || in_array('DELIVERY',$merchant_segment)) && Auth::user('merchant')->hasAnyPermission(['TAXI','DELIVERY']))
                                            <li class="site-menu-item has-sub">
                                                <a href="javascript:void(0)">
                                                    <i class="site-menu-icon fa fa-taxi" aria-hidden="true"></i>
                                                    <span class="site-menu-title">@lang("$string_file.taxi") & @lang("$string_file.logistics_services")</span>
                                                    <span class="site-menu-arrow"></span>
                                                </a>
                                                <ul class="site-menu-sub">
                                                    <li class="site-menu-item">
                                                        <a class="animsition-link"
                                                           href="{{ route('pricecard.index') }}">
                                                            <span class="site-menu-title">@lang("$string_file.for_user") & @lang("$string_file.driver") </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        @endif
                                        {{--  @if(in_array('FOOD',$merchant_segment) || in_array('GROCERY',$merchant_segment)|| in_array('PHARMACY',$merchant_segment)|| in_array('GAS_DELIVERY',$merchant_segment)|| in_array('WATER_TANK_DELIVERY',$merchant_segment)|| in_array('PARCEL_DELIVERY',$merchant_segment)|| in_array('MEAT_SHOP',$merchant_segment)|| in_array('SWEET_SHOP',$merchant_segment)|| in_array('PAAN_SHOP',$merchant_segment)|| in_array('ARTIFICIAL_JEWELLERY',$merchant_segment)  || in_array('WINE_DELIVERY',$merchant_segment))--}}
                                        @if($grocery_food_exist && Auth::user('merchant')->hasAnyPermission($all_food_grocery_clone))
                                            <li class="site-menu-item has-sub">
                                                <a href="javascript:void(0)">
                                                    <i class="site-menu-icon fa fa-ship" aria-hidden="true"></i>
                                                    <span class="site-menu-title">@lang("$string_file.delivery_services")</span>
                                                    <span class="site-menu-arrow"></span>
                                                </a>
                                                <ul class="site-menu-sub">
                                                    <li class="site-menu-item">
                                                        <a class="animsition-link"
                                                           href="{{ route('food-grocery.price_card',1) }}">
                                                            <span class="site-menu-title">@lang("$string_file.for_driver")</span>
                                                        </a>
                                                    </li>
                                                    <li class="site-menu-item">
                                                        <a class="animsition-link"
                                                           href="{{ route('food-grocery.price_card',2) }}">
                                                            <span class="site-menu-title">@lang("$string_file.for_user")</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        @endif
                                        @if($app_config && $app_config['sub_charge'] == 1 && Auth::user('merchant')->can('TAXI') && Auth::user('merchant')->can('surcharge'))
                                            <li class="site-menu-item">
                                                <a class="animsition-link"
                                                   href="{{ route('pricecard.surgecharge') }}">
                                                    <span class="site-menu-title">@lang("$string_file.sub_charge")</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if(in_array(3,$merchant_segment_group) && in_array('CARPOOLING',$merchant_segment))
                                            <li class="site-menu-item">
                                                <a class="animsition-link"
                                                   href="{{ route('carpooling.price_card') }}">
                                                    <span class="site-menu-title">@lang("$string_file.carpooling") @lang("$string_file.price_card")</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                    @if(in_array(2,$merchant_segment_group) && Auth::user('merchant')->can('HANDYMAN') && Auth::user('merchant')->can('price_card_HANDYMAN'))
                                        <li class="site-menu-item has-sub">
                                            <a href="javascript:void(0)">
                                                <i class="site-menu-icon fa fa-lightbulb-o" aria-hidden="true"></i>
                                                <span class="site-menu-title">@lang("$string_file.handyman_services")</span>
                                                <span class="site-menu-arrow"></span>
                                            </a>
                                            <ul class="site-menu-sub">
                                                <li class="site-menu-item">
                                                    <a class="animsition-link"
                                                       href="{{ route('merchant.segment.price_card') }}">
                                                        <span class="site-menu-title">@lang("$string_file.for_user")</span>
                                                    </a>
                                                </li>
                                                <li class="site-menu-item">
                                                    <a class="animsition-link"
                                                       href="{{ route('merchant.segment.commission') }}">
                                                        <span class="site-menu-title">@lang("$string_file.for_driver")</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if((in_array(1,$merchant_segment_group) || $handyman_apply_promocode == true) && (Auth::user('merchant')->hasAnyPermission(['TAXI','DELIVERY']) || (Auth::user('merchant')->hasAnyPermission($all_food_grocery_clone))))
                            <li class="site-menu-item">
                                <a href="{{ route('promocode.index') }}">
                                    <i class="site-menu-icon fa-percent" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.promo_code")</span>
                                </a>
                            </li>
                        @endif
                        @if($add_info['wallet_promo_code'] == 1)
                            <li class="site-menu-item">
                                <a href="{{ route('walletpromocode.index') }}">
                                    <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.wallet_promo_code") </span>
                                </a>
                            </li>
                        @endif
                        @if(in_array('TAXI',$merchant_segment) && Auth::user('merchant')->can('TAXI'))
                            @if($payment_config && $payment_config->cancel_rate_table_enable == 1)
                                <li class="site-menu-item">
                                    <a href="{{ route('merchant.cancelrate') }}">
                                        <i class="site-menu-icon fa-flag" aria-hidden="true"></i>
                                        <span class="site-menu-title">@lang("$string_file.cancel_rate_table")</span>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user('merchant')->can('TAXI') && Auth::user('merchant')->can('package') && (in_array(2,$service_types) || in_array(3,$service_types) || in_array(4,$service_types)))
                                <li class="site-menu-item has-sub">
                                    <a href="javascript:void(0)">
                                        <i class="site-menu-icon fa-cubes" aria-hidden="true"></i>
                                        <span class="site-menu-title">@lang("$string_file.package_management")</span>
                                        <span class="site-menu-arrow"></span>
                                    </a>
                                    <ul class="site-menu-sub">
                                        @if(in_array(2,$service_types))
                                            <li class="site-menu-item">
                                                <a class="animsition-link" href="{{ route('packages.index') }}">
                                                    <span class="site-menu-title">@lang("$string_file.package_based_services")</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if(in_array(3,$service_types))
                                            <li class="site-menu-item">
                                                <a class="animsition-link"
                                                   href="{{ route('transferpackage.index') }}">
                                                    <span class="site-menu-title">@lang("$string_file.transfer")</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if(in_array(4,$service_types))
                                            <li class="site-menu-item">
                                                <a class="animsition-link"
                                                   href="{{ route('outstationpackage.index') }}">
                                                    <span class="site-menu-title">@lang("$string_file.outstation_services")</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                        @endif
                        @if((in_array(2,$merchant_segment_group) || $grocery_clone) && (Auth::user('merchant')->can('HANDYMAN') || Auth::user('merchant')->hasAnyPermission($all_grocery_clone)))
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('segment.service-time-slot') }}">
                                    <i class="site-menu-icon fa-tags" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.service_time_slots")</span>
                                </a>
                            </li>
                            @if(!empty($merchant->HandymanConfiguration) && $merchant->HandymanConfiguration->additional_charges_on_booking == 1)
                                <li class="site-menu-item">
                                    <a class="animsition-link" href="{{ route('segment.handyman-charge-type') }}">
                                        <i class="site-menu-icon fa-tags" aria-hidden="true"></i>
                                        <span class="site-menu-title">@lang("$string_file.charge_types")</span>
                                    </a>
                                </li>
                              @endif
                        @endif
                    @endif
                    @if(in_array('FOOD',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_FOOD'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.food_management") </li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','FOOD') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.restaurants")</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment.orders',['slug'=>'FOOD'])}}">
                                <i class="site-menu-icon fa-cutlery" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.orders")</span>
                            </a>
                        </li>
                    @endif
                        @if(in_array('CATERING_SERVICE',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_CATERING_SERVICE'))
                            <li class="site-menu-category"
                                id="general-title">@lang("$string_file.catering_service") </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment','CATERING_SERVICE') }}">
                                    <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.stores")</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'CATERING_SERVICE'])}}">
                                    <i class="site-menu-icon fa-cutlery" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                        @endif
                    @if(in_array('GROCERY',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_GROCERY'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.grocery_management")</li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','GROCERY') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.stores")</span>
                            </a>
                        </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'GROCERY'])}}">
                                    <i class="site-menu-icon fa-list" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                    @endif
                    @if(in_array('GAS_DELIVERY',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_GAS_DELIVERY'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.gas_delivery_management") </li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','GAS_DELIVERY') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.stores")</span>
                            </a>
                        </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'GAS_DELIVERY'])}}">
                                    <i class="site-menu-icon fa-list" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                    @endif
                    @if(in_array('WATER_TANK_DELIVERY',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_WATER_TANK_DELIVERY'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.water_tank_delivery")</li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','WATER_TANK_DELIVERY') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.stores")</span>
                            </a>
                        </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'WATER_TANK_DELIVERY'])}}">
                                    <i class="site-menu-icon fa-list" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                    @endif
                    @if(in_array('PHARMACY',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_PHARMACY'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.pharmacy_management")</li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','PHARMACY') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.stores")</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment.orders',['slug'=>'PHARMACY'])}}">
                                <i class="site-menu-icon fa-list" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.orders")</span>
                            </a>
                        </li>
                    @endif
                    @if(in_array('MEAT_SHOP',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_MEAT_SHOP'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.meat_delivery")</li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','MEAT_SHOP') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.stores")</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment.orders',['slug'=>'MEAT_SHOP'])}}">
                                <i class="site-menu-icon fa-cutlery" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.orders")</span>
                            </a>
                        </li>
                    @endif
                    @if(in_array('PAAN_SHOP',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_PAAN_SHOP'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.paan_delivery")</li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','PAAN_SHOP') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.stores")</span>
                            </a>
                        </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'PAAN_SHOP'])}}">
                                    <i class="site-menu-icon fa-list" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                    @endif
                    @if(in_array('ARTIFICIAL_JEWELLERY',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_ARTIFICIAL_JEWELLERY'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.artificial_jewellery")</li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','ARTIFICIAL_JEWELLERY') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.stores")</span>
                            </a>
                        </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'ARTIFICIAL_JEWELLERY'])}}">
                                    <i class="site-menu-icon fa-diamond" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                    @endif
                    @if(in_array('SWEET_SHOP',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_SWEET_SHOP'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.sweet_delivery")</li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','SWEET_SHOP') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.stores")</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment.orders',['slug'=>'SWEET_SHOP'])}}">
                                <i class="site-menu-icon fa-list" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.orders")</span>
                            </a>
                        </li>
                    @endif
                    @if(in_array('GIFT_SHOP',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_GIFT_SHOP'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.gift_delivery")</li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','GIFT_SHOP') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.shops")</span>
                            </a>
                        </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'GIFT_SHOP'])}}">
                                    <i class="site-menu-icon fa-gift" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                    @endif
                    @if(in_array('CONVENIENCE_SHOP',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_CONVENIENCE_SHOP'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.convenience_delivery")</li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','CONVENIENCE_SHOP') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.shops")</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment.orders',['slug'=>'CONVENIENCE_SHOP'])}}">
                                <i class="site-menu-icon fa-list" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.orders")</span>
                            </a>
                        </li>
                    @endif
                    @if(in_array('ELECTRONIC_SHOP',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_ELECTRONIC_SHOP'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.electronics_delivery")</li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','ELECTRONIC_SHOP') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.shops")</span>
                            </a>
                        </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'ELECTRONIC_SHOP'])}}">
                                    <i class="site-menu-icon fa-lightbulb-o" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                    @endif
                    @if(in_array('FLOWER_DELIVERY',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_FLOWER_DELIVERY'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.flower_delivery")</li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','FLOWER_DELIVERY') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.shops")</span>
                            </a>
                        </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'FLOWER_DELIVERY'])}}">
                                    <i class="site-menu-icon fa-gift" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                    @endif
                    @if(in_array('WINE_DELIVERY',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_WINE_DELIVERY'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.wine_delivery")</li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','WINE_DELIVERY') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.shops")</span>
                            </a>
                        </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'WINE_DELIVERY'])}}">
                                    <i class="site-menu-icon fa-list" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                    @endif
                    @if(in_array('PET_SHOP',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_PET_SHOP'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.pet_shops")</li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','PET_SHOP') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.shops")</span>
                            </a>
                        </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'PET_SHOP'])}}">
                                    <i class="site-menu-icon fa-list-ol" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                    @endif
                    @if(in_array('HARDWARE_DELIVERY',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_HARDWARE_DELIVERY'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.hardware_delivery")</li>
                        <li class="site-menu-item">
                            <a class="animsition-link"
                               href="{{ route('merchant.business-segment','HARDWARE_DELIVERY') }}">
                                <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.shops")</span>
                            </a>
                        </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'HARDWARE_DELIVERY'])}}">
                                    <i class="site-menu-icon fa-list-ol" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                    @endif
                        @if(in_array('CATERING_SERVICES',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_CATERING_SERVICES'))
                            <li class="site-menu-category"
                                id="general-title">@lang("$string_file.catering_service")</li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment','CATERING_SERVICES') }}">
                                    <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.shops")</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'CATERING_SERVICES'])}}">
                                    <i class="site-menu-icon fa-list-ol" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                        @endif
                        @if(in_array('DRINKS_AND_CIGARS',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_DRINKS_AND_CIGARS'))
                            <li class="site-menu-category"
                                id="general-title">@lang("$string_file.drinks_gigas")</li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment','DRINKS_AND_CIGARS') }}">
                                    <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.shops")</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'DRINKS_AND_CIGARS'])}}">
                                    <i class="site-menu-icon fa-list-ol" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                        @endif
                        @if(in_array('FASHION',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_FASHION'))
                            <li class="site-menu-category"
                                id="general-title">@lang("$string_file.fashion")</li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment','FASHION') }}">
                                    <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.shops")</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'FASHION'])}}">
                                    <i class="site-menu-icon fa-list-ol" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                        @endif
                        @if(in_array('TICKETS',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_TICKETS'))
                            <li class="site-menu-category"
                                id="general-title">@lang("$string_file.tickets")</li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment','TICKETS') }}">
                                    <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.shops")</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'TICKETS'])}}">
                                    <i class="site-menu-icon fa-list-ol" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                        @endif
                        @if(in_array('ECOMMERCE',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_ECOMMERCE'))
                            <li class="site-menu-category"
                                id="general-title">@lang("$string_file.ecommerce")</li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment','ECOMMERCE') }}">
                                    <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.ecommerce")</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'ECOMMERCE'])}}">
                                    <i class="site-menu-icon fa-list-ol" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                        @endif
                        @if(in_array('WIFI',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_WIFI'))
                            <li class="site-menu-category"
                                id="general-title">@lang("$string_file.wifi")</li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment','WIFI') }}">
                                    <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.wifi")</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'WIFI'])}}">
                                    <i class="site-menu-icon fa-list-ol" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                        @endif
                        @if(in_array('HOME_AND_DECOR',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_HOME_AND_DECOR'))
                            <li class="site-menu-category"
                                id="general-title">@lang("$string_file.home_decor")</li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment','HOME_AND_DECOR') }}">
                                    <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.home_decor")</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'HOME_AND_DECOR'])}}">
                                    <i class="site-menu-icon fa-list-ol" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                        @endif
                        @if(in_array('OTHER_BUSINESSES',$merchant_segment) && Auth::user('merchant')->can('view_business_segment_OTHER_BUSINESSES'))
                            <li class="site-menu-category"
                                id="general-title">@lang("$string_file.other_business")</li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment','OTHER_BUSINESSES') }}">
                                    <i class="site-menu-icon fa-home" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.other_business")</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link"
                                   href="{{ route('merchant.business-segment.orders',['slug'=>'OTHER_BUSINESSES'])}}">
                                    <i class="site-menu-icon fa-list-ol" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.orders")</span>
                                </a>
                            </li>
                        @endif
                    @if(in_array(2,$merchant_segment_group) && Auth::user('merchant')->can('booking_management_HANDYMAN'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.handyman_services")</li>
                        <li class="site-menu-item">
                            <a class="animsition-link" href="{{ route('handyman.orders') }}">
                                <i class="site-menu-icon fa-wpforms" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.booking_management")</span>
                            </a>
                        </li>
                    @endif
                    @if(in_array('DELIVERY',$merchant_segment) && Auth::user('merchant')->can('DELIVERY'))
                        <li class="site-menu-category"
                            id="rider-title">@lang("$string_file.delivery_management")</li>
                        <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon fa-truck" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.delivery_management")</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item">
                                    <a href="{{ route('delivery_product.index') }}">
                                        <span class="site-menu-title">@lang("$string_file.products")</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if(Auth::user('merchant')->can('ride_management_DELIVERY'))
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon fa-car" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.rides")</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub open">
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{ route('merchant.activeride',['slug' => 'DELIVERY']) }}">
                                            <span class="site-menu-title">@lang("$string_file.ongoing_rides")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{ route('merchant.completeride',['slug' => 'DELIVERY']) }}">
                                            <span class="site-menu-title">@lang("$string_file.completed_rides")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{ route('merchant.cancelride',['slug' => 'DELIVERY']) }}">
                                            <span class="site-menu-title">@lang("$string_file.cancelled_rides")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{ route('merchant.failride',['slug' => 'DELIVERY']) }}">
                                            <span class="site-menu-title">@lang("$string_file.failed_rides")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{ route('merchant.autocancel',['slug' => 'DELIVERY']) }}">
                                            <span class="site-menu-title">@lang("$string_file.auto_cancelled_rides")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{ route('merchant.all.ride', ['slug' => 'DELIVERY']) }}">
                                            <span class="site-menu-title">@lang("$string_file.all_rides")</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endif
                    @if(in_array('TAXI',$merchant_segment) && Auth::user('merchant')->can('TAXI') && (Auth::user('merchant')->hasAnyPermission(['manualdispach','ride_management_TAXI'])))
                        <li class="site-menu-category"
                            id="booking-title">@lang("$string_file.taxi_management")</li>
                        @if(Auth::user('merchant')->can('manualdispach'))
                            <li class="site-menu-item">
                                <a href="{{ route('merchant.test.manualdispach') }}">
                                    <i class="site-menu-icon fa fa-truck" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.manual_dispatch")</span>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user('merchant')->can('ride_management_TAXI'))
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon fa-car" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.rides")</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub open">
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{ route('merchant.activeride',['slug' => 'TAXI']) }}">
                                            <span class="site-menu-title">@lang("$string_file.ongoing_rides")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{ route('merchant.completeride',['slug' => 'TAXI']) }}">
                                            <span class="site-menu-title">@lang("$string_file.completed_rides")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{ route('merchant.cancelride',['slug' => 'TAXI']) }}">
                                            <span class="site-menu-title">@lang("$string_file.cancelled_rides")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{ route('merchant.failride',['slug' => 'TAXI']) }}">
                                            <span class="site-menu-title">@lang("$string_file.failed_rides")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{ route('merchant.autocancel',['slug' => 'TAXI']) }}">
                                            <span class="site-menu-title">@lang("$string_file.auto_cancelled_rides")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{ route('merchant.all.ride',['slug' => 'TAXI']) }}">
                                            <span class="site-menu-title">@lang("$string_file.all_rides")</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endif
                    @if(Auth::user('merchant')->hasAnyPermission(['view_drivers','create_drivers','basic_driver_signup','pending_drivers_approval','rejected_drivers','expired_driver_documents','view_pending_vehicle_apporvels','view_all_vehicles','view_driver_map','view_heat_map']) && $config->driver_enable == 1)
                        <li class="site-menu-category"
                            id="driver-title">@lang("$string_file.driver_management")</li>
                        @if(Auth::user('merchant')->hasAnyPermission(['view_drivers','create_drivers','basic_driver_signup','pending_drivers_approval','rejected_drivers','expired_driver_documents']))
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon fa-drivers-license" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.drivers")</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    @if(Auth::user('merchant')->can('view_drivers'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('driver.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.all_driver")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->can('create_drivers'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('driver.add') }}">
                                                <span class="site-menu-title">@lang("$string_file.add_driver")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->can('basic_driver_signup'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('merchant.driver.basic') }}">
                                                <span class="site-menu-title">@lang("$string_file.basic_signup")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->can('pending_drivers_approval'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link"
                                               href="{{ route('merchant.driver.pending.show') }}">
                                                <span class="site-menu-title">@lang("$string_file.pending_approval")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->can('rejected_drivers'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('merchant.driver.rejected') }}">
                                                <span class="site-menu-title">@lang("$string_file.rejected_drivers")</span>
                                            </a>
                                        </li>
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('merchant.driver.rejected.temporary') }}">
                                                <span class="site-menu-title">@lang("$string_file.temporary_rejected_drivers")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if($config->driver_agency == 1 && Auth::user('merchant')->can('driver_agency'))
                                        <li class="site-menu-item">
                                            <a href="{{ route('merchant.driver-agency.drivers') }}">
                                                <span class="site-menu-title">@lang("$string_file.driver_agency_drivers")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->can('expired_driver_documents'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link"
                                               href="{{ route('merchant.driver.goingtoexpiredocuments') }}">
                                                <span class="site-menu-title">@lang("$string_file.docs_going_expire")</span>
                                            </a>
                                        </li>
                                        <li class="site-menu-item">
                                            <a class="animsition-link"
                                               href="{{ route('merchant.driver.expiredocuments') }}">
                                                <span class="site-menu-title">@lang("$string_file.expired_document")</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user('merchant')->hasAnyPermission(['view_all_vehicles','view_pending_vehicle_apporvels','view_rejected_vehicles']) && in_array(1,$merchant_segment_group))
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon fa-cab" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.vehicles")</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    @if(Auth::user('merchant')->can('view_all_vehicles'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('merchant.driver.allvehicles') }}">
                                                <span class="site-menu-title">@lang("$string_file.all_vehicles")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(has_driver_multiple_or_existing_vehicle(null,$merchant_id,$by ='merchant') == true)
                                        @if(Auth::user('merchant')->can('view_pending_vehicle_apporvels'))
                                            <li class="site-menu-item">
                                                <a class="animsition-link"
                                                   href="{{ route('merchant.driver.pending.vehicles') }}">
                                                    <span class="site-menu-title">@lang("$string_file.pending_approval")</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if(Auth::user('merchant')->can('view_rejected_vehicles'))
                                            <li class="site-menu-item">
                                                <a class="animsition-link" href="{{ route('merchant.vehicle.rejected') }}">
                                                    <span class="site-menu-title">@lang("$string_file.rejected_vehicle")</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user('merchant')->hasAnyPermission(['view_driver_map','view_heat_map']))
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon fa-map" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.map")</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    @if(Auth::user('merchant')->can('view_driver_map'))
                                        @if($config->lat_long_storing_at == 2)
                                            <li class="site-menu-item">
                                                <a class="animsition-link"
                                                   href="http://68.183.85.170/v2/webhooks?package_name={{$app_config->merchant_package_name}}">
                                                    <span class="site-menu-title">@lang("$string_file.driver_map")</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="site-menu-item">
                                                <a class="animsition-link" href="{{ route('merchant.drivermap') }}">
                                                    <span class="site-menu-title">@lang("$string_file.driver_map")</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                    @if(Auth::user('merchant')->can('view_heat_map'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('merchant.heatmap') }}">
                                                <span class="site-menu-title">@lang("$string_file.heat_map")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(isset($config->real_time_map) && $config->real_time_map == 1)
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('realtime-driver-map') }}">
                                                <span class="site-menu-title">@lang("$string_file.real_time_map")</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endif

                    @if(Auth::user('merchant')->can('view_rider'))
                        <li class="site-menu-category"
                            id="rider-title">@lang("$string_file.user_management")</li>
                        <li class="site-menu-item">
                            <a href="{{ route('users.index') }}">
                                <i class="site-menu-icon wb-users" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.users")</span>
                            </a>
                        </li>
                        @if(in_array('CARPOOLING',$merchant_segment))
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon fa-cab" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.carpool_vehicles")</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{ route('merchant.uservehicles.allvehicles') }}">
                                            <span class="site-menu-title">@lang("common.all") @lang("common.vehicles")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{ route('merchant.uservehicles.pending.vehicles') }}">
                                            <span class="site-menu-title">@lang("common.pending") @lang("common.approval")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{ route('merchant.uservehicles.rejected') }}">
                                            <span class="site-menu-title">@lang("common.rejected") @lang("common.vehicles")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{ route('merchant.uservehicles.deleted') }}">
                                            <span class="site-menu-title">@lang("common.deleted") @lang("common.vehicles")</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endif

                    @if(Auth::user('merchant')->can('TAXI') && Auth::user('merchant')->can('subscription_package') && $config->subscription_package == 1)
                        <li class="site-menu-category"
                            id="rider-title">@lang("$string_file.subscription_management")</li>
                        <li class="site-menu-item">
                            <a href="{{ route('subscription.index') }}">
                                <i class="site-menu-icon fa-cube" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.packages")</span>
                            </a>
                        </li>
                        <li class="site-menu-item">
                            <a href="{{ route('duration.index') }}">
                                <i class="site-menu-icon fa-hourglass-2" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.durations")</span>
                            </a>
                        </li>
                    @endif

                    @if((in_array('TAXI',$merchant_segment) || in_array('DELIVERY',$merchant_segment)) && Auth::user('merchant')->hasAnyPermission(['view_sos_number','view_sos_request','customer_support']))
                        <li class="site-menu-category"
                            id="rider-title">@lang("$string_file.support_system")</li>
                        @if(Auth::user('merchant')->hasAnyPermission(['view_sos_number','view_sos_request']))
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon fa-volume-control-phone" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.sos")</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    @if(Auth::user('merchant')->can('view_sos_number'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('sos.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.sos_number") </span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->can('view_sos_request'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('merchant.sos.requests') }}">
                                                <span class="site-menu-title">@lang("$string_file.sos_request")</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user('merchant')->can('customer_support'))
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{ route('merchant.customer_support') }}">
                                    <i class="site-menu-icon fa-support" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.customer_support")</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if(Auth::user('merchant')->hasAnyPermission(['view_refer','view_promotion','view_cms','view_child_terms','reward_points','view_language_strings','security_question','wallet_recharge','driver_commission_choices','view_payment_methods']) || $config->referral_code_enable == 1)
                        <li class="site-menu-category" id="other-title">@lang("$string_file.other")</li>
                        @if(Auth::user('merchant')->hasAnyPermission(['view_cms','view_child_terms','view_language_strings','driver_commission_choices','view_payment_methods']))
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon fa-pencil-square" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.content_management")</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    @if(Auth::user('merchant')->can('view_cms'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('cms.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.cms_pages")</span>
                                            </a>
                                        </li>
                                    @endif

                                    @if(Auth::user('merchant')->can('view_child_terms') && $config->family_member_enable == 1)
                                        <li class="site-menu-item">
                                            <a class="animsition-link"
                                               href="{{ route('child-terms-conditions.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.child_terms")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->can('view_language_strings'))

                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('applicationstring.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.app_strings")</span>
                                            </a>
                                        </li>
                                        <li class="site-menu-item">
                                            <a class="animsition-link"
                                               href="{{ route('merchant.module-strings') }}">
                                                <span class="site-menu-title">@lang("$string_file.admin_strings")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->can('TAXI') && Auth::user('merchant')->can('driver_commission_choices') && $config->subscription_package == 1)
                                        <li class="site-menu-item">
                                            <a class="animsition-link"
                                               href="{{ route('driver-commission-choices.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.driver_commission_choice")</span>
                                            </a>
                                        </li>
                                    @endif
{{--                                    @if(Auth::user('merchant')->can('view_payment_methods'))--}}
{{--                                        <li class="site-menu-item">--}}
{{--                                            <a class="animsition-link"--}}
{{--                                               href="{{ route('merchant.paymentMethod.index') }}">--}}
{{--                                                <span class="site-menu-title">@lang("$string_file.payment_method")</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endif--}}
                                </ul>
                            </li>
                        @endif
                        @if(Auth::user('merchant')->can('view_promotion'))
                            <li class="site-menu-item">
                                <a href="{{ route('promotions.index') }}">
                                    <i class="site-menu-icon wb-bell" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.promotional_notification")</span>
                                </a>
                            </li>
                        @endif
                        @if(Auth::user('merchant')->can('wallet_recharge'))
                            <li class="site-menu-item">
                                <a href="{{ route('Wallet.recharge') }}">
                                    <i class="site-menu-icon fa-money" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.wallet_recharge")</span>
                                </a>
                            </li>
                        @endif
                        @if ($app_config && $app_config->reward_points == 1 && Auth::user('merchant')->can('reward_points'))
                            <li class="site-menu-item">
                                <a href="{{ route('reward-points.index') }}">
                                    <i class="site-menu-icon fa-trophy" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.reward_points")</span>
                                </a>
                            </li>
                        @endif
                        @if($config->referral_code_enable == 1 && Auth::user('merchant')->can('view_refer'))
                            <li class="site-menu-item">
                                <a href="{{ route('referral-system') }}">
                                    <i class="site-menu-icon fa-share-alt" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.referral_system")</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user('merchant')->can('security_question') && $app_config->security_question == 1)
                            <li class="site-menu-item">
                                <a href="{{ route('questions.index') }}">
                                    <i class="site-menu-icon fa-question-circle" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.questions")</span>
                                </a>
                            </li>
                        @endif
                    @endif
                    @if(((in_array('FOOD',$merchant_segment) || in_array('GROCERY',$merchant_segment)) && Auth::user('merchant')->hasAnyPermission($grocery_food_exist)) || Auth::user('merchant')->can('view_driver_cash_out') || in_array('CARPOOLING',$merchant_segment))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.transaction_management")</li>
                        <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon wb-users" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.cashout_request")</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                @if((in_array('FOOD',$merchant_segment) || in_array('GROCERY',$merchant_segment)) && Auth::user('merchant')->hasAnyPermission(['FOOD','GROCERY']))
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{route('merchant.business-segment.cashout_request')}}">
                                            <span class="site-menu-title">@lang("$string_file.business_segment")</span>
                                        </a>
                                    </li>
                                @endif
                                @if(Auth::user('merchant')->can('view_driver_cash_out'))
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{route('merchant.driver.cashout_request')}}">
                                            <span class="site-menu-title">@lang("$string_file.driver")</span>
                                        </a>
                                    </li>
                                @endif
                                @if(in_array('CARPOOLING',$merchant_segment))
                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{route('merchant.carpool.user.transaction')}}">
                                            <span class="site-menu-title">@lang("common.user")</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if(Auth::user('merchant')->can('view_reports_charts'))
                        <li class="site-menu-category"
                            id="general-title">@lang("$string_file.report_charts")</li>
                        <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon fa fa-line-chart" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.earning")</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                @if(in_array(1,$merchant_segment_group))
                                    @if(in_array('TAXI',$merchant_segment) || in_array('DELIVERY',$merchant_segment))
                                        <li class="site-menu-item has-sub">
                                            <a href="{{route("merchant.taxi-services-report")}}">
                                                    <i class="site-menu-icon fa fa-taxi" aria-hidden="true"></i>
                                                <span class="site-menu-title">@lang("$string_file.taxi") & @lang("$string_file.logistics_services")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(in_array('FOOD',$merchant_segment) || in_array('GROCERY',$merchant_segment)|| in_array('PHARMACY',$merchant_segment)|| in_array('GAS_DELIVERY',$merchant_segment)|| in_array('WATER_TANK_DELIVERY',$merchant_segment)|| in_array('PARCEL_DELIVERY',$merchant_segment)|| in_array('MEAT_SHOP',$merchant_segment)|| in_array('SWEET_SHOP',$merchant_segment)|| in_array('PAAN_SHOP',$merchant_segment)|| in_array('ARTIFICIAL_JEWELLERY',$merchant_segment)  || in_array('WINE_DELIVERY',$merchant_segment))
                                        <li class="site-menu-item has-sub">
                                            <a href="{{route("merchant.delivery-services-report")}}">
                                                    <i class="site-menu-icon fa fa-ship" aria-hidden="true"></i>
                                                <span class="site-menu-title">@lang("$string_file.delivery_services")</span>
                                            </a>
                                        </li>
                                    @endif
                                @endif
                                @if(in_array(2,$merchant_segment_group))
                                    <li class="site-menu-item has-sub">
                                        <a href="{{route("merchant.handyman-services-report")}}">
                                                <i class="site-menu-icon fa fa-lightbulb-o" aria-hidden="true"></i>
                                            <span class="site-menu-title">@lang("$string_file.handyman_services")</span>
                                        </a>
                                    </li>
                                @endif
                                <li class="site-menu-item has-sub">
                                    <a href="{{route("merchant.driver.earning")}}">
                                        <i class="site-menu-icon fa fa-money" aria-hidden="true"></i>
                                        <span class="site-menu-title">@lang("$string_file.driver_earning")</span>
                                    </a>
                                </li>
                                @if(in_array(3,$merchant_segment_group) && in_array('CARPOOLING',$merchant_segment))
                                    <li class="site-menu-item has-sub">
                                        <a href="{{route('merchant.carpooling.earning')}}">
                                            <i class="site-menu-icon fa fa-lightbulb-o" aria-hidden="true"></i>
                                            <span class="site-menu-title">@lang("$string_file.carpooling") @lang("common.earning")</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon fa fa-file" aria-hidden="true"></i>
                                <span class="site-menu-title">@lang("$string_file.wallet_transaction")</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                <li class="site-menu-item has-sub">
                                    <a href="{{route("transaction.wallet-report",["slug" => "USER"])}}">
                                        <i class="site-menu-icon fa fa-lightbulb-o" aria-hidden="true"></i>
                                        <span class="site-menu-title">@lang("$string_file.user")</span>
                                    </a>
                                </li>
                                @if($config->driver_enable == 1)
                                    <li class="site-menu-item has-sub">
                                        <a href="{{route("transaction.wallet-report",["slug" => "DRIVER"])}}">
                                            <i class="site-menu-icon fa fa-money" aria-hidden="true"></i>
                                            <span class="site-menu-title">@lang("$string_file.driver")</span>
                                        </a>
                                    </li>
                                @endif
                                @if(in_array(1,$merchant_segment_group))
                                    @if(in_array('FOOD',$merchant_segment) || in_array('GROCERY',$merchant_segment)|| in_array('PHARMACY',$merchant_segment)|| in_array('GAS_DELIVERY',$merchant_segment)|| in_array('WATER_TANK_DELIVERY',$merchant_segment)|| in_array('PARCEL_DELIVERY',$merchant_segment)|| in_array('MEAT_SHOP',$merchant_segment)|| in_array('SWEET_SHOP',$merchant_segment)|| in_array('PAAN_SHOP',$merchant_segment)|| in_array('ARTIFICIAL_JEWELLERY',$merchant_segment)  || in_array('WINE_DELIVERY',$merchant_segment) || in_array('HARDWARE_DELIVERY',$merchant_segment))
                                        <li class="site-menu-item has-sub">
                                            <a href="{{route("transaction.wallet-report",["slug" => "BUSINESS-SEGMENT"])}}">
                                                <i class="site-menu-icon fa fa-ship" aria-hidden="true"></i>
                                                <span class="site-menu-title">@lang("$string_file.business_segment")</span>
                                            </a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </li>
                        @if ($config->transactions_view_enable == 1)
                            <li class="site-menu-item has-sub">
                                <a href="{{ route('payment.gateway.transactions') }}">
                                    <i class="site-menu-icon fa fa-money" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.payment_transaction")</span>
                                </a>
                            </li>
                        @endif
                        @if ($config->referral_code_enable == 1)
                            <li class="site-menu-item">
                                <a href="{{ route('report.referral') }}">
                                    <i class="site-menu-icon fa-link" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.referral")</span>
                                </a>
                            </li>
                        @endif
                        @if(in_array('CARPOOLING',$merchant_segment))
                            <li class="site-menu-category"
                                id="carpooling-title">@lang("$string_file.carpooling")   @lang("common.configuration")</li>
                            <!--<li class="site-menu-item">-->
                        <!--    <a class="animsition-link" href="{{route('merchant.carpooling.earning')}}">-->
                            <!--        <i class="site-menu-icon far fa-money" aria-hidden="true"></i>-->
                        <!--        <span class="site-menu-title">@lang("$string_file.carpooling")  @lang("common.earning")</span>-->
                            <!--    </a>-->
                            <!--</li>-->
                            <!--<li class="site-menu-item">-->
                        <!--    <a class="animsition-link" href="{{route('merchant.carpooling.payment_configuration')}}">-->
                            <!--        <i class="site-menu-icon far fa-money" aria-hidden="true"></i>-->
                        <!--        <span class="site-menu-title">@lang("common.payment") @lang("common.configuration")</span>-->
                            <!--    </a>-->
                            <!--</li>-->
                            <li class="site-menu-item">
                                <a class="animsition-link" href="{{route('merchant.carpooling.config.country.id')}}">
                                    <i class="site-menu-icon far fa-plus" aria-hidden="true"></i>
                                    <span class="site-menu-title"> @lang("common.country") @lang("$string_file.carpooling") @lang("common.configuration")</span>
                                </a>
                            </li>
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon far fa-car" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("common.offer") @lang("$string_file.ride") @lang("common.management")</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{ route('merchant.offer.rides') }}">
                                            <span class="site-menu-title">@lang("common.all") @lang("$string_file.ride")</span>
                                        </a>
                                    </li>

                                    <li class="site-menu-item">
                                        <a class="animsition-link"
                                           href="{{route('merchant.carpool.offer_up_coming.rides')}}">
                                            <span class="site-menu-title">@lang("common.up_coming") @lang("$string_file.ride")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{route('merchant.offer_active.rides')}}">
                                            <span class="site-menu-title">@lang("common.on_going") @lang("$string_file.ride")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{route('merchant.offer_complete.rides')}}">
                                            <span class="site-menu-title">@lang("common.complete") @lang("$string_file.ride")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{route('merchant.offer_cancel.rides')}}">
                                            <span class="site-menu-title">@lang("common.cancel") @lang("$string_file.ride")</span>
                                        </a>
                                    </li>
                                    {{--                                    <li class="site-menu-item">--}}
                                    {{--                                        <a class="animsition-link" href="{{route('merchant.failed.rides')}}">--}}
                                    {{--                                            <span class="site-menu-title">@lang("common.failed") @lang("$string_file.ride")</span>--}}
                                    {{--                                        </a>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li class="site-menu-item">--}}
                                    {{--                                        <a class="animsition-link" href="{{route('merchant.auto-cancel.rides')}}">--}}
                                    {{--                                            <span class="site-menu-title"> @lang("common.auto") @lang("common.cancel") @lang("$string_file.ride")</span>--}}
                                    {{--                                        </a>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li class="site-menu-item">--}}
                                    {{--                                        <a class="animsition-link" href="{{route('merchant.all.rides')}}">--}}
                                    {{--                                            <span class="site-menu-title">@lang("common.past") @lang("$string_file.ride")</span>--}}
                                    {{--                                        </a>--}}
                                    {{--                                    </li>--}}

                                </ul>
                            </li>
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon fa-pencil-square" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.ride") @lang("common.management")</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">

                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{route('merchant.carpool.up_coming.rides')}}">
                                            <span class="site-menu-title">@lang("common.up_coming") @lang("$string_file.ride")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{route('merchant.active.rides')}}">
                                            <span class="site-menu-title">@lang("common.on_going") @lang("$string_file.ride")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{route('merchant.complete.rides')}}">
                                            <span class="site-menu-title">@lang("common.complete") @lang("$string_file.ride")</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="{{route('merchant.cancel.rides')}}">
                                            <span class="site-menu-title">@lang("common.cancel") @lang("$string_file.ride")</span>
                                        </a>
                                    </li>
                                    {{--                                    <li class="site-menu-item">--}}
                                    {{--                                        <a class="animsition-link" href="{{route('merchant.failed.rides')}}">--}}
                                    {{--                                            <span class="site-menu-title">@lang("common.failed") @lang("$string_file.ride")</span>--}}
                                    {{--                                        </a>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li class="site-menu-item">--}}
                                    {{--                                        <a class="animsition-link" href="{{route('merchant.auto-cancel.rides')}}">--}}
                                    {{--                                            <span class="site-menu-title"> @lang("common.auto") @lang("common.cancel") @lang("$string_file.ride")</span>--}}
                                    {{--                                        </a>--}}
                                    {{--                                    </li>--}}
                                    {{--                                    <li class="site-menu-item">--}}
                                    {{--                                        <a class="animsition-link" href="{{route('merchant.all.rides')}}">--}}
                                    {{--                                            <span class="site-menu-title">@lang("common.past") @lang("$string_file.ride")</span>--}}
                                    {{--                                        </a>--}}
                                    {{--                                    </li>--}}

                                </ul>
                            </li>
                        @endif
                    @endif
                    @if(((in_array('TAXI',$merchant_segment) || in_array('DELIVERY',$merchant_segment)) && Auth::user('merchant')->hasAnyPermission(['DELIVERY','TAXI','navigation_drawers'])) ||
                        (Auth::user('merchant')->hasAnyPermission(['DELIVERY','TAXI','HANDYMAN']) || Auth::user('merchant')->hasAnyPermission($all_food_grocery_clone)) ||
                        (isset($config->stripe_connect_enable) && $config->stripe_connect_enable == 1) ||
                        Auth::user('merchant')->hasAnyPermission(['view_admin','view_role','view_configuration','view_service_types','navigation_drawers','view_applications_url','view_onesignal','view_email_configurations','view-driver-account-types','view_payment_methods']))
                        <li class="site-menu-category" id="settings-title">@lang("$string_file.settings")</li>
                        @if( Auth::user('merchant')->hasAnyPermission(['view_admin','view_role']))
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon wb-users" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.sub_admin")</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    @if(Auth::user('merchant')->can('view_admin'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('subadmin.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.admin_list")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->can('view_role'))
                                        {{--                                        <li class="site-menu-item">--}}
                                        {{--                                            <a class="animsition-link" href="{{ route('role.index') }}">--}}
                                        {{--                                                <span class="site-menu-title">@lang("$string_file.role")</span>--}}
                                        {{--                                            </a>--}}
                                        {{--                                        </li>--}}
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('new-role.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.role")</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if(((in_array('TAXI',$merchant_segment) || in_array('DELIVERY',$merchant_segment)) && Auth::user('merchant')->hasAnyPermission(['DELIVERY','TAXI','navigation_drawers'])) ||
                            (Auth::user('merchant')->hasAnyPermission(['DELIVERY','TAXI','HANDYMAN']) || Auth::user('merchant')->hasAnyPermission($all_food_grocery_clone)) ||
                            (isset($config->stripe_connect_enable) && $config->stripe_connect_enable == 1) ||
                            Auth::user('merchant')->hasAnyPermission(['view_configuration','view_service_types','view_applications_url','view_onesignal','view_email_configurations','view-driver-account-types','view_payment_methods']))
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon fas fa-cogs" aria-hidden="true"></i>
                                    <span class="site-menu-title">@lang("$string_file.settings_configuration")</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    @if(Auth::user('merchant')->can('view_configuration'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link"
                                               href="{{ route('merchant.general_configuration') }}">
                                                <span class="site-menu-title">@lang("$string_file.general")</span>
                                            </a>
                                        </li>
                                        <li class="site-menu-item">
                                            <a class="animsition-link"
                                               href="{{ route('merchant.booking_configuration') }}">
                                                <span class="site-menu-title">@lang("$string_file.request_config")</span>
                                            </a>
                                        </li>
                                        @if($config->driver_enable == 1)
                                            <li class="site-menu-item">
                                                <a class="animsition-link"
                                                   href="{{ route('merchant.driver_configuration') }}">
                                                    <span class="site-menu-title">@lang("$string_file.driver_configuration")</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                    @if(Auth::user('merchant')->can('view_email_configurations'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('merchant.emailtemplate') }}">
                                                <span class="site-menu-title">@lang("$string_file.email_configuration")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->can('view_service_types'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('merchant.serviceType.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.service_type_settings")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if((in_array('TAXI',$merchant_segment) || in_array('DELIVERY',$merchant_segment)) && Auth::user('merchant')->hasAnyPermission(['DELIVERY','TAXI','navigation_drawers']))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('navigation-drawer.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.navigation_drawer")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->can('view_applications_url'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('merchant.application') }}">
                                                <span class="site-menu-title">@lang("$string_file.application_url")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->can('view_onesignal'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('merchant.onesignal') }}">
                                                <span class="site-menu-title">@lang("$string_file.push_notification_config")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->hasAnyPermission(['DELIVERY','TAXI','HANDYMAN','CARPOOLING']) || Auth::user('merchant')->hasAnyPermission($all_food_grocery_clone))
                                        <li class="site-menu-item">
                                            <a class="animsition-link" href="{{ route('cancelreason.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.cancel_reason")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(Auth::user('merchant')->can('view_payment_methods'))
                                        <li class="site-menu-item">
                                            <a class="animsition-link"
                                               href="{{ route('merchant.paymentMethod.index') }}">
                                                <span class="site-menu-title">@lang("$string_file.payment_method")</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if(isset($config->stripe_connect_enable) && $config->stripe_connect_enable == 1)
                                        <li class="site-menu-item">
                                            <a class="animsition-link"
                                               href="{{ route('merchant.stripe_connect_configuration') }}">
                                                <span class="site-menu-title">@lang("$string_file.stripe_connect")</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>
    {{--        </div>--}}
    <div class="site-menubar-footer" id="sidebarfooter-title">
        <a href="{{ route('merchant.general_configuration.store') }}" class="fold-show" data-placement="top"
           data-toggle="tooltip" data-original-title="General">
            <span class="icon fa-gears" aria-hidden="true"></span>
        </a>
        <a href="{{ route('merchant.profile') }}" data-placement="top" data-toggle="tooltip"
           data-original-title="Update Profile">
            <span class="icon wb-user" aria-hidden="true"></span>
        </a>
        <a href="{{ route('merchant.logout') }}" data-placement="top" data-toggle="tooltip"
           data-original-title="Logout">
            <span class="icon wb-power" aria-hidden="true"></span>
        </a>
    </div>
</div>

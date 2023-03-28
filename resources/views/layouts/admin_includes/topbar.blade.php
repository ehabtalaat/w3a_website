<?php
$other_locale = LaravelLocalization::getCurrentLocale() == "en" ? "Ar" : "En";
$flag = LaravelLocalization::getCurrentLocale() == "ar" ? asset('assets/media/svg/flags/226-united-states.svg') : asset('assets/media/svg/flags/133-saudi-arabia.svg');
?>
<!--begin::Topbar-->
<div class="topbar">

    <!--begin::Languages-->
    <div class="dropdown">
        <!--begin::Toggle-->
        <!-- <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px"> -->
        <a class="nav-link mt-4" href="{{ LaravelLocalization::getLocalizedURL(strtolower($other_locale), null, [], true) }}">

            <img class="h-20px w-20px rounded-sm" src="{{$flag}}" alt="" />
            <!-- {{$other_locale}} -->
        </a>
        <!-- <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">




                    </div> -->
        <!-- </div> -->
        <!--end::Toggle-->
        <!--begin::Dropdown-->
        <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
            <!--begin::Nav-->

            <!-- <ul class="navi navi-hover py-4">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
<li>
<li class="navi-item">
<a rel="alternate" hreflang="{{ $localeCode }}"
href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
 class="navi-link">
                                <span class="symbol symbol-20 mr-3">
                                </span>
                                <span class="navi-text">   {{ $properties['native'] }}</span>
                            </a>
                        </li>

</li>
@endforeach

                    </ul> -->
            <!--end::Nav-->
        </div>
        <!--end::Dropdown-->
    </div>
    <!--end::Languages-->
    <!--begin::User-->
    <div class="dropdown">
        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
            <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">
                    {{__('messages.hi')}}</span>
                <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">
                </span>
                <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                    <img alt="Logo" src="{{asset('uploads/logo.png')}}" /></span>

            </div>
        </div>
        <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
            <ul class="navi navi-hover py-4">
                <!--begin::Item-->
                <li class="navi-item">
                    <a href="" class="navi-link">
                        <span class="navi-text">{{__('messages.logout')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!--end::User-->
</div>
<!--end::Topbar-->

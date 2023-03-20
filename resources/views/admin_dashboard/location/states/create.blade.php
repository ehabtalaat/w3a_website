@extends('Admin::layouts.index')
@section('content')
    <!--content-->

    <section class="content_section">
        <div class="row">
            <div class="content_text">
                <h4 class="main_header_text">
                    {{__('messages.add state')}}
                </h4>

            </div>

        </div>

        <div class="card_content">

            <form method="post" action="{{route('states.store')}}" enctype="multipart/form-data">
                @csrf
            <div class="row">



                <div class="col-md-12">

                    <div class="row mt-4">

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label custom_label"> {{__('messages.country')}} </label>
                                <select class="form-select form-control selectpicker custom_select"
                                name="country_id"
                                data-live-search="true"  title="&nbsp;">
                                    @foreach ($countries as $country)
                                        
                                    <option value="{{$country->id}}">{{$country->title}}</option>
                                     @endforeach
                                </select>
                                @error('country_id') <span class="invalid-feedback">
                                    {{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <div class="col-md-6 col-12">
                            <div class="form-group">

                                <label class="custom_label form-label ">  {{ __('messages.title_'.$localeCode) }}
                                    <span class="text-danger"> ( {{ $localeCode }} )</span></label>
                                <input class="form-control custom_input @error('title-' . $localeCode) is-invalid 
                                @enderror" type="text" name="title-{{$localeCode}}" required
                                    placeholder="{{ __('messages.title_'.$localeCode) }}">
                                    @error('title-' . $localeCode) <span class="invalid-feedback">
                                        {{ $message }}</span> @enderror
                            </div>
                        </div>

                        @endforeach


                    </div>
                    <div class="row mt-4">
                        <div class="col-md-8 col-12">
                            <button class="btn save_btn" type="submit">{{__('messages.save_data')}}</button>
                        </div>
          
                        <div class="col-md-4 col-12 mt-md-0 mt-3">
                            <a class="btn cancel_form_btn"  href="{{ url()->previous()}}">{{__('messages.cancel')}}</a>
                        </div>
                    </div>
                </div>
            </div>

            </form>

        </div>
    </section>
    <!--content-->
@endsection

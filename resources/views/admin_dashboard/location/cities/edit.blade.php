@extends('Admin::layouts.index')
@section('content')
    <!--content-->

    <section class="content_section">
        <div class="row">
            <div class="content_text">
                <h4 class="main_header_text">
                    {{__('messages.edit city')}}
                </h4>

            </div>

        </div>

        <div class="card_content">

            <form method="post" action="{{route('cities.update',$city->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="row">



                <div class="col-md-12">
                    <div class="row mt-4">

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label custom_label"> {{__('messages.country')}} </label>
                                <select class="form-select form-control selectpicker custom_select"
                                name="country_id" onchange="filter_states(this)"
                                data-live-search="true"  title="&nbsp;">
                                    @foreach ($countries as $country)
                                        
                                    <option value="{{$country->id}}" @selected($country->id == $city->country_id)>{{$country->title}}</option>
                                     @endforeach
                                </select>
                                @error('country_id') <span class="invalid-feedback">
                                    {{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label custom_label"> {{__('messages.state')}} </label>
                                <select class="form-select form-control selectpicker custom_select"
                                name="state_id" id="state_id"
                                data-live-search="true"  title="&nbsp;">
                                    @foreach ($states as $state)
                                        
                                    <option value="{{$state->id}}" @selected($state->id == $city->state_id)>{{$state->title}}</option>
                                     @endforeach
                                </select>
                                @error('state_id') <span class="invalid-feedback">
                                    {{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <div class="col-md-6 col-6">
                            <div class="form-group">

                                <label class="custom_label form-label ">  {{ __('messages.title_'.$localeCode) }}
                                    <span class="text-danger"> ( {{ $localeCode }} )</span></label>
                                <input class="form-control custom_input @error('title-' . $localeCode) is-invalid 
                                @enderror" type="text" name="title-{{$localeCode}}" required value="{{ $country->translate($localeCode)->title ?? ''}}"
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
@section("scripts")
<script>
    function filter_states(select){

        let id = select.value;

    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
    type:'post',
    url: `{{route('filter_states')}}`,
    data:{
    "country_id":id
    },
    //    contentType: "application/json; charset=utf-8",
    dataType: "Json",
    success: function(result){
    if(result.status == true){
   $("#state_id").empty();
   $("#state_id").append(result.data);
   $("#state_id").selectpicker("refresh");
    }
    }
    });
    }

</script>
@endsection
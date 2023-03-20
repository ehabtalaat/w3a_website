@extends('Admin::layouts.index')
@section('content')
    <!--content-->

    <section class="content_section">
        <div class="row">
            <div class="content_text">
                <h4 class="main_header_text">
                    {{__('messages.add city')}}
                </h4>

            </div>

        </div>

        <div class="card_content">

            <form method="post" action="{{route('cities.store')}}" enctype="multipart/form-data">
                @csrf
            <div class="row">



                <div class="col-md-12">

                    <div class="row mt-4">

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label custom_label"> {{__('messages.country')}} </label>
                                <select class="form-select form-control selectpicker custom_select"
                                name="country_id"  onchange="filter_states(this)"
                                data-live-search="true"  title="&nbsp;">
                                    @foreach ($countries as $country)
                                        
                                    <option value="{{$country->id}}">{{$country->title}}</option>
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
                                id="state_id"
                                name="state_id"
                                data-live-search="true"  title="&nbsp;">
                                    @foreach ($states as $state)
                                        
                                    <option value="{{$state->id}}">{{$state->title}}</option>
                                     @endforeach
                                </select>
                                @error('state_id') <span class="invalid-feedback">
                                    {{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <div class="col-md-6 md-12">
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
              <div class="col-8">
                  <button class="btn save_btn" type="submit">{{__('messages.save_data')}}</button>
              </div>

              <div class="col-4">
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
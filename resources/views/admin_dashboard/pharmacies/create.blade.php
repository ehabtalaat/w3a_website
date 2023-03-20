@extends('Admin::layouts.index')
@section('content')
<section class="content_section">
  <div class="row">
      <div class="content_text">
          <h4 class="main_header_text">
             {{__('messages.add pharmacy')}}
          </h4>

      </div>

  </div>

  <div class="card_content">

    <form method="post" action="{{route('pharmacies.store')}}" enctype="multipart/form-data">
      @csrf
      <div class="row">

          <div class="col-lg-3 col-md-3 col-12 mx-auto">

              <img src="{{asset('assets/media/images/image_cover.png')}}"
                  class="image_upload">


              <div class="form-group">
                  <label for="file_upload_image" class="custom_image_upload">

                    {{__('messages.upload image')}}
                  </label>
                  <input id="file_upload_image" type="file" name="image" />
              </div>
              <script>function readURL(input) {
                      if (input.files && input.files[0]) {
                          var reader = new FileReader();

                          reader.onload = function (e) {
                              // $('.image_upload').css('background-image', 0);

                              $('.image_upload').attr('src', e.target.result);
                          }

                          reader.readAsDataURL(input.files[0]);
                      }
                  }

                  $("#file_upload_image").change(function () {
                
                      readURL(this);
                  });</script>
                  @error('image') <span class="invalid-feedback">
                    {{ $message }}</span> @enderror

          </div>

          {{-- <div class="col-lg-3 col-md-3 col-12">

            <img src="{{asset('assets/media/images/image_cover.png')}}"
                class="logo_upload">


            <div class="form-group">
                <label for="file_upload_logo" class="custom_image_upload">

                  {{__('messages.upload logo')}}
                </label>
                <input id="file_upload_logo"  class="file_upload_image" type="file" name="logo" />
            </div>
            <script>function readURL1(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {

                            $('.logo_upload').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $("#file_upload_logo").change(function () {
              
                    readURL1(this);
                });</script>
                @error('logo') <span class="invalid-feedback">
    {{ $message }}</span> @enderror

        </div> --}}

          <div class="col-lg-12 col-md-12 col-12 mt-4">

              <div class="row">
                  <div class="col-md-6 col-12 mt-3">
                      <div class="form-group">
                          <label class="custom_label form-label "> {{__('messages.name')}}</label>
                          <input class="form-control custom_input @error('name') is-invalid @enderror" type="text" 
                          name="name"
                          placeholder="{{__('messages.name')}}"
                          value="{{ old('name')}}" required >
                          @error('name') <span class="invalid-feedback">
                            {{ $message }}</span> @enderror
                      </div>
                  </div>

                  <div class="col-md-6 col-12 mt-3">
                    <div class="form-group">
                        <label class="custom_label form-label "> {{__('messages.phone')}}</label>
                        <input class="form-control custom_input @error('phone') is-invalid @enderror" type="number"
                        name="phone"
                        placeholder="{{__('messages.phone')}}"
                        value="{{ old('phone')}}" required >
                        @error('phone') <span class="invalid-feedback">
                          {{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6 col-12 mt-3">
                  <div class="form-group">
                      <label class="custom_label form-label "> {{__('messages.password')}}</label>
                      <input class="form-control custom_input @error('password') is-invalid @enderror"  type="password" 
                       name="password"
                      placeholder="{{__('messages.password')}}"
                     required >
                     @error('password') <span class="invalid-feedback">
                      {{ $message }}</span> @enderror
                  </div>
              </div>

              {{-- <div class="col-md-6 col-12 mt-3">
                <div class="form-group">
                    <label class="custom_label form-label "> {{__('messages.color')}}</label>
                    <input class="form-control custom_input @error('color') is-invalid @enderror" type="color"
                    name="color"
                    placeholder="{{__('messages.color')}}"
                    value="{{ old('color')}}" required >
                    @error('color') <span class="invalid-feedback">
                      {{ $message }}</span> @enderror
                </div>
            </div> --}}
        
           
              </div>

              {{-- <div class="row">
                <div class="col-md-12 col-12 mt-3">
                    <div class="form-group">
                        <label class="custom_label form-label "> {{__('messages.notification_key')}}</label>
                        <input class="form-control custom_input @error('notification_key') is-invalid @enderror" type="text" 
                        name="notification_key"
                        placeholder="{{__('messages.notification_key')}}"
                        value="{{ old('notification_key')}}"  >
                        @error('notification_key') <span class="invalid-feedback">
                          {{ $message }}</span> @enderror
                    </div>
                </div>
              </div> --}}
              {{-- <div class="row">
                <div class="col-md-4 col-12 mt-3">
                    <div class="form-group">
                        <label class="custom_label form-label "> {{__('messages.android_version')}}</label>
                        <input class="form-control custom_input @error('android_version') is-invalid @enderror" type="text" 
                        name="android_version"
                        placeholder="{{__('messages.android_version')}}"
                        value="{{ old('android_version')}}"  >
                        @error('android_version') <span class="invalid-feedback">
                          {{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-4 col-12 mt-3">
                  <div class="form-group">
                      <label class="custom_label form-label "> {{__('messages.ios_version')}}</label>
                      <input class="form-control custom_input @error('ios_version') is-invalid @enderror" type="text"
                      name="ios_version"
                      placeholder="{{__('messages.ios_version')}}"
                      value="{{ old('ios_version')}}"  >
                      @error('ios_version') <span class="invalid-feedback">
                        {{ $message }}</span> @enderror
                  </div>
              </div>

              <div class="col-md-4 col-12 mt-3">
                <div class="form-group">
                    <label class="custom_label form-label "> {{__('messages.huawei_version')}}</label>
                    <input class="form-control custom_input @error('huawei_version') is-invalid @enderror"  type="text" 
                     name="huawei_version"
                    placeholder="{{__('messages.huawei_version')}}"
                    >
                   @error('huawei_version') <span class="invalid-feedback">
                    {{ $message }}</span> @enderror
                </div>
            </div>

           


              </div> --}}

              {{-- <div class="row mt-4">
                <div class="col-md-12 col-12 mt-3">
                    <div class="form-group">
                        <label class="custom_label form-label "> {{__('messages.android_link')}}</label>
                        <input class="form-control custom_input @error('android_link') is-invalid @enderror" type="text" 
                        name="android_link"
                        placeholder="{{__('messages.android_link')}}"
                        value="{{ old('android_link')}}"  >
                        @error('android_link') <span class="invalid-feedback">
                          {{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="col-md-12 col-12 mt-3">
                  <div class="form-group">
                      <label class="custom_label form-label "> {{__('messages.ios_link')}}</label>
                      <input class="form-control custom_input @error('ios_link') is-invalid @enderror" type="text"
                      name="ios_link"
                      placeholder="{{__('messages.ios_link')}}"
                      value="{{ old('ios_link')}}"  >
                      @error('ios_link') <span class="invalid-feedback">
                        {{ $message }}</span> @enderror
                  </div>
                </div>
                
                <div class="col-md-12 col-12 mt-3">
                <div class="form-group">
                    <label class="custom_label form-label "> {{__('messages.huawei_link')}}</label>
                    <input class="form-control custom_input @error('huawei_link') is-invalid @enderror"  type="text" 
                     name="huawei_link"
                    placeholder="{{__('messages.huawei_link')}}"
                    >
                   @error('huawei_link') <span class="invalid-feedback">
                    {{ $message }}</span> @enderror
                </div>
                </div>
              </div> --}}
              {{-- <div class="row mb-4">
            <div class="col-md-4 col-12 mt-4">
                <div class="form-group mt-4">
                <div class="form-check form-switch">
                    <label class="form-label custom_label">
                    <input class="form-check-input table_check" name="android_accepted" value="1"
                        type="checkbox" >
                        {{__('messages.android_accepted')}}</label>
                </div>
            </div>
            </div>
            <div class="col-md-4 col-12 mt-4">
                <div class="form-group mt-4">
                <div class="form-check form-switch">
                    <label class="form-label custom_label">
                    <input class="form-check-input table_check" name="ios_accepted" value="1"
                        type="checkbox" >
                        {{__('messages.ios_accepted')}}</label>
                </div>
            </div>
        </div>
            <div class="col-md-4 col-12 mt-4">
                <div class="form-group mt-4">
                <div class="form-check form-switch">
                    <label class="form-label custom_label">
                    <input class="form-check-input table_check" name="huawei_accepted" value="1"
                        type="checkbox" >
                        {{__('messages.huawei_accepted')}}</label>
                </div>
            </div> </div>
           

            <div class="col-md-4 col-12 mt-4">
                <div class="form-group mt-4">
                <div class="form-check form-switch">
                    <label class="form-label custom_label">
                    <input class="form-check-input table_check" name="new_ios_status" value="1"
                        type="checkbox" >
                        {{__('messages.new_ios_status')}}</label>
                </div>
            </div>
            </div>
            <div class="col-md-4 col-12 mt-4">
                <div class="form-group mt-4">
                <div class="form-check form-switch">
                    <label class="form-label custom_label">
                    <input class="form-check-input table_check" name="old_ios_status" value="1"
                        type="checkbox" >
                        {{__('messages.old_ios_status')}}</label>
                </div>
            </div>
        </div>
            <div class="col-md-4 col-12 mt-4">
                <div class="form-group mt-4">
                <div class="form-check form-switch">
                    <label class="form-label custom_label">
                    <input class="form-check-input table_check" name="new_android_status" value="1"
                        type="checkbox" >
                        {{__('messages.new_android_status')}}</label>
                </div>
            </div> </div>

            <div class="col-md-4 col-12 mt-4">
                <div class="form-group mt-4">
                <div class="form-check form-switch">
                    <label class="form-label custom_label">
                    <input class="form-check-input table_check" name="old_android_status" value="1"
                        type="checkbox" >
                        {{__('messages.old_android_status')}}</label>
                </div>
            </div>
            </div>
            <div class="col-md-4 col-12 mt-4">
                <div class="form-group mt-4">
                <div class="form-check form-switch">
                    <label class="form-label custom_label">
                    <input class="form-check-input table_check" name="new_huawei_status" value="1"
                        type="checkbox" >
                        {{__('messages.new_huawei_status')}}</label>
                </div>
            </div>
        </div>
            <div class="col-md-4 col-12 mt-4">
                <div class="form-group mt-4">
                <div class="form-check form-switch">
                    <label class="form-label custom_label">
                    <input class="form-check-input table_check" name="old_huawei_status" value="1"
                        type="checkbox" >
                        {{__('messages.old_huawei_status')}}</label>
                </div>
            </div> </div>



              </div> --}}
              <div class="row">
              <div class="col-md-6 col-12 mt-3">
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

            <div class="col-md-6 col-12 mt-3">
                <div class="form-group">
                    <label class="form-label custom_label"> {{__('messages.state')}} </label>
                    <select class="form-select form-control selectpicker custom_select"
                    id="state_id"
                    name="state_id"  onchange="filter_cities(this)"
                    data-live-search="true"  title="&nbsp;">
                        @foreach ($states as $state)
                            
                        <option value="{{$state->id}}">{{$state->title}}</option>
                         @endforeach
                    </select>
                    @error('state_id') <span class="invalid-feedback">
                        {{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-6 col-12 mt-3">
                <div class="form-group">
                    <label class="form-label custom_label"> {{__('messages.city')}} </label>
                    <select class="form-select form-control selectpicker custom_select"
                    id="city_id"
                    name="city_id"  
                    data-live-search="true"  title="&nbsp;">
                        @foreach ($cities as $city)
                            
                        <option value="{{$city->id}}">{{$city->title}}</option>
                         @endforeach
                    </select>
                    @error('city_id') <span class="invalid-feedback">
                        {{ $message }}</span> @enderror
                </div>
            </div> 
              </div>
            </div>
            <div class="row mt-4">
              <div id="map" style="width:100%;height:400px; ">
            </div>
             
               <input type="hidden" class="form-control " value="{{old('lat')}}" id="Lat" name="lat" />
            
     
               <input type="hidden" class="form-control " value="{{old('lon')}}"  id="Lng" name="lon" />
              
            </div>
              <div class="row">

            <div class="col-md-4 col-12 mt-3">
                <div class="form-group">
                    <label class="form-label custom_label"> {{__('messages.payment_methods')}} </label>
                    <select class="form-select form-control selectpicker custom_select"
                    name="payment_method_ids[]"  multiple
                    data-live-search="true"  title="&nbsp;">
                        @foreach ($payment_methods as $payment_method)
                            
                        <option value="{{$payment_method->id}}">{{$payment_method->title}}</option>
                         @endforeach
                    </select>
                    @error('payment_method_ids') <span class="invalid-feedback">
                        {{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-4 col-12 mt-3">
                <div class="form-group">
                    <label class="custom_label form-label "> {{__('messages.price')}}</label>
                    <input class="form-control custom_input @error('price') is-invalid @enderror"  type="number" 
                     name="price"
                    placeholder="{{__('messages.price')}}"    value="{{ old('price')}}" 
                   required >
                   @error('price') <span class="invalid-feedback">
                    {{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-4 col-12 mt-3">
                <div class="form-group">
                    <label class="form-label custom_label"> {{__('messages.status')}} </label>
                    <select class="form-select form-control selectpicker custom_select"
                    name="status" 
                    data-live-search="true"  title="&nbsp;">
                       
                            
                        <option value="0">{{__('messages.done')}}</option>
                        <option value="1">{{__('messages.there_is_problem')}}</option>
                        <option value="2">{{__('messages.not_pay')}}</option>
                    </select>
                    @error('status') <span class="invalid-feedback">
                        {{ $message }}</span> @enderror
                </div>
            </div>


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
@endsection
@section("scripts")
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
    function initialize() {
        var myLatlng = new google.maps.LatLng(25.381427, 49.582997);

        var mapOptions = {
            center: myLatlng,
            zoom: 14
        };

        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'I move with you man :)'
        });

        google.maps.event.addListener(map, 'click', function(e) {
            //marker.setPosition(e.latLng);
            map.panTo(e.latLng)
            var Lat = e.latLng.lat();
                    var Lng = e.latLng.lng();
                    $('#Lat').val(Lat);
                    $('#Lng').val(Lng);
            //map.setCenter(e.latLng);
        });
        
        google.maps.event.addListener(map, 'center_changed', function() {
            var center = map.getCenter();
            marker.setPosition(center);

            window.setTimeout(function() {
                geocodeLatLng(geocoder, map, infowindow, marker);
            }, 2000);
        });
    }

    function geocodeLatLng(geocoder, map, infowindow, marker) {
        geocoder.geocode({
            'location': marker.position
        }, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                console.log(results);
                if (results[1]) {
                    //map.setZoom(11);
                    infowindow.setContent(results[1].formatted_address);
                    infowindow.open(map, marker);
                } else {
                    console.warn('GeoCoder: No results found');
                }
            } else {
                console.warn('Geocoder failed due to: ' + status);
            }
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
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

    function filter_cities(select){

let id = select.value;

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$.ajax({
type:'post',
url: `{{route('filter_cities')}}`,
data:{
"state_id":id
},
//    contentType: "application/json; charset=utf-8",
dataType: "Json",
success: function(result){
if(result.status == true){
$("#city_id").empty();
$("#city_id").append(result.data);
$("#city_id").selectpicker("refresh");
}
}
});
}

</script>


@endsection
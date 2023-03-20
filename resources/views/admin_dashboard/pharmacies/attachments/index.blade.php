@extends('Admin::layouts.index')
@section('content')
<section class="content_section">
  <div class="row">
      <div class="content_text">
          <h4 class="main_header_text">
             {{__('messages.edit pharmacy')}}
          </h4>

      </div>

  </div>

  <div class="card_content">

    <form method="post" action="{{route('pharmacies.attachments.update',$pharmacy->id)}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="row">

        

        <div class="col-lg-3 col-md-3 col-12 mx-auto">

            <img src="{{$pharmacy->pharmacy_attachment ? $pharmacy->pharmacy_attachment->logo_link  : ''}}"
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
                            // $('.image_upload').css('background-image', 0);

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

        </div>
      </div>
       
              
              <div class="row">
                <div class="col-md-12 col-12 mt-3">
                    <div class="form-group">
                        <label class="custom_label form-label "> {{__('messages.notification_key')}}</label>
                        <input class="form-control custom_input @error('notification_key') is-invalid @enderror" type="text" 
                        name="notification_key"
                        placeholder="{{__('messages.notification_key')}}"
                        value="{{$pharmacy->pharmacy_attachment->notification_key ?? ''}}" >
                        @error('notification_key') <span class="invalid-feedback">
                          {{ $message }}</span> @enderror
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 col-12 mt-3">
                    <div class="form-group">
                        <label class="custom_label form-label "> {{__('messages.color')}}</label>
                        <input class="form-control custom_input @error('color') is-invalid @enderror" type="color"
                        name="color"
                        placeholder="{{__('messages.color')}}"
                        value="{{$pharmacy->pharmacy_attachment->color ?? ''}}" required >
                        @error('color') <span class="invalid-feedback">
                          {{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-3 col-12 mt-3">
                    <div class="form-group">
                        <label class="custom_label form-label "> {{__('messages.android_version')}}</label>
                        <input class="form-control custom_input @error('android_version') is-invalid @enderror" type="text" 
                        name="android_version"
                        placeholder="{{__('messages.android_version')}}"
                        value="{{$pharmacy->pharmacy_attachment->android_version ?? ''}}"  >
                        @error('android_version') <span class="invalid-feedback">
                          {{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-3 col-12 mt-3">
                  <div class="form-group">
                      <label class="custom_label form-label "> {{__('messages.ios_version')}}</label>
                      <input class="form-control custom_input @error('ios_version') is-invalid @enderror" type="text"
                      name="ios_version"
                      placeholder="{{__('messages.ios_version')}}"
                      value="{{$pharmacy->pharmacy_attachment->ios_version ?? ''}}"  >
                      @error('ios_version') <span class="invalid-feedback">
                        {{ $message }}</span> @enderror
                  </div>
              </div>

              <div class="col-md-3 col-12 mt-3">
                <div class="form-group">
                    <label class="custom_label form-label "> {{__('messages.huawei_version')}}</label>
                    <input class="form-control custom_input @error('huawei_version') is-invalid @enderror"  type="text" 
                     name="huawei_version" value="{{$pharmacy->pharmacy_attachment->huawei_version ?? ''}}"
                    placeholder="{{__('messages.huawei_version')}}"
                    >
                   @error('huawei_version') <span class="invalid-feedback">
                    {{ $message }}</span> @enderror
                </div>
            </div>
              </div>
              <div class="row mt-4">
                <div class="col-md-12 col-12 mt-3">
                    <div class="form-group">
                        <label class="custom_label form-label "> {{__('messages.android_link')}}</label>
                        <input class="form-control custom_input @error('android_link') is-invalid @enderror" type="text" 
                        name="android_link"
                        placeholder="{{__('messages.android_link')}}"
                        value="{{$pharmacy->pharmacy_attachment->android_link ?? ''}}"  >
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
                      value="{{$pharmacy->pharmacy_attachment->ios_link ?? ''}}"  >
                      @error('ios_link') <span class="invalid-feedback">
                        {{ $message }}</span> @enderror
                  </div>
                </div>
                
                <div class="col-md-12 col-12 mt-3">
                <div class="form-group">
                    <label class="custom_label form-label "> {{__('messages.huawei_link')}}</label>
                    <input class="form-control custom_input @error('huawei_link') is-invalid @enderror"  type="text" 
                     name="huawei_link" value="{{$pharmacy->pharmacy_attachment->huawei_link ?? ''}}"
                    placeholder="{{__('messages.huawei_link')}}"
                    >
                   @error('huawei_link') <span class="invalid-feedback">
                    {{ $message }}</span> @enderror
                </div>
                </div>
              </div>
              <div class="row mb-4">
            <div class="col-md-4 col-12 mt-4">
                <div class="form-group mt-4">
                <div class="form-check form-switch">
                    <label class="form-label custom_label">
                    <input class="form-check-input table_check" name="android_accepted" value="1"
                        type="checkbox" @checked($pharmacy->pharmacy_attachment->android_accepted == 1) >
                        {{__('messages.android_accepted')}}</label>
                </div>
            </div>
            </div>
            <div class="col-md-4 col-12 mt-4">
                <div class="form-group mt-4">
                <div class="form-check form-switch">
                    <label class="form-label custom_label">
                    <input class="form-check-input table_check" name="ios_accepted" value="1"
                        type="checkbox"  @checked($pharmacy->pharmacy_attachment->ios_accepted == 1) >
                        {{__('messages.ios_accepted')}}</label>
                </div>
            </div>
        </div>
            <div class="col-md-4 col-12 mt-4">
                <div class="form-group mt-4">
                <div class="form-check form-switch">
                    <label class="form-label custom_label">
                    <input class="form-check-input table_check" name="huawei_accepted" value="1"
                        type="checkbox"  @checked($pharmacy->pharmacy_attachment->huawei_accepted == 1)>
                        {{__('messages.huawei_accepted')}}</label>
                </div>
            </div> </div>
           

            <div class="col-md-4 col-12 mt-4">
                <div class="form-group mt-4">
                <div class="form-check form-switch">
                    <label class="form-label custom_label">
                    <input class="form-check-input table_check" name="new_ios_status" value="1"
                    @checked($pharmacy->pharmacy_attachment->new_ios_status == 1)
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
                    @checked($pharmacy->pharmacy_attachment->old_ios_status == 1)
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
                    @checked($pharmacy->pharmacy_attachment->new_android_status == 1)
                        type="checkbox" >
                        {{__('messages.new_android_status')}}</label>
                </div>
            </div> </div>

            <div class="col-md-4 col-12 mt-4">
                <div class="form-group mt-4">
                <div class="form-check form-switch">
                    <label class="form-label custom_label">
                    <input class="form-check-input table_check" name="old_android_status" value="1"
                    @checked($pharmacy->pharmacy_attachment->old_android_status == 1)
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
                    @checked($pharmacy->pharmacy_attachment->new_huawei_status == 1)
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
                    @checked($pharmacy->pharmacy_attachment->old_huawei_status == 1)
                        type="checkbox" >
                        {{__('messages.old_huawei_status')}}</label>
                </div>
            </div> </div>

              </div>
           
            
              <div class="row" style="margin-top:5rem; ">
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

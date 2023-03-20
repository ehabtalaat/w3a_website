@extends('Admin::layouts.index')
@section('content')
<section class="content_section">
  <div class="row">
      <div class="content_text">
          <h4 class="main_header_text">
             {{__('messages.edit admin')}}
          </h4>

      </div>

  </div>

  <div class="card_content">

    <form method="post" action="{{route('admins.update',$admin->id)}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">

          <div class="col-lg-3 col-md-3 col-12">

              <img src="{{asset($admin->image)}}"
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

          </div>

          <div class="col-lg-7 col-md-8 col-12 mt-4">

              <div class="row">
                  <div class="col-12 mt-3">
                      <div class="form-group">
                          <label class="custom_label form-label "> {{__('messages.name')}}</label>
                          <input class="form-control custom_input @error('name') is-invalid @enderror" type="text" 
                          name="name"
                          placeholder="{{__('messages.name')}}"
                          value="{{ $admin->name}}" required >
                          @error('name') <span class="invalid-feedback">
                            {{ $message }}</span> @enderror
                      </div>
                  </div>

                  <div class="col-12 mt-3">
                    <div class="form-group">
                        <label class="custom_label form-label "> {{__('messages.phone')}}</label>
                        <input class="form-control custom_input @error('phone') is-invalid @enderror" type="number"
                        name="phone"
                        placeholder="{{__('messages.phone')}}"
                        value="{{ $admin->phone}}" required >
                        @error('phone') <span class="invalid-feedback">
                          {{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-12 mt-3">
                  <div class="form-group">
                      <label class="custom_label form-label "> {{__('messages.password')}}</label>
                      <input class="form-control custom_input @error('password') is-invalid @enderror"  type="password" 
                       name="password"
                      placeholder="{{__('messages.password')}}"
                      >
                     @error('password') <span class="invalid-feedback">
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

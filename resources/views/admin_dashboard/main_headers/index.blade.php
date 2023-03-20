@extends('layouts.admin_index')
@section('content')
<section class="content_section">
  <div class="row">
      <div class="content_text">
          <h4 class="main_header_text">
             {{__('messages.edit main_header')}}
          </h4>

      </div>

  </div>

  <div class="card_content">

    <form method="post" action="{{route('main_headers.update',$main_header->id)}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">

          <div class="col-lg-3 col-md-3 col-12">

              <img src="{{$main_header->image->image_link ?? ''}}"
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

          <div class="col-lg-9 col-md-9 col-12 mt-4">

              <div class="row">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <div class="col-md-6 col-12">
                    <div class="form-group">

                        <label class="custom_label form-label ">  {{ __('messages.title_'.$localeCode) }}
                            <span class="text-danger"> ( {{ $localeCode }} )</span></label>
                        <input class="form-control custom_input @error('title-' . $localeCode) is-invalid 
                        @enderror" type="text" name="title-{{$localeCode}}" required value="{{ $main_header->translate($localeCode)->title ?? ''}}"
                            placeholder="{{ __('messages.title_'.$localeCode) }}">
                            @error('title-' . $localeCode) <span class="invalid-feedback">
                                {{ $message }}</span> @enderror
                    </div>
                </div>

                @endforeach


              </div>

              <div class="row mt-4">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <div class="col-md-6 col-12">
                    <div class="form-group">

                        <label class="custom_label form-label ">  {{ __('messages.text_'.$localeCode) }}
                            <span class="text-danger"> ( {{ $localeCode }} )</span></label>
                  
                            <textarea class="form-control  custom_input @error('text-' . $localeCode) is-invalid 
                            @enderror" required name="text-{{ $localeCode }}" rows="8">{{$main_header->translate($localeCode)->text ?? ''}}</textarea>
                            @error('text-' . $localeCode) <span class="invalid-feedback">
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
@endsection

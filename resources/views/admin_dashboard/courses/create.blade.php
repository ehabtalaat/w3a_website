@extends('layouts.admin_index')
@section('content')
<div class="container">
    <div class="card card-custom gutter-b">


        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">


                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                        <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo8/dist/../src/media/svg/icons/Files/File-plus.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>


                </span>

                <h3 class="card-label"> {{__('messages.add course')}}</h3>
            </div>
        </div>


        <div class="card-body">
            <form method="post" action="{{route('courses.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6 mx-auto">
                        <div class="uploadOuter">
                            <span class="dragBox" >
                            
                              Darg and Drop image here
                            <input type="file" name="image" onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()"  />
                            </span>
                            </div>
                            
                            <div class="preview">
                            @error('image') <span class="invalid-feedback">
                            {{ $message }}</span> @enderror
                            </div>
                              </div>
                    <div class="col-md-6 col-12 mx-auto text-center mb-5 set-img mx-auto">
                        <video width="200" height="200" controls>
                            <source src="" id="video_here">
                            Your browser does not support HTML5 video.
                        </video>
                        <br>
                        <br>
                        <input id="kt" type="file" class="form-control ehabtalaat file_upload" name="video">
                        <label for="kt" class="custom_file_upload"> {{__('messages.add video')}}</label>
                        @error('video')
                        <p style="color:red;">{{$message}}</p>
                        @enderror
                    </div>
                

                </div>

             



                <div class="row">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <!-- For loop this div -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>
                                {{ __('messages.title_'.$localeCode) }}
                                <span class="text-danger"> ( {{ $localeCode }} )</span>
                            </label>
                            <input class="form-control   @error('title-' . $localeCode) is-invalid
      @enderror" required value="{{ old('title-' . $localeCode)}}" name="title-{{ $localeCode }}">

                            @error('title-' . $localeCode) <span class="invalid-feedback">
                                {{ $message }}</span> @enderror
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                        <label>{{__('messages.price')}}</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" 
                        name="price" min="0"
                        value="{{ old('price')}}" required/>
                         @error('price') <span class="invalid-feedback">
                             {{ $message }}</span> @enderror
                                   
                   </div>
                    </div>
                </div>
                <div class="row">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <!-- For loop this div -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label>
                                {{ __('messages.features_'.$localeCode) }}
                                <span class="text-danger"> ( {{ $localeCode }} )</span>
                            </label>
                            <textarea class="form-control summernote  @error('features-' . $localeCode) is-invalid
                          @enderror" required name="features-{{ $localeCode }}" rows="6"></textarea>
                            @error('features-' . $localeCode) <span class="invalid-feedback">
                                {{ $message }}</span> @enderror
                        </div>
                    </div>
                    @endforeach
                </div>
                <br />
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow=""
                      aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        0%
                      </div>
                    </div>
                    <br />
                    <div id="success">

                    </div>
                    <br />
                <button type="submit"  class="btn btn-shadow btn-primary font-weight-bold mt-5">
                    {{__('messages.save')}}
                    <span class="svg-icon svg-icon m-0 svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"></path>
                                <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>



                </button>
            </form>

            <!--end::Form-->
            @endsection
            @section("scripts")
            <script>
                $('form').ajaxForm({
        method: 'POST',
      beforeSend:function(){
        $('#success').empty();
        $('.new').attr("disabled", true);
      },
      uploadProgress:function(event, position, total, percentComplete)
      {
        $('.progress-bar').text(percentComplete + '%');
        $('.progress-bar').css('width', percentComplete + '%');
      },
      success:function(data)
      {
      
        if(data.status == false)
        {
          $('.progress-bar').text('0%');
          $('.progress-bar').css('width', '0%');
          $('#success').html('<span class="text-danger"><b>'+data.message+'</b></span>');
                 $('.new').attr("disabled", false);
        }
      else{
        
          $('.progress-bar').text('Uploaded');
          $('.progress-bar').css('width', '100%');
          $('#success').html('<span class="text-success"><b>'+data.message+'</b></span><br /><br />');
          $('#success').append(data.image);
          location.href =`../courses`;
        }
      }
    });
            </script>
            @endsection

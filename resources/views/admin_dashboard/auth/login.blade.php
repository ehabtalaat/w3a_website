<!DOCTYPE html>
<html lang="ar">

<head>
    <!-- ? Required meta tags -->
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- ? Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!--  CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/css/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/aos.min.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!--  CSS -->
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> --}}
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"> --}}
    <!--  JS -->
    <script src="{{asset('assets/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/all.min.js')}}"></script>
    <script src="{{asset('fontawesome.min.js')}}"></script>

    <script src="{{asset('assets/js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/aos.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    <script src="{{asset('assets/js/bootstrap-select.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>

    <!-- JS -->

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--  title -->
    <title>Tebbi</title>
    <!-- title -->

    <!-- ? Favicon -->
    <link rel="icon" href="{{asset('assets/media/images/logo.png')}}" type="image" />
    <!-- ? Favicon -->


</head>

<body>
    <main>

        <div class="row">
       
            <!--content ---> 
            <div class="col-lg-7 col-md-9  col-12 mx-auto mt-4">
                <div class="container">
              

                    <!--content-->

                    <section class="content_section">
                       
                        <div class="card_content">
                           
                            <div class="row">
                                <div class="login_text">
                                    <img src="{{asset('assets/media/images/logo.png')}}">
                                    <h3>{{__('messages.login')}} </h3>
                                    <p>{{__('messages.ee')}}</p>
                                </div>
                               
								<form class="form" id="kt_login_signin_form" method="post" 
								action="{{route('admin_login')}}">
									@csrf
                                <div class="col-12">

                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="form-group custom_form_group">
                                                <i class="fas fa-phone"></i>
                                                <label class="custom_label form-label ">  {{__('messages.phone')}}</label>
                                                <input class="form-control custom_input" type="number" name="phone"  placeholder="{{__('messages.phone')}} ">
											
											</div>
											@error('phone') <span class="invalid-feedback">
												{{ $message }}</span> @enderror
                                        </div>

                                        <div class="col-12 mt-4">
                                            <div class="form-group custom_form_group">
                                                <i class="fas fa-lock"></i>
                                                <label class="custom_label form-label "> {{__('messages.password')}}  </label>
                                                <input class="form-control custom_input" type="password" name="password"  placeholder=" {{__('messages.password')}} ">
												
											</div>
											@error('password') <span class="invalid-feedback">
												{{ $message }}</span> @enderror
												@if(session('error'))
											<p class="text-danger">{{ session('error')  }}</p>
											@endif
                                        </div>

                                    </div>
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button class="btn save_btn" type="submit">{{__('messages.login')}}</button>
                                    </div>

                                  
                                </div>
                                </div>
								</form>
                            </div>


                        </div>
                    </section>
                    <!--content-->
                </div>
            </div>
            <!--content-->
        </div>
    </main>
</body>
@if(session('error'))
		<script>
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: "{{session('error')}}",
		})
		</script>
		@endif
		@if(session('success'))
		<script>
		Swal.fire({
			position: 'top-end',
			icon: 'success',
			title: "{{session('success')}}",
			showConfirmButton: false,
			timer: 1500
		})
		</script>
		@endif
</html>

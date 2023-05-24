<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
	<!--begin::Menu Container-->
	<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
		<!--begin::Menu Nav-->
		<ul class="menu-nav">
	
			
			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="javascript:;" class="menu-link menu-toggle">
					<span class="svg-icon menu-icon">
						<i class="fas fa-user-lock"></i>
					</span>
					<span class="menu-text">{{__('messages.admins')}}</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="menu-submenu">
					<i class="menu-arrow"></i>
					<ul class="menu-subnav">
						<li class="menu-item menu-item-parent" aria-haspopup="true">
							<span class="menu-link">
								<span class="menu-text">{{__('messages.admins')}}</span>
							</span>
						 </li>
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('admins.index')}}" class="menu-link">
								<span class="menu-text">{{__('messages.all')}}</span>
							</a>
						</li>
					</ul>
				</div>
			</li>

			<li class="menu-section">
				<h4 class="menu-text">{{__('messages.settings')}}</h4>
				<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
			</li>
 
			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="javascript:;" class="menu-link menu-toggle">
					<span class="svg-icon menu-icon">
						<i class="fas fa-cog"></i>
					</span>
					<span class="menu-text">{{__('messages.settings')}}</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="menu-submenu">
					<i class="menu-arrow"></i>
					<ul class="menu-subnav">
						<li class="menu-item menu-item-parent" aria-haspopup="true">
							<span class="menu-link">
								<span class="menu-text">{{__('messages.settings')}}</span>
							</span>
						</li>
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('tags.index')}}" class="menu-link">
								<span class="menu-text">{{__('messages.tags')}}</span>
							</a>
						</li>
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('book_types.index')}}" class="menu-link">
								<span class="menu-text">{{__('messages.book_types')}}</span>
							</a>
						</li>
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('payment_methods.index')}}" class="menu-link">
				 				<span class="menu-text">{{__('messages.payment_methods')}}</span>
							</a> 
						</li>
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('website_reasons.index')}}" class="menu-link" >
								<span class="menu-text">{{__('messages.website_reasons')}}</span>
							</a>
						</li>
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('roles.index')}}" class="menu-link">
				 				<span class="menu-text">{{__('messages.roles')}}</span>
							</a> 
						</li>
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('website_texts.index')}}" class="menu-link">
				 				<span class="menu-text">{{__('messages.website_texts')}}</span>
							</a> 
						</li>

					</ul>
				</div>
			</li>

			<li class="menu-section">
				<h4 class="menu-text">{{__('messages.website_settings')}}</h4>
				<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
			</li>
 
			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="javascript:;" class="menu-link menu-toggle">
					<span class="svg-icon menu-icon">
					<i class="fas fa-cogs"></i>
					</span>
					<span class="menu-text">{{__('messages.website_settings')}}</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="menu-submenu">
					<i class="menu-arrow"></i>
					<ul class="menu-subnav">
						<li class="menu-item menu-item-parent" aria-haspopup="true">
							<span class="menu-link">
								<span class="menu-text">{{__('messages.website_settings')}}</span>
							</span>
						</li>
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('main_headers.index')}}" class="menu-link">
								<span class="menu-text">{{__('messages.main_headers')}}</span>
							</a>
						</li>
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('about_doctors.index')}}" class="menu-link">
								<span class="menu-text">{{__('messages.about_doctors')}}</span>
							</a>
						</li>
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('about_headers.index')}}" class="menu-link">
								<span class="menu-text">{{__('messages.about_headers')}}</span>
							</a> 
						</li>
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('special_advices.index')}}" class="menu-link" >
								<span class="menu-text">{{__('messages.special_advices')}}</span>
							</a>
						</li>
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('store_headers.index')}}" class="menu-link">
								<span class="menu-text">{{__('messages.store_headers')}}</span>
							</a> 
						</li>
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('certificates.index')}}" class="menu-link">
								<span class="menu-text">{{__('messages.certificates')}}</span>
							</a> 
						</li>

						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('experiences.index')}}" class="menu-link" >
								<span class="menu-text">{{__('messages.experiences')}}</span>
							</a>
						</li>


						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('center_consultings.index')}}" class="menu-link" >
								<span class="menu-text">{{__('messages.center_consultings')}}</span> 
							</a>
						</li>

						
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('about_podcasts.index')}}" class="menu-link" >
								<span class="menu-text">{{__('messages.about_podcasts')}}</span> 
							</a>
						</li>

						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('features.index')}}" class="menu-link" >
								<span class="menu-text">{{__('messages.features')}}</span> 
							</a>
						</li>

						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('blogs.index')}}" class="menu-link" >
								<span class="menu-text">{{__('messages.blogs')}}</span> 
							</a>
						</li>

					</ul>
				</div>
			</li>

				
			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="javascript:;" class="menu-link menu-toggle">
					<span class="svg-icon menu-icon">
						<i class="fas fa-user-md"></i>
					</span>
					<span class="menu-text">{{__('messages.doctors')}}</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="menu-submenu">
					<i class="menu-arrow"></i>
					<ul class="menu-subnav">
						<li class="menu-item menu-item-parent" aria-haspopup="true">
							<span class="menu-link">
								<span class="menu-text">{{__('messages.doctors')}}</span>
							</span>
						 </li>
						 <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('consultations.index')}}" class="menu-link">
								<span class="menu-text">{{__('messages.consultations')}}</span>
							</a>
						</li>
						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('doctors.index')}}" class="menu-link">
								<span class="menu-text">{{__('messages.doctors')}}</span>
							</a>
						</li>
					</ul>
				</div>
			</li>


			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="javascript:;" class="menu-link menu-toggle">
					<span class="svg-icon menu-icon">
						<i class="fab fa-discourse"></i>
					</span>
					<span class="menu-text">{{__('messages.website_courses')}}</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="menu-submenu">
					<i class="menu-arrow"></i>
					<ul class="menu-subnav">
						<li class="menu-item menu-item-parent" aria-haspopup="true">
							<span class="menu-link">
								<span class="menu-text">{{__('messages.website_courses')}}</span>
							</span>
						 </li>
						 <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('courses.index')}}" class="menu-link">
								<span class="menu-text">{{__('messages.courses')}}</span>
							</a>
						</li>

						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('podcasts.index')}}" class="menu-link">
								<span class="menu-text">{{__('messages.podcasts')}}</span>
							</a>
						</li>

						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('books.index')}}" class="menu-link">
								<span class="menu-text">{{__('messages.books')}}</span>
							</a>
						</li>
					</ul>
				</div>
			</li>


			<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
				<a href="javascript:;" class="menu-link menu-toggle">
					<span class="svg-icon menu-icon">
						<i class="fas fa-procedures"></i>
										</span>
					<span class="menu-text">{{__('messages.reservations')}}</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="menu-submenu">
					<i class="menu-arrow"></i>
					<ul class="menu-subnav">
						<li class="menu-item menu-item-parent" aria-haspopup="true">
							<span class="menu-link">
								<span class="menu-text">{{__('messages.reservations')}}</span>
							</span>
						 </li>
						 <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('reservations.index')}}" class="menu-link">
								<span class="menu-text">{{__('messages.reservations')}}</span>
							</a>
						</li>

						
					
					</ul>
				</div>
			</li>
			<li class="menu-item" aria-haspopup="true">
				<a href="{{route('logout')}}" class="menu-link">
					<span class="svg-icon menu-icon">
						<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-28-020759/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Sign-out.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<path d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) " />
								<rect fill="#000000" opacity="0.3" transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) " x="13" y="6" width="2" height="12" rx="1" />
								<path d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) " />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
					<span class="menu-text"> {{__("messages.logout")}}</span>
				</a>
			</li>
			
		</ul>
		<!--end::Menu Nav-->
	</div>
	<!--end::Menu Container-->
</div>
<!--end::Aside Menu-->
</div>
<!--end::Aside-->
<!--begin::Wrapper-->
<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

	<!--begin::Header-->
	<div id="kt_header" class="header header-fixed">
		<!--begin::Container-->
		<div class="container-fluid d-flex align-items-stretch justify-content-between">
			<!--begin::Header Menu Wrapper-->
			<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
				<!--begin::Header Menu-->
				<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
					<!--begin::Header Nav-->
					<ul class="menu-nav">

					
					</ul>
					<!--end::Header Nav-->
				</div>
				<!--end::Header Menu-->
			</div>
			<!--end::Header Menu Wrapper-->
		
				




				@include("layouts.admin_includes.topbar")

		</div>
		<!--end::Container-->
	</div>
	<!--end::Header-->

	<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		@yield("content")
	</div>
	<!--end::Content-->

	<script>
		var url = window.location;
		// for treeview
		$('ul.menu-subnav .menu-item a').filter(function() {
			return this.href == url;
		}).parentsUntil(".menu-parent-menu > .menu-item a").addClass('active menu-item-open');
	</script>
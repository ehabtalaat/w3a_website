<!--begin::Aside Menu-->
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
	<!--begin::Menu Container-->
	<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
		<!--begin::Menu Nav-->
		<ul class="menu-nav">
	
			

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
							<a href="{{route('experiences.index')}}" class="menu-link" >
								<span class="menu-text">{{__('messages.experiences')}}</span>
							</a>
						</li>


						<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
							<a href="{{route('center_consultings.index')}}" class="menu-link" >
								<span class="menu-text">{{__('messages.center_consultings')}}</span>
							</a>
						</li>
					</ul>
				</div>
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
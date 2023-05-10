@extends('layouts.admin_index')
 @section('content') 
	<!--begin::Card-->
    <div class="container">
    <div class="card card-custom gutter-b">
    
        <div class="card-header flex-wrap py-3">
										<div class="card-title">
											<h3 class="card-label">{{__('messages.doctor_certificates')}}
</h3>
										</div>
										<div class="card-toolbar">
										@if(count($doctor->certificates) == 0)

									
                                            <a href="{{route('doctor_certificates.create',$doctor->id)}}" class="btn btn-light-success font-weight-bold">
                               <i class="ki ki-plus icon-md mr-2"></i>{{__('messages.add')}}</a>
                               @endif
											<!--end::Button-->
										</div>
									</div>
        <div class="card-body">
            <!--begin: Datatable-->
          
    {!! $dataTable->table([
                    
                     ],true) !!}
            <!--end: Datatable-->
        
       
    <!--end::Card-->
@endsection
@section('scripts')   
{{$dataTable->scripts()}} 

 @endsection 
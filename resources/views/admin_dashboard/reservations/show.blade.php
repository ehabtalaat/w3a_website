@extends('layouts.admin_index')
 @section('content') 
<div class="container">
    <!-- begin::Card-->
    <div class="card card-custom overflow-hidden invoice_table" id="invoice">
        <div class="card-body p-0">
            <!-- begin: Invoice-->
            <!-- begin: Invoice header-->
            <div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0 invoice_back">
                <div class="col-md-9">
                    <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                        <h1 class="display-4 text-white font-weight-boldest mb-10 title_wizard"> {{__("messages.reservation_details")}}</h1>
                        <div class="d-flex flex-column align-items-md-end px-0">
                         
                        </div>
                    </div>
                    <div class="border-bottom w-100 opacity-20"></div>
                    <div class="d-flex justify-content-between text-white pt-6">
                    <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolde mb-2r title_wizard">{{__('messages.name')}}</span>
                            <span
                                class="opacity-70 text-wizard">{{ $reservation->user_name }}</span>
                        </div>
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolde mb-2r title_wizard"> {{__('messages.phone')}}</span>
                            <span
                                class="opacity-70 text-wizard">{{ $reservation->user_phone }}</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between text-white pt-6">

                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolde mb-2r title_wizard">{{__('messages.reservation_date')}}</span>
                            <span
                                class="opacity-70 text-wizard">{{ $reservation->created_at_format ?? "" }}</span>
                        </div>
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolde mb-2r title_wizard">{{__('messages.price')}}</span>
                            <span
                                class="opacity-70 text-wizard">{{ $reservation->price }}</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between text-white pt-6">

                           <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolde mb-2r title_wizard">{{__('messages.from_time')}} </span>
                            <span
                                class="opacity-70 text-wizard">{{ $reservation->from_time_format ?? "" }}</span>
                        </div>   <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolde mb-2r title_wizard"> {{__('messages.to_time')}} </span>
                            <span
                                class="opacity-70 text-wizard">{{ $reservation->to_time_format }}</span>
                        </div>
                        
                    </div>
                    <div class="d-flex justify-content-between text-white pt-6">

                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolde mb-2r title_wizard">{{__('messages.patient_notes')}}</span>
                            <span
                                class="opacity-70 text-wizard">{{ $reservation->patient_notes ?? "" }}</span>
                        </div>
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2 title_wizard"> {{__('messages.payment_method')}}</span>
                            <span class="opacity-70 text-wizard">{{ $reservation->payment_method->title ?? "" }}</span>
                        </div>
</div>
                        <div class="d-flex justify-content-between text-white pt-6">
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolde mb-2r title_wizard">  {{__('messages.doctor_name')}}</span>
                            <span
                                class="opacity-70 text-wizard">{{ $reservation->doctor->name ?? "" }}</span>
                        </div>
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolde mb-2r title_wizard">  {{__("messages.contact_type")}}</span>
                            <span
                                class="opacity-70 text-wizard">{{ $reservation->contact_type_title ?? "" }}</span>
                        </div>
                       
</div>
                    </div>
                </div>
            </div>
            <!-- end: Invoice header-->
            <!-- begin: Invoice body-->
            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                <label>{{__("messages.patient_images")}}</label>

                    @foreach ($reservation->images as $image)
                                                
                                            
                    <div class="col-xl-4 col-lg-4 col-md-6 col-12 d-flex align-items-center" id="image_container{{$image->id}}">
                        <figure class="imghvr-fade product_figure">
                        <img style="width:100px;height:100px;"src='{{$image->image_link ?? "" }}' >
                        </figure>
                     
                    </div>
        
                        @endforeach
                
            </div>
            <!-- end: Invoice body-->
     
        </div>
    </div>
    <!-- end::Card-->
</div>
@endsection

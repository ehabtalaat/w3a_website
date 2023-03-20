@extends('Admin::layouts.index')
 @section('content') 
 <section class="content_section">
    <div class="row">
        <div class="content_text">
            <h4 class="main_header_text">
                {{__('messages.payment_methods')}}
            </h4>

        </div>
        <div class="toolbar-btns">
            <a href="{{route('payment_methods.create')}}" class="create_btn">{{__('messages.add payment_method')}} </a>
        </div>
    </div>

    <div class="card_content">
        <div class="row">
        {!! $dataTable->table([
                    
            ],true) !!}
        </div>
    </div>
</section>
   
       
@endsection
@section('scripts')  

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
{{$dataTable->scripts()}} 

 @endsection 
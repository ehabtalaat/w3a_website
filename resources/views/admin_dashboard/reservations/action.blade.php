<?php 
$reservation = \App\Models\Reservation\Reservation::whereId($id)->first();
?>
<style>
.modal-dialog{
    width:100%;
}.modal-dialog img{
    width:500px;
    height:500px;
}
</style>

@if($reservation->type == 2)
<span style="cursor:pointer;" class="label label-lg font-weight-bold label-light-success label-inline span" data-toggle="modal" data-target="#exampleModal{{$reservation->id}}">صوره الوصل</span>
<div class="modal fade" id="exampleModal{{$reservation->id}}" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Modal heading -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                      صوره الوصل
                    </h5>
                    <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                </div>
                <!-- Modal body with image -->
                <div class="modal-body">
                    @if($reservation->receipt_image)
                  <img src="{{asset($reservation->receipt_image)}}" style="max-width:100%">
                  @else
                  <p>لم ترسل الصوره بعد</p>
                  @endif
                </div>
            </div>
        </div>
    </div>
@endif


<a href="{{route('reservations.show',$reservation->id)}}">
    <i class="fas fa-eye icon_action"></i></a>

@if($reservation->status == 3)
<span  class="text-success">
    {{__('messages.canceled')}}
  </span>
@elseif($reservation->status == 0)
<button 
onclick="change_reservation_status({{$id}},3)" class="btn btn-danger">
  {{__('messages.cancel')}}
</button>
<button 
onclick="change_reservation_status({{$id}},1)" class="btn btn-success">
  {{__('messages.accept')}}
</button>

@elseif($reservation->status == 1)
<button 
onclick="change_reservation_status({{$id}},2)" class="btn btn-success">
{{__('messages.wait_detection')}}
</button>
@elseif($reservation->status == 2)
<span  class="text-success">
    {{__('messages.done_detection')}}
  </span>
  <a href="{{route('reservations.result',$id)}}"  class="btn btn-success">{{__("messages.reservation_result")}}</a>
@endif
<script>
    function change_reservation_status(id,status) {

        var table = $('.dataTable').DataTable();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



                $.ajax({
                    type: 'POST',
                    data: {
                       "id" :id,
                       "status" :status,
                    },
                    url: `{{route("reservations.change_status")}}`,
                    dataType: "Json",
                    success: function(result) {
                        if (result.status == true) {
                            Swal.fire({
                    position: 'center',
                        icon: 'success',
                        title:result.message,
                        showConfirmButton: false,
                        timer: 1500
                        })
                            table.ajax.reload();
                        }
                    }
                });
            }
      
</script>
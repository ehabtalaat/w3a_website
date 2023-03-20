
<a href="{{route('admins.edit',$id)}}" class="edit_icon btn">
                                
    <i class="fas fa-edit"></i>
                                
                            </a>
                         @if(auth()->id() != $id)
                            <span style="cursor:pointer;" onclick="deleteadmins({{$id}})" class="btn delete_icon mr-1">
                                <i class="fas fa-trash-alt"></i>
                            </span>
                            @endif
                           
                            <script>
              function deleteadmins(id){

 var table = $('.dataTable').DataTable();
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

   Swal.fire({
  title: "{{__('messages.areyousure')}}",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
        cancelButtonText: "{{__('messages.cancel')}}",
  confirmButtonText: "{{__('messages.yessure')}}",
}).then((result) => {
  if (result.isConfirmed) {

   
    $.ajax({
        type:'POST',
         data:{
        '_method': 'DELETE',
        '_token':$('meta[name="csrf-token"]').attr('content')
      },
       url: `admins/${id}`,
       dataType: "Json",
       success: function(result){
           if(result.status == true){
        Swal.fire(
   "{{__('messages.deleted')}}",
      "{{__('messages.donedelete')}}",
      'success'
         )
       table.ajax.reload();
           }
         }
    });
    }
  })
}</script>
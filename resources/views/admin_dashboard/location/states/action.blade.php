


<a href="{{route('states.edit',$id)}}" class="edit_icon btn">
                                
    <i class="fas fa-edit"></i>
                                
                            </a>
                                
                          
                     
                            <span style="cursor:pointer;" onclick="deletestates({{$id}})" class="btn delete_icon mr-1">
                                <i class="fas fa-trash-alt"></i>
                            </span>
                        
                           
                            <script>
              function deletestates(id){

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
       url: `states/${id}`,
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
}



function active_state(id){

var table = $('.dataTable').DataTable();
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$.ajax({
type:'post',
data:{
"id":id
},
url: `active_state`,
//    contentType: "application/json; charset=utf-8",
dataType: "Json",
success: function(result){
if(result.status == true){
//table.ajax.reload();
}
}
});
}

</script>
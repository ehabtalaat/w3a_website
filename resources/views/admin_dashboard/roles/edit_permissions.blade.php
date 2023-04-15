
<style>

    .nav-link.active span{
    color: #3699ff !important;
    }
    input[type='checkbox'] { 
        opacity: 1;
        z-index: 1;
     }
    .nav-tabs{
        margin-right: 0;
        margin-bottom: 2rem;
    }
        </style>
       @php
       $models = [
          'admins',
      'doctors',
      'blogs',
      'features',
      'tags',
      'book_types',
      'website_reasons',
      'payment_methods',
      'experiences',
      'consultations',
      'courses',
      'lessons',
      'podcasts',
      'roles',
      'books',
      "main_headers",
      "about_doctors",
      "about_podcasts",
      "about_headers",
      "special_advices",
      "store_headers",
      "center_consultings",
  ];
  $models1 = [ "main_headers",
      "about_doctors",
      "about_podcasts",
      "about_headers",
      "special_advices",
      "store_headers",
      "center_consultings",];
      $maps = ['create', 'read', 'update', 'delete'];
      $maps1 = ['update'];
  @endphp
         <div class="col-12 mt-4">
            <div class="mb-3">
                <label><input type="checkbox" class="formcotrol ml-3 mr-3" id="checkAll"> {{__('messages.all permissions')}}</label>
            </div>
          </div>
            <label class="mb-3">{{__('messages.permissions')}}</label>
            <ul class="nav nav-tabs">
                @foreach($models as $index=>$model)
                <li class="nav-item">
                    <a href="#{{$model}}" data-toggle="tab" aria-expanded="false" class="nav-link {{$index == 0 ? 'active' : ''}}">
                        <span class="d-block">{{__('messages.'.$model)}}</span>
                    </a>
                </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach($models as $index=>$model)
    
                <div role="tabpanel" class="tab-pane fade show {{$index == 0 ? 'active' : ''}}" id="{{$model}}">
                    @if(in_array($model,$models1))
                    @foreach($maps1 as $key1 => $map)
                    <div class="checkbox checkbox-success form-check-inline">
                        <input type="checkbox" name="permissions[]" id="inlineCheckbox55555555{{$key1}}" 
                        @checked($role->hasPermission($model .'-'.$map))
                        value="{{$model}}-{{$map}}">
                        <label for="inlineCheckbox55555555{{$key1}}" style="margin-right: 30px;"> {{__('messages.'.$map)}}</label>
                    </div>
                 @endforeach
                   
                    @else
                    @foreach($maps as $key => $map)
                        <div class="checkbox checkbox-success form-check-inline">
                            <input type="checkbox" name="permissions[]" id="inlineCheckbox{{$key}}" 
                            @checked($role->hasPermission($model .'-'.$map))
                            value="{{$model}}-{{$map}}">
                            <label for="inlineCheckbox{{$key}}" style="margin-right: 30px;"> {{__('messages.'.$map)}}</label>
                        </div>
                     @endforeach
                     @endif
                </div>
                    @endforeach
            </div>
            
            
    <script>

$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
    </script>

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
                $models = ['admins',
                        'doctors',
                          'roles',

        ];
                $maps = ['create', 'read', 'update', 'delete'];
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
                    @foreach($maps as $key => $map)
                        <div class="checkbox checkbox-success form-check-inline">
                            <input type="checkbox" name="permissions[]" id="inlineCheckbox{{$key}}" value="{{$model}}-{{$map}}" 
                            @checked($role->hasPermission($model .'-'.$map))>
                            <label for="inlineCheckbox{{$key}}" style="margin-right: 30px;"> {{__('messages.'.$map)}}</label>
                        </div>
                     @endforeach
                </div>
                    @endforeach
            </div>
            
    <script>

$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
    </script>
@extends('admin._layouts.fileupload')
@section('content')

<style>
     .middle-card{
        height:97%;
     }
</style>
<!-- Top Bar Start -->
            <div class="topbar">            
                <!-- Navbar -->
                <nav class="navbar-custom">    
                    @include('admin._partials.profile_menu')
        
                    <ul class="list-unstyled topbar-nav mb-0">                        
                        <li>
                            <button class="nav-link button-menu-mobile">
                                <i data-feather="menu" class="align-self-center topbar-icon"></i>
                            </button>
                        </li> 
                          
                    </ul>
                </nav>
                <!-- end navbar-->
            </div>
            <!-- Top Bar End -->

            <!-- Page Content-->
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="row">
                                    <div class="col">
                                        @if($obj->id)
                                            <h4 class="page-title">Edit Product</h4>
                                        @else
                                            <h4 class="page-title">Create new Product</h4>
                                        @endif
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
                                            <li class="breadcrumb-item"><a href="{{ route($route.'.index') }}">All Products</a></li>
                                            <li class="breadcrumb-item active">@if($obj->id)Edit @else Create new @endif Product</li>
                                        </ol>
                                    </div><!--end col-->
                                    @if(auth()->user()->can($permissions['create']))
                                    <div class="col-auto align-self-center">
                                        <a class=" btn btn-sm btn-primary" href="{{route($route.'.create')}}" role="button"><i class="fas fa-plus mr-2"></i>Create New</a>
                                    </div>
                                    @endif
                                </div><!--end row-->                                                              
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <!-- end page title end breadcrumb -->
                    
                    <div class="row ">
                        <div class="col-lg-12">
                            @include('admin._partials.notifications')
                                @if($obj->id)
                                        <form method="POST" action="{{ route($route.'.update') }}" class="p-t-15" id="InputFrm" data-validate=true>
                                    @else
                                        <form method="POST" action="{{ route($route.'.store') }}" class="p-t-15" id="InputFrm" data-validate=true>
                                    @endif
                                    @csrf
                                    <input type="hidden" name="id" @if($obj->id) value="{{encrypt($obj->id)}}" @endif id="inputId">
                                    <div class="row ">
                                        <div class="col-md-8">
                                            <div class="card middle-card ">
                                                <div class="card-header">
                                                    Product Details
                                                </div>
                                                <div class="card-body">
                                                    <div data-simplebar>
                                                        <div class="row m-0">
                                                            <div class="form-group col-md-6">
                                                                <label>Name</label>
                                                                <input type="text" name="name" class="form-control @if(!$obj->id) copy-name @endif" value="{{$obj->name}}" required="">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label class="">Slug (for url)</label>
                                                                <input type="text" name="slug" class="form-control" value="{{$obj->slug}}" id="slug">
                                                                <small class="text-muted">The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</small>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Heading</label>
                                                                <input type="text" name="title" class="form-control" value="{{$obj->title}}" required="">
                                                            </div>
                                                          
                                                            <div class="form-group col-md-12">
                                                                <label>Short Description</label>
                                                                <textarea name="short_description" class="form-control" rows="2" id="short_description">{{$obj->short_description}}</textarea>
                                                            </div>
                                                            
                                                            <div class="form-group col-md-12">
                                                                <label>Content</label>
                                                                <textarea name="description" class="form-control editor"  id="description">{{$obj->description}}</textarea>
                                                            </div>                                                           
                                                        </div>

                                                      
                                                    </div>                                           
                                                </div><!--end card-body-->
                                            </div><!--end card-->
                                      
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    Publish
                                                </div>
                                                <div class="card-body">
                                                    <div class="row m-0">
                                                        <div class="form-group w-100  mb-2">
                                                            <div class="custom-control custom-switch switch-primary float-left">
                                                                <input type="checkbox" class="custom-control-input" value="1" id="status" name="status" @if(!$obj->id || $obj->status == 1) checked="" @endif>
                                                                <label class="custom-control-label" for="status">Status</label>
                                                            </div>
                                                            <div class="custom-control custom-switch switch-primary float-right">
                                                                <input type="checkbox" class="custom-control-input" value="1" id="is_featured" name="is_featured" @if($obj->is_featured == 1) checked="checked" @endif>
                                                                <label class="custom-control-label" for="is_featured">Featured</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group w-100 mb-1">
                                                            <label for="name">Created On: </label>
                                                            @if(!$obj->id)
                                                                {{date('d M, Y h:i A')}}
                                                            @else
                                                                {{date('d M, Y h:i A', strtotime($obj->created_at))}}
                                                            @endif
                                                        </div>
                                                        <div class="form-group w-100  mb-1">
                                                            <label for="name">Last Updated On: </label>
                                                            @if(!$obj->id)
                                                                {{date('d M, Y h:i A')}}
                                                            @else
                                                                {{date('d M, Y h:i A', strtotime($obj->updated_at))}}
                                                            @endif
                                                        </div>
                                                        <div class="form-group w-100  mb-1">
                                                            <label for="name">Created By: </label>
                                                            @if(!$obj->id)
                                                                {{auth()->user()->name}}
                                                            @else
                                                                {{$obj->created_user->name}}
                                                            @endif
                                                        </div>
                                                        <div class="form-group w-100  mb-1">
                                                            <label for="name">Last Updated By: </label>
                                                            @if(!$obj->id)
                                                                {{auth()->user()->name}}
                                                            @else
                                                                {{$obj->updated_user->name}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer text-muted">
                                                    <button class="btn btn-sm btn-primary float-right">Save</button>
                                                </div>
                                            </div>                                           

                                            <div class="card">
                                                <div class="card-header">
                                                    Priority
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group col-md-12">
                                                        <label>Priority</label>
                                                        <input type="number" name="priority" class="form-control numeric" value="{{$obj->priority}}" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header">
                                                    Featured Image
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->featured_image, 'title'=>'Featured Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'featured_image_id'])
                                                </div>
                                            </div>


                                            <div class="card">
                                                <div class="card-header">
                                                    Banner Image
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->banner_image, 'title'=>'Banner Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'banner_image_id'])
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header">
                                                    OG Image
                                                </div>
                                                <div class="card-body">
                                                    @include('admin.media.set_file', ['file'=>$obj->og_image, 'title'=>'OG Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'og_image_id'])
                                                </div>
                                            </div>
                                          
                                        </div>    

                                       
                                    </div>
                                  </form>                                                  

                          
                        @if($obj->id)
                            @php
                                $attribute_id   = App\Models\Attribute::where('product_id',$obj->id)->pluck('id');
                                $attribute_name = App\Models\Attribute::where('product_id',$obj->id)->pluck('name');
                                $attribute_priority = App\Models\Attribute::where('product_id',$obj->id)->pluck('priority');
                            @endphp
                            
                                <div class="row">
                                    <div class="col-md-12">
                                    <form method="POST" action="{{ route('admin.attribute.create')}}" class="p-t-15" data-validate=true id="AttrtInputFrm">
                                    @csrf    
                        
                                        <div class="card">
                                            <div class="card-header">
                                                Add Attributes
                                            </div>

                                            <div class="card-body  column">                                           
                                              <input type="hidden" name="id" @if($obj->id) value="{{encrypt($obj->id)}}" @endif id="inputId">

                                              <div class=" row border "  >
                                                <div class="form-group  col-md-5">
                                                        <label>Attribute 1</label>
                                                        <input type="text" name="attributes[0][name]" class="form-control"  @if(!empty($attribute_name[0])) value="{{ $attribute_name[0] }}" @endif>
                                                        <input type="hidden" name="attributes[0][id]" @if(!empty($attribute_id[0])) value="{{ $attribute_id[0] }}" @endif class="form-control">
                                                    </div>

                                                    <div class="form-group col-md-5">
                                                        <label>Priority</label>
                                                        <input type="text" name="attributes[0][priority]" class="form-control" @if(!empty($attribute_priority[0])) value="{{ $attribute_priority[0] }}" @endif>
                                                    </div>

                                                    @if(!empty($attribute_id[1]))

                                                    @php  $value1 = App\Models\AttributeValue::where('attribute_id',$attribute_id[0])->get(); @endphp
                                                        <div class="form-group col-md-2 d-flex align-items-end">

                                                            <a href="{{ route('admin.attribute-values.index', [$attribute_id[0]]) }}" target="_blank" >
                                                                <i class="fa fa-plus" aria-hidden="true"> </i> Add values
                                                            </a>
                                                        </div>

                                                    <div >
                                                        <ul>
                                                            @foreach($value1 as $item)
                                                                <li>{{ $item->name}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    @endif
                                                </div>

                                                <div class=" row border mt-3 "  >
                                                <div class="form-group col-md-5">
                                                        <label>Attribute 2</label>
                                                        <input type="text" name="attributes[1][name]" class="form-control"  @if(!empty($attribute_name[1])) value="{{ $attribute_name[1] }}" @endif >
                                                        <input type="hidden" name="attributes[1][id]"  @if(!empty($attribute_id[1])) value="{{$attribute_id[1]}}" @endif class="form-control" >

                                                    </div>
                                                    <div class="form-group col-md-5">
                                                        <label>Priority</label>
                                                        <input type="text" name="attributes[1][priority]" class="form-control" @if(!empty($attribute_priority[1])) value="{{ $attribute_priority[1] }}"  @endif>
                                                    </div>

                                                    @if(!empty($attribute_id[1]))
                                                    @php  $value2 = App\Models\AttributeValue::where('attribute_id',$attribute_id[1])->get(); @endphp

                                                        <div class="form-group col-md-2 d-flex align-items-end">
                                                        <a href="{{ route('admin.attribute-values.index', [$attribute_id[1]]) }}" target="_blank"> <i class="fa fa-plus" aria-hidden="true"></i> Add values</a>
                                                        </div>

                                                    <div>
                                                        <ul>
                                                            @foreach($value2 as $item)
                                                                <li>{{ $item->name}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif

                                                </div>


                                                <div class=" row border mt-3 "  >
                                                <div class="form-group col-md-5">
                                                    <label>Attribute 3</label>
                                                    <input type="text" name="attributes[2][name]" class="form-control" @if(!empty($attribute_name[2])) value="{{ $attribute_name[2] }}" @endif >
                                                    <input type="hidden" name="attributes[2][id]"  @if(!empty($attribute_id[2])) value="{{$attribute_id[2]}}" @endif class="form-control" >

                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label>Priority</label>
                                                    <input type="text" name="attributes[2][priority]" class="form-control" @if(!empty($attribute_priority[2]))  value="{{ $attribute_priority[2] }}"  @endif >
                                                </div>

                                                @if(!empty($attribute_id[2]))
                                                @php  $value3 = App\Models\AttributeValue::where('attribute_id',$attribute_id[2])->get(); @endphp

                                                    <div class="form-group col-md-2 d-flex align-items-end">
                                                    <a href="{{ route('admin.attribute-values.index', [$attribute_id[2]]) }}" target="_blank"> <i class="fa fa-plus" aria-hidden="true"></i> Add values</a>
                                                    </div>

                                                    <div>
                                                        <ul>
                                                            @foreach($value3 as $item)
                                                                <li>{{ $item->name}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                    @endif

                                                </div>

                                                </div>

                                                <div class="card-footer text-muted">
                                                    <button class="btn btn-sm btn-primary float-right" type="submit">Add</button>
                                                </div>
                                        </div>

                                     </form>

                                    </div>
                                </div>

                             @if(isset($attribute_id))

                                @php
                                 $attribute_ids = App\Models\Attribute::where('product_id',$obj->id)->pluck('id');
                                 $check_attribute_values = App\Models\AttributeValue::whereIn('attribute_id',$attribute_ids)->exists();
                                @endphp

                                @if($check_attribute_values == 1)
                                    <div class="row">
                                        <div class="col-md-12">
                                        <form method="POST" action="{{ route('admin.attribute-value-image.store')}}" class="p-t-15" data-validate=true >
                                        @csrf    
                            
                                            <div class="card">
                                                <div class="card-header">
                                                    Add Attribute Images
                                                </div>

                                                <div class="card-body  column">                                           
                                                <input type="hidden" name="id" @if($obj->id) value="{{encrypt($obj->id)}}" @endif id="inputId">

                                        
                                                <div class=" row border" >
                                                <!-- @if(!empty($attribute_name[0])) -->
                                                    <div class="form-group  col-md-3">
                                                            <label>  {{ $attribute_name[0] }} </label>
                                                            <select id="attribute_value_1" class="form-control webadmin-select2-input" name="attribute_value_1" required>
                                                                <option value="">-- Select --</option>
                                                                @foreach($value1 as $item)
                                                                    <option value="{{$item->id}}" >{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger"></span>
                                                        </div>
                                                <!-- @endif -->
                                                <!-- @if(!empty($attribute_name[1])) -->

                                                        <div class="form-group col-md-3">
                                                            <label>{{ $attribute_name[1] }}</label>
                                                            <select id="attribute_value_2" class="form-control webadmin-select2-input" name="attribute_value_2">
                                                                <option value="">-- Select --</option>
                                                                @foreach($value2 as $item)
                                                                    <option value="{{$item->id}}" >{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                <!-- @endif -->

                                                <!-- @if(!empty($attribute_name[2])) -->
                                                        <div class="form-group col-md-3">
                                                            <label>{{ $attribute_name[2] }}</label>
                                                            <select id="attribute_value_3" class="form-control webadmin-select2-input" name="attribute_value_3">
                                                                <option value="">-- Select --</option>
                                                                @foreach($value3 as $item)
                                                                    <option value="{{$item->id}}" >{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                <!-- @endif -->
                                                    
                                                        <div class="form-group col-md-3">
                                                            <label>Image</label>                                                       
                                                    @include('admin.media.set_file', ['file'=>$obj->attribute_value_image, 'title'=>'attribute_value_image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'attribute_value_image_id'])

                                                        </div>
                                            
                                                    </div>
                                                </div>

                                                    <div class="card-footer text-muted">
                                                        <button class="btn btn-sm btn-primary float-right" type="submit">Add</button>
                                                    </div>
                                            </div>

                                            </form>

                                        </div>
                                    </div>

                                @endif

                                     @php    $images = App\Models\AttributeValueImage::with('attribute1','attribute2','attribute3')->where('product_id',$obj->id)->get(); @endphp
                               
                                    @if(!$images->isEmpty())
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        List Attribute Images
                                                    </div>

                                                    <div class="card-body  column">                                           
                                                    <div class=" row border" >
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Value 1</th>
                                                            <th scope="col">Value 2</th>
                                                            <th scope="col">Value 3</th>
                                                            <th scope="col">Image</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($images as $index => $item)
                                                        @php
                                                            $image_path = App\Models\Media::where('id',$item->attribute_value_image_id)->pluck('file_path')->first();
                                                        @endphp
                                                            <tr>
                                                                <th scope="row">{{ $index + 1 }}</th>
                                                                <td>{{ $item->attribute_value_id_1 ? $item->attribute1->name : '' }}</td>
                                                                <td>{{ $item->attribute_value_id_2 ? $item->attribute2->name : '' }}</td>
                                                                <td>{{ $item->attribute_value_id_3 ? $item->attribute3->name : '' }}</td>
                                                                <td>@if(isset($image_path)) <img src="{{ asset($image_path) }}" alt="" style="width:50px;height:50px"> @endif </td> 
                                                            </tr>
                                                        @endforeach
                                                        
                                                        </tbody>
                                                        </table>

                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                             @endif
                        @endif

                    


                           
                        </div><!--end col-->
                    </div><!--end row-->

                </div><!-- container -->

                @include('admin._partials.footer')
            </div>
            <!-- end page content -->
@endsection
@section('footer')
    <script type="text/javascript">
        var validator = $('#InputFrm').validate({
            ignore: [],
            rules: {
                "name": "required",
                slug: {
                  required: true,
                  remote: {
                      url: "{{route('admin.unique-slug')}}",
                      data: {
                        id: function() {
                          return $( "#inputId" ).val();
                        },
                        table: 'products',
                    }
                  }
                },
              },
              messages: {
                "name": "Product name cannot be blank",
                slug: {
                  required: "Slug cannot be blank",
                  remote: "Slug is already in use",
                },
              },
            });
    </script>

    <script type="text/javascript">
            var validator = $('#AttrtInputFrm').validate({
                ignore: [],
                rules: {
                    "attributes[0][name]": "required",
                    "attributes[0][priority]": {
                    required: true,
                    remote: {
                        url: "{{route('admin.unique-slug')}}",
                        data: {
                            id: function() {
                            return $( "#inputId" ).val();
                            },
                            table: 'attributes',
                        }
                    }
                    },
                },
                messages: {
                "attributes[0][name]": "Attribute name cannot be blank",
                "attributes[0][priority]": {
                    required: "Priority cannot be blank",
                    // remote: "Slug is already in use",
                },
                },
                });
    </script> 

@parent
@endsection


@extends('admin._layouts.fileupload')
@section('content')
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
<!-- Team Section -->
<div class="page-content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">All Widgets</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin')}}">Admin</a></li>
                                <li class="breadcrumb-item active">All Widgets</li>
                            </ol>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
            </div><!--end col-->
        </div><!--end row-->
        <!-- end page title end breadcrumb -->
        @include('admin._partials.notifications')
        <div class="row col-md-12">
            <div class="col-md-6">
                <form method="POST" action="{{ route('admin.widgets.save') }}" class="p-t-15" id="InputFrm" data-validate=true>
                    @csrf
                    <input type="hidden" name="id" value="1">

                    <div class="card">
                        <div class="card-header">
                            Unlock your potential
                        </div>
                        <div class="card-body row">

                            <div class="form-group col-md-12">
                                <label>Bold Title</label>
                                <input type="text" name="section[title]" class="form-control" @if(isset($data['unlock']['title'])) value="{{$data['team']['title']}}" @endif>
                            </div>


                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <textarea name="section[description]" class="form-control">@if(isset($data['unlock']['description'])) {{$data['team']['description']}} @endif</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Parents Recommends</label>
                                <input type="text" name="section[parents_recommends]" class="form-control" @if(isset($data['unlock']['parents_recommends'])) value="{{$data['team']['parents_recommends']}}" @endif>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Button Text</label>
                                <input type="text" name="section[button_text]" class="form-control" @if(isset($data['unlock']['button_text'])) value="{{$data['team']['button_text']}}" @endif>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Button Url</label>
                                <input type="text" name="section[button_url]" class="form-control" @if(isset($data['unlock']['button_url'])) value="{{$data['team']['button_url']}}" @endif>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>



            <div class="col-md-6">
                <form method="POST" action="{{ route('admin.widgets.save') }}" class="p-t-15" id="InputFrm" data-validate=true>
                    @csrf
                    <input type="hidden" name="id" value="5">


                    <div class="card">
                        <div class="card-header">
                      About Alpha Academy
                           </div>
                            <div class="card-body row">

                                <div class="form-group col-md-12">
                                    <label>Heading</label>
                                    <input type="text" name="section[alpha_title]" class="form-control" @if(isset($data['alpha_academy']['alpha_title'])) value="{{$data['alpha_academy']['alpha_title']}}" @endif>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Description</label>
                                    <textarea name="section[alpha_description]" class="form-control">@if(isset($data['alpha_academy']['alpha_description'])) {{$data['alpha_academy']['alpha_description']}} @endif</textarea>

                                </div>


                            </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        </div>


        @include('admin._partials.footer')
    </div>

</div><!-- container -->


@include('admin._partials.footer')
</div>
<!-- Count down -->

<!-- end page content -->
@endsection
@section('footer')
@parent
@endsection


<div id="form-vertical" class="form-horizontal form-wizard-wrapper">

<h3>courses</h3>
<fieldset>
    <div class="form-group col-md-12">
        <label>Title</label>
        <input type="text" name="content[title]" class="form-control" @if($obj->content && isset($obj->content['title'])) value="{{$obj->content['title']}}" @endif >
    </div>
    <div class="form-group col-md-12">
        <label>Second Title</label>
        <input type="text" name="content[title_1]" class="form-control" @if($obj->content && isset($obj->content['title_1'])) value="{{$obj->content['title_1']}}" @endif >
    </div>
    <div class="form-group mb-2">
        <label for="exampleInputPassword1">Url</label>
        <input type="text" name="custom_url" class="form-control" id="inputCustomUrl" value="{{$obj->custom_url}}">
      </div>
      <div class="form-group mb-2">
        <label for="exampleInputPassword1">Button name</label>
        <input type="text" name="button_name" class="form-control" id="inputCustomUrl" value="{{$obj->button_name}}">
      </div>
      <div class="form-group mb-2">
        <label for="exampleInputPassword1">Button url</label>
        <input type="text" name="button_url" class="form-control" id="inputCustomUrl" value="{{$obj->button_url}}">
      </div>
</fieldset>
<h3>Banner section</h3>
<fieldset>

<div class="form-group col-md-12">
    <label>Class at Alpha Entrance Name</label>
    <input type="text" name="content[button_name_class]" class="form-control" @if($obj->content && isset($obj->content['button_name_class'])) value="{{$obj->content['button_name_class']}}" @endif >
</div>
.<div class="form-group col-md-12">
    <label>Class at Alpha Entrance url</label>
    <input type="text" name="content[button_url_class]" class="form-control" @if($obj->content && isset($obj->content['button_url_class'])) value="{{$obj->content['button_url_class']}}" @endif >
</div>
<div class="form-group col-md-12">
    <label>Question paper Name</label>
    <input type="text" name="content[question_button_name]" class="form-control" @if($obj->content && isset($obj->content['question_button_name'])) value="{{$obj->content['question_button_name']}}" @endif >
</div>
.<div class="form-group col-md-12">
    <label>Question pape url</label>
    <input type="text" name="content[button_url_question]" class="form-control" @if($obj->content && isset($obj->content['button_url_question'])) value="{{$obj->content['button_url_question']}}" @endif >
</div>

.<div class="form-group col-md-12">
    <label>Banner bottom description</label>
    <input type="text" name="content[banner_bottom_description]" class="form-control" @if($obj->content && isset($obj->content['banner_bottom_description'])) value="{{$obj->content['banner_bottom_description']}}" @endif >
</div>


.<div class="form-group col-md-12">
    <label>Why neet button name</label>
    <input type="text" name="content[why_button_name]" class="form-control" @if($obj->content && isset($obj->content['why_button_name'])) value="{{$obj->content['why_button_name']}}" @endif >
</div>
.<div class="form-group col-md-12">
    <label>Why neet button url</label>
    <input type="text" name="content[why_button_url]" class="form-control" @if($obj->content && isset($obj->content['why_button_url'])) value="{{$obj->content['why_button_url']}}" @endif >
</div>
</fieldset>




<h3>Course listing</h3>
<fieldset>
    <div class="form-group">
        <a href="{{ route('admin.listing-items.index', [1]) }}" class="btn btn-primary" target="_blank">Course listing</a>
        <input type="hidden" name="content[course_listing]" value="1">
    </div>
</fieldset>

<h3>More about Section</h3>
<fieldset>
    .<div class="form-group col-md-12">
        <label>Heading</label>
        <input type="text" name="content[more_about_title]" class="form-control" @if($obj->content && isset($obj->content['more_about_title'])) value="{{$obj->content['more_about_title']}}" @endif >
    </div>

    <div class="card-body row">
        <div class="form-group col-md-12">
            <label>Bold heading</label>
            <textarea name="content[main_heading]" class="form-control editor">@if ($obj->content && isset($obj->content['main_heading'])) {{ $obj->content['main_heading'] }} @endif</textarea>
        </div>
    </div>

    .<div class="form-group col-md-12">
        <label>Sub title</label>
        <input type="text" name="content[sub_title]" class="form-control" @if($obj->content && isset($obj->content['sub_title'])) value="{{$obj->content['sub_title']}}" @endif >
    </div>

</fieldset>

</div>

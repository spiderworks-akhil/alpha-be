<div id="form-vertical" class="form-horizontal form-wizard-wrapper">

<h3>    Top Section</h3>
<fieldset>
    <div class="form-group col-md-12">
        <label>Heading</label>
        <input type="text" name="content[heading]" class="form-control" @if($obj->content && isset($obj->content['heading'])) value="{{$obj->content['heading']}}" @endif >
    </div>
    <div class="form-group col-md-12">
        <label>Sub Heading</label>
        <input type="text" name="content[sub_heading]" class="form-control" @if($obj->content && isset($obj->content['sub_heading'])) value="{{$obj->content['sub_heading']}}" @endif >
    </div>
    @php
    $media_id_works_first_featured_image =
        $obj->content && isset($obj->content['media_id_works_first_featured_image'])
            ? $obj->content['media_id_works_first_featured_image']
            : null;
    @endphp
    @include('admin.media.set_file', [
        'file' => $media_id_works_first_featured_image,
        'title' => 'Top  Image ',
        'popup_type' => 'single_image',
        'type' => 'Image',
        'holder_attr' => 'content[media_id_works_first_featured_image]',
        'id' => 'media_id_works_first_featured_image',
        'display' => 'horizontal',
    ])


</fieldset>
<h3>Candidate</h3>
<fieldset>
    
</fieldset>

</div>

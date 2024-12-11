<div id="form-vertical" class="form-horizontal form-wizard-wrapper">
    <h3>Banner Section</h3>
    <fieldset>

        <div class="form-group col-md-12">
            <label>Banner Title</label>
            <input type="text" name="content[banner_title]" class="form-control" @if($obj->content && isset($obj->content['banner_title'])) value="{{$obj->content['banner_title']}}" @endif>
        </div>

        <div class="form-group">
            @php
            $media_id_banner_image = ($obj->content && isset($obj->content['media_id_banner_image'])) ? $obj->content['media_id_banner_image'] : null;
            @endphp
            @include('admin.media.set_file', ['file'=>$media_id_banner_image, 'title'=>'Banner Image', 'popup_type'=>'single_image', 'type'=>'Image', 'holder_attr'=>'content[media_id_banner_image]', 'id'=>'media_id_banner_image', 'display'=> 'horizontal'])
        </div>

        <div class="form-group col-md-12">
            <label>Banner Short Description</label>
            <textarea name="content[banner_shortdescription]" class="form-control">@if($obj->content && isset($obj->content['banner_shortdescription'])) {{$obj->content['banner_shortdescription']}} @endif</textarea>
        </div>




    </fieldset>

    <h3>Special Section</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label>Title</label>
            <input type="text" name="content[banner_title_2]" class="form-control" @if($obj->content && isset($obj->content['banner_title_2'])) value="{{$obj->content['banner_title_2']}}" @endif>
        </div>


        @php
        $media_id_works_first_featured_image = $obj->content['media_id_works_first_featured_image'] ?? null;
    @endphp
    @include('admin.media.set_file', [
        'file' => $media_id_works_first_featured_image,
        'title' => 'First Featured Image',
        'popup_type' => 'single_image',
        'type' => 'Image',
        'holder_attr' => 'content[media_id_works_first_featured_image]',
        'id' => 'media_id_works_first_featured_image',
        'display' => 'horizontal'
    ])


<h5>section 2</h5>

<div class="form-group col-md-12">
    <label>Title</label>
    <input type="text" name="content[banner_title_3]" class="form-control" @if($obj->content && isset($obj->content['banner_title_3'])) value="{{$obj->content['banner_title_3']}}" @endif>
</div>


@php
$media_id_works_first_featured_image_1 = $obj->content['media_id_works_first_featured_image_1'] ?? null;
@endphp
@include('admin.media.set_file', [
'file' => $media_id_works_first_featured_image_1,
'title' => 'First Featured Image',
'popup_type' => 'single_image',
'type' => 'Image',
'holder_attr' => 'content[media_id_works_first_featured_image_1]',
'id' => 'media_id_works_first_featured_image_1',
'display' => 'horizontal'
])

<h5>Sectin 3</h5>
<div class="form-group col-md-12">
    <label>Title</label>
    <input type="text" name="content[banner_title_4]" class="form-control" @if($obj->content && isset($obj->content['banner_title_4'])) value="{{$obj->content['banner_title_4']}}" @endif>
</div>


@php
$media_id_works_first_featured_image_2 = $obj->content['media_id_works_first_featured_image_2'] ?? null;
@endphp
@include('admin.media.set_file', [
'file' => $media_id_works_first_featured_image_2,
'title' => 'First Featured Image',
'popup_type' => 'single_image',
'type' => 'Image',
'holder_attr' => 'content[media_id_works_first_featured_image_2]',
'id' => 'media_id_works_first_featured_image_2',
'display' => 'horizontal'
])

<h5>section 4</h5>
<div class="form-group col-md-12">
    <label>Title</label>
    <input type="text" name="content[banner_title_5]" class="form-control" @if($obj->content && isset($obj->content['banner_title_5'])) value="{{$obj->content['banner_title_5']}}" @endif>
</div>


@php
$media_id_works_first_featured_image_3 = $obj->content['media_id_works_first_featured_image_3'] ?? null;
@endphp
@include('admin.media.set_file', [
'file' => $media_id_works_first_featured_image_3,
'title' => 'First Featured Image',
'popup_type' => 'single_image',
'type' => 'Image',
'holder_attr' => 'content[media_id_works_first_featured_image_3]',
'id' => 'media_id_works_first_featured_image_3',
'display' => 'horizontal'
])
    </fieldset>
    <h3>Photo section</h3>
    <fieldset>
        @php
        $media_id_works_first_featured_image_4 = $obj->content['media_id_works_first_featured_image_4'] ?? null;
        @endphp
        @include('admin.media.set_file', [
        'file' => $media_id_works_first_featured_image_4,
        'title' => 'First Featured Image',
        'popup_type' => 'single_image',
        'type' => 'Image',
        'holder_attr' => 'content[media_id_works_first_featured_image_4]',
        'id' => 'media_id_works_first_featured_image_4',
        'display' => 'horizontal'
        ])

@php
$media_id_works_first_featured_image_5 = $obj->content['media_id_works_first_featured_image_5'] ?? null;
@endphp
@include('admin.media.set_file', [
'file' => $media_id_works_first_featured_image_5,
'title' => 'First Featured Image',
'popup_type' => 'single_image',
'type' => 'Image',
'holder_attr' => 'content[media_id_works_first_featured_image_5]',
'id' => 'media_id_works_first_featured_image_5',
'display' => 'horizontal'
])

@php
$media_id_works_first_featured_image_6 = $obj->content['media_id_works_first_featured_image_6'] ?? null;
@endphp
@include('admin.media.set_file', [
'file' => $media_id_works_first_featured_image_6,
'title' => 'First Featured Image',
'popup_type' => 'single_image',
'type' => 'Image',
'holder_attr' => 'content[media_id_works_first_featured_image_6]',
'id' => 'media_id_works_first_featured_image_6',
'display' => 'horizontal'
])

@php
$media_id_works_first_featured_image_7 = $obj->content['media_id_works_first_featured_image_7'] ?? null;
@endphp
@include('admin.media.set_file', [
'file' => $media_id_works_first_featured_image_7,
'title' => 'First Featured Image',
'popup_type' => 'single_image',
'type' => 'Image',
'holder_attr' => 'content[media_id_works_first_featured_image_7]',
'id' => 'media_id_works_first_featured_image_7',
'display' => 'horizontal'
])


    </fieldset>
    <h3>middle content</h3>
    <fieldset>

        <div class="form-group col-md-12">
            <label>Banner Title</label>
            <input type="text" name="content[banner_title_6]" class="form-control" @if($obj->content && isset($obj->content['banner_title_6'])) value="{{$obj->content['banner_title_6']}}" @endif>
        </div>

        <div class="form-group col-md-12">
            <label>Description</label>
            <textarea name="content[section_description_first]" class="form-control editor">
                {{ $obj->content['section_description_first'] ?? '' }}
            </textarea>
        </div>

        @php
        $media_id_works_first_featured_image_8 = $obj->content['media_id_works_first_featured_image_8'] ?? null;
        @endphp
        @include('admin.media.set_file', [
        'file' => $media_id_works_first_featured_image_8,
        'title' => 'First Featured Image',
        'popup_type' => 'single_image',
        'type' => 'Image',
        'holder_attr' => 'content[media_id_works_first_featured_image_8]',
        'id' => 'media_id_works_first_featured_image_8',
        'display' => 'horizontal'
        ])
    <div class="form-group col-md-12">
        <label>Title</label>
        <input type="text" name="content[banner_title_8]" class="form-control" @if($obj->content && isset($obj->content['banner_title_8'])) value="{{$obj->content['banner_title_8']}}" @endif>
    </div>

    </fieldset>
    <h3>Footer Section</h3>
    <fieldset>
        <div class="form-group col-md-12">
            <label> Title</label>
            <input type="text" name="content[aplpha_title]" class="form-control" @if($obj->content && isset($obj->content['aplpha_title'])) value="{{$obj->content['aplpha_title']}}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Button Title</label>
            <input type="text" name="content[button_title]" class="form-control" @if($obj->content && isset($obj->content['button_title'])) value="{{$obj->content['button_title']}}" @endif>
        </div>
        <div class="form-group col-md-12">
            <label>Button url</label>
            <input type="text" name="content[button_url]" class="form-control" @if($obj->content && isset($obj->content['button_url'])) value="{{$obj->content['button_url']}}" @endif>
        </div>



        <div class="card-body row">
            <div class="form-group col-md-12">
                <label>Alpha Academy Description </label>
                <textarea name="content[alpha_academy_description]" class="form-control editor ">
    @if ($obj->content && isset($obj->content['alpha_academy_description']))
    {{ $obj->content['alpha_academy_description'] }}
    @endif
    </textarea>
            </div>
        </div>

        <div class="form-group col-md-12">
            <label> Read more Button url</label>
            <input type="text" name="content[read_button_url]" class="form-control" @if($obj->content && isset($obj->content['read_button_url'])) value="{{$obj->content['read_button_url']}}" @endif>
        </div>
    </fieldset>

</div>

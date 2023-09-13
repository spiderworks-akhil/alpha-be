<form method="POST" action="{{ route('admin.sliders.update-photo') }}" class="p-t-15" id="sliderModalFrm" data-validate=true>
                  @csrf

<input type="hidden" name="type" value="{{$type}}">
<input type="hidden" name="id" value="{{encrypt($photo->id)}}">

<div class="row box w-100 m-0">

	<div class="box-body m-0">

    <div class="row m-0">
        <div class="form-group col-md-6">

          <label class="control-label" for="inputLabelEn">Title</label>
          <input type="text" name="title" class="form-control" value="{{$photo->title}}" id="titleInput" >
        </div>

        <div class="form-group col-md-6">

          <label class="control-label" for="inputLabelEn">Subtitle</label>
          <input type="text" name="sub_title" class="form-control" value="{{$photo->sub_title}}" id="sub_titleInput" >
        </div>
    </div>

    <div class="form-group required row nopadding">
      @if($photo->media->media_type == 'Image')
        <div class="col-md-9 nopadding img-container-edit" >

          <img src="{{ asset('public/'.$photo->media->file_path) }}" >

        </div>
      @elseif($photo->media->media_type == 'Video')
            <div class="col-md-9 nopadding">
                <video autoplay muted loop playsinline controls preload="metadata" class="w-100">
            	  <source src="{{ asset('public/'.$photo->media->file_path) }}" type="{{$photo->media->file_type}}">
              </video>
            </div>
        @endif

      <div class="col-md-3 img-details-edit">

        <div class="img-details ml-3">

          <p><label>File Name: </label> {{$photo->media->file_name}}</p>

          <p><label>Created On: </label> <?php echo date('d M, Y h:i A', strtotime($photo->media->created_at));?></p>

          <p><label>File Type: </label> {{$photo->media->file_type}}</p>
          @if($photo->media->media_type == 'Image')
            <p><label>File Dimensions: </label> {{$photo->media->dimensions}}</p>
          @endif

        </div>
  </div>

    </div>

    <div class="form-group required">

      <label class="control-label" for="inputLabelEn">Alt Text</label>

      <input type="text" name="alt_text" class="form-control" value="{{$photo->alt_text}}" id="altInput" >

    </div>

    <div class="form-group required">

      <label class="control-label" for="inputLabelEn">Description</label>
      <textarea name="description" class="form-control richtext" id="bottom_description" >{{$photo->description}}</textarea>

    </div>

    <div class="form-group row">

      <div class="form-group col-md-4 no-padding">

        <label>Button1 Text</label>

        <input type="text" name="button_text" class="form-control" value="{{$photo->button_text}}" id="button_text" >

      </div>

      <div class="form-group col-md-4">

        <label>Button1 Url</label>
        <input type="text" name="button_link" class="form-control" value="{{$photo->button_link}}" id="button_link" >
      </div>

      <div class="form-group col-md-4 no-padding">

        <label>Button1 Target</label>
        <select name="button_link_target" class="form-control" id="inputStatus">
          <option value=""></option>
          <option value="_blank">_blank</option>
        </select>     

      </div>

    </div>



    <div class="form-group row">

      <div class="form-group col-md-4 no-padding">

        <label>Button2 Text</label>
        <input type="text" name="button2_text" class="form-control" value="{{$photo->button2_text}}" id="button2_text" >
      </div>

      <div class="form-group col-md-4">

        <label>Button2 Url</label>
        <input type="text" name="button2_link" class="form-control" value="{{$photo->button2_link}}" id="button2_link" >

      </div>

      <div class="form-group col-md-4 no-padding">

        <label>Button2 Target</label>
        <select name="button2_link_target" class="form-control" id="inputStatus">
          <option value=""></option>
          <option value="_blank">_blank</option>
        </select>      

      </div>

    </div>

    <div class="form-group col-md-12 pull-right">

            <button type="submit" class="btn btn-primary">Save</button>

    </div>

  </div>

</div>

</form>
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Traits\ResourceTrait;

use App\Models\Gallery;
use App\Models\GalleryMedia;
use App\Models\Category;

use View, Redirect;

class GalleryController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new Gallery;
        $this->route .= '.galleries';
        $this->views .= '.galleries';

        $this->permissions = ['list'=>'gallery_listing', 'create'=>'gallery_adding', 'edit'=>'gallery_editing', 'delete'=>'gallery_deleting'];
        $this->resourceConstruct();

    }
    
    protected function getCollection() {
        return $this->model->select('id', 'slug', 'name', 'priority', 'status', 'created_at', 'updated_at');
    }

    protected function setDTData($collection) {
        $route = $this->route;
        return $this->initDTData($collection)
            ->rawColumns(['action_edit', 'action_delete', 'status']);
    }

    protected function getSearchSettings(){}

    public function create()
    {
        $categories = Category::where('parent_id',0)->where('category_type', 'Gallery')->get();
        return view::make($this->views . '.form', array('obj'=>$this->model, 'categories'=>$categories));
    }

    public function edit($id) {
        $id = decrypt($id);
        if($obj = $this->model->find($id)){
            $categories = Category::where('parent_id',0)->where('category_type', 'Gallery')->get();
            return view($this->views . '.form')->with('obj', $obj)->with('categories', $categories);
        } else {
            return $this->redirect('notfound');
        }
    }

    public function store()
    {
        $this->model->validate();
        $data = request()->all();
        $data['is_featured'] = isset($data['is_featured'])?1:0;
        if(empty($data['priority'])){
            $last = $this->model->select('id')->orderBy('id', 'DESC')->first();
            $data['priority'] = ($last)?$last->id+1:1;
        }
        $this->model->fill($data);
        if($this->model->save())
        {
            if(isset($data['gallery_medias']))
                foreach ($data['gallery_medias'] as $key => $value) {
                    if(trim($value) != '')
                    {
                        $event_media = new GalleryMedia;
                        $event_media->upload_type = 'Upload';
                        $event_media->media_id = $value;
                        $this->model->gallery()->save($event_media);
                    }
                }

            if(isset($data['youtube_url']))
                foreach ($data['youtube_url'] as $key => $value) {
                    if(trim($value) != '')
                    {
                        $event_media = new GalleryMedia;
                        $event_media->upload_type = 'Youtube';
                        $event_media->youtube_url = $value;
                        $event_media->youtube_preview = $data['youtube_preview'][$key];
                        $this->model->gallery()->save($event_media);
                    }
                }
        }
        return Redirect::to(route($this->route. '.edit', ['id'=> encrypt($this->model->id)]))->withSuccess('Gallery successfully saved!');
    }

    public function update()
    {
        $data = request()->all();
        $id = decrypt($data['id']);
        $this->model->validate(request()->all(), $id);
         if($obj = $this->model->find($id)){
            $data['is_featured'] = isset($data['is_featured'])?1:0;
            if($obj->update($data))
            {
                GalleryMedia::where('galleries_id', $obj->id)->forcedelete();
                if(isset($data['gallery_medias']))
                    foreach ($data['gallery_medias'] as $key => $value) {
                        if(trim($value) != '')
                        {
                            $event_media = new GalleryMedia;
                            $event_media->upload_type = 'Upload';
                            $event_media->media_id = $value;
                            $obj->gallery()->save($event_media);
                        }
                    }

                if(isset($data['youtube_url']))
                    foreach ($data['youtube_url'] as $key => $value) {
                        if(trim($value) != '')
                        {
                            $event_media = new GalleryMedia;
                            $event_media->upload_type = 'Youtube';
                            $event_media->youtube_url = $value;
                            $event_media->youtube_preview = $data['youtube_preview'][$key];
                            $obj->gallery()->save($event_media);
                        }
                    }
            }

            return Redirect::to(route($this->route. '.edit', ['id'=>encrypt($id)]))->withSuccess('Gallery successfully updated!');
        } else {
            return Redirect::back()
                    ->withErrors("Ooops..Something wrong happend.Please try again.") // send back all errors to the login form
                    ->withInput(request()->all());
        }
    }

    
}

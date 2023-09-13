<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Traits\ResourceTrait;

use App\Models\FrontendPage;
use Illuminate\Http\Request;
use View, Redirect;

class StaticPageController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new FrontendPage;
        $this->route .= '.static-pages';
        $this->views .= '.static_pages';

        $this->permissions = ['list'=>'static_pages_listing', 'create'=>'', 'edit'=>'static_pages_editing', 'delete'=>''];
        $this->resourceConstruct();

    }
    
    protected function getCollection() {
        return $this->model->select('id', 'slug', 'name', 'title', 'updated_at');
    }

    protected function setDTData($collection) {
        $route = $this->route;
        return $this->initDTData($collection)
            ->rawColumns(['action_edit', 'action_delete', 'status']);
    }

    protected function getSearchSettings(){}

    public function edit_content($id)
    {
        if($obj = $this->model->find($id))
        {
            $obj->content = json_decode($obj->content);
            return view::make($this->views . '._partials.'.$obj->slug, array('obj'=>$obj));
        }
    }

    public function update_content(Request $request)
    {
        $data = $request->all();
        $id = decrypt($data['id']);
        if($obj = $this->model->find($id)){
            if(isset($data['content']))
            {
                $obj->content = json_encode($data['content']);
                $obj->save();
            }
            
            return Redirect::to(route('admin.static-pages.edit', array('id'=>encrypt($obj->id))))->withSuccess('Extra content successfully saved!');
        } else {
            return Redirect::back()
                        ->withErrors("Ooops..Something wrong happend.Please try again.") // send back all errors to the login form
                        ->withInput(request()->all());
        }
    }

}

<?php

namespace App\Http\Controllers\Admin;

use View, Redirect;
use App\Models\Course;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Traits\ResourceTrait;
use App\Http\Requests\Admin\ServiceRequest;
use App\Http\Controllers\Admin\BaseController as Controller;

class CourseController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new Course;
        $this->route .= '.courses';
        $this->views .= '.courses';

        $this->permissions = ['list'=>'courses_listing', 'create'=>'courses_adding', 'edit'=>'courses_editing', 'delete'=>'courses_deleting'];
        $this->resourceConstruct();

    }

    public function index(Request $request, $parent=null)
    {
        if ($request->ajax()) {
            $collection = $this->getCollection();
            $parent_id = ($parent)?$parent:0;
            $collection->where('courses.parent_id', '=', $parent_id);
            $route = $this->route;
            return $this->setDTData($collection)->make(true);
        } else {
            $parent_data = null;
            if($parent)
                $parent_data = $this->model->find($parent);
            $search_settings = $this->getSearchSettings();
            return view::make($this->views . '.index', array('parent'=>$parent, 'parent_data'=>$parent_data, 'search_settings'=>$search_settings));
        }
    }

    protected function getCollection() {
        return $this->model->select('id', 'name', 'slug', 'parent_id', 'title', 'priority', 'status', 'created_at', 'updated_at');
    }

    protected function setDTData($collection) {
        $route = $this->route;
        return $this->initDTData($collection)
        	->addColumn('sub-courses', function($obj) use ($route) {
                $has_child = $this->model->where('parent_id', '=', $obj->id)->count();
                return '<a href="' . route( $route . '.index',  [$obj->id] ) . '" class="btn btn-info btn-sm" >Sub-courses (' . $has_child . ')</a>';
            })
            ->addColumn('action_delete_category', function($obj) use ($route) {
                if(auth()->user()->can($this->permissions['delete'])){
                    $has_child = $this->model->where('parent_id', '=', $obj->id)->count();
                    if($has_child)
                    {
                        return '<a href="javascript:void(0);" class= "text-danger delete_have_child" title="Created at : ' . date('d/m/Y - h:i a', strtotime($obj->created_at)) . '" > <i class="fa fa-trash"></i></button>';
                    }
                    else{
                        return '<a href="' . route( $route . '.destroy',  [encrypt($obj->id)] ) . '" class="text-danger webadmin-btn-warning-popup" data-message="Are you sure to delete?  Associated data will be removed if it is deleted." title="' . ($obj->updated_at ? 'Last updated at : ' . date('d/m/Y - h:i a', strtotime($obj->updated_at)) : '') . '" ><i class="fa fa-trash"></i></a>';
                    }
                }
                else
                    return '<a href="javascript:void(0)" class="text-secondary" title="You have no permission to delete" ><i class="fa fa-trash"></i></a>';
            })
            ->rawColumns(['action_edit', 'action_delete_category', 'status', 'sub-courses']);
    }

    protected function getSearchSettings(){}

    public function create($parent=null)
    {
        $parent_data = null;
        if($parent)
            $parent_data = $this->model->find($parent);
        $courses = $this->model->where('parent_id',0)->get();
        return View::make($this->views . '.form', array('obj'=>$this->model, 'parent'=>$parent, 'parent_data'=>$parent_data, 'courses'=>$courses));

    }

    public function store(ServiceRequest $request)
    {
        $request->validated();
        $data = request()->all();
        if(Config('admin.courses.sections') && !empty($data['content'])){
            $data['content'] = json_encode($data['content']);
        }
        return $this->_store($data);
    }

    public function edit($id) {
    	$id = decrypt($id);
        if($obj = $this->model->find($id)){
            $parent = null;
            if($obj->parent_id >0)
                $parent = $obj->parent_id;
            $parent_data = $this->model->where('parent_id', $obj->parent_id)->first();
            $courses = $this->model->where('parent_id',0)->get();
            return view($this->views . '.form')->with('obj', $obj)->with('parent', $parent)->with('parent_data', $parent_data)->with('courses', $courses);
        } else {
            return $this->redirect('notfound');
        }
    }

    public function update(ServiceRequest $request)
    {
        $request->validated();
        $data = request()->all();
    	$id = decrypt($data['id']);
        if(Config('admin.courses.sections') && !empty($data['content'])){
            $data['content'] = json_encode($data['content']);
        }
        return $this->_update($id, $data);
    }
}

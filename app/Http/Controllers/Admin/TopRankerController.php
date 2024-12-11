<?php

namespace App\Http\Controllers\Admin;

use View, Redirect;
use App\Models\Course;
use App\Models\Service;
use App\Models\TopRanker;
use App\Models\Department;
use Illuminate\Http\Request;

use App\Traits\ResourceTrait;
use App\Http\Requests\Admin\TopRankRequest;
use App\Http\Controllers\Admin\BaseController as Controller;

class TopRankerController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new TopRanker();
        $this->route .= '.top-rankers';
        $this->views .= '.top_rankers';

        $this->permissions = ['list'=>'top_rankers_listing', 'create'=>'top_rankers_adding', 'edit'=>'top_rankers_editing', 'delete'=>'top_rankers_deleting'];
        $this->resourceConstruct();

    }

    protected function getCollection() {
        return $this->model->select('id', 'name', 'slug', 'designation', 'priority', 'status', 'updated_at');
    }

    protected function setDTData($collection) {
        $route = $this->route;
        return $this->initDTData($collection)
            ->rawColumns(['action_edit', 'action_delete', 'status']);
    }

    protected function getSearchSettings(){}

    public function create()
    {
        $departments = Department::get();
        return view($this->views . '.form')->with('obj', $this->model)->with('tab', 'basic')->with('departments', $departments);
    }

    public function edit($id, $tab="basic") {
        $id =  decrypt($id);
        if($obj = $this->model->find($id)){
            $departments = Department::get();
            return view($this->views . '.form')->with('obj', $obj)->with('tab', $tab)->with('departments', $departments);
        } else {
            return $this->redirect('notfound');
        }
    }

    public function store(TopRankRequest $request)
    {
        $request->validated();
        $data = $request->all();

        $data['content'] = json_encode($data['content']);

        return $this->_store($data);
    }

    protected function saveDepartment($department_id)
    {
        $department = Department::find($department_id);
        if(!$department){
            $new_department = New Department;
            $new_department->name = $department_id;
            $new_department->save();
            return $new_department->id;
        }
        else
            return $department->id;
    }

    public function update(TopRankRequest $request)
    {
        $request->validated();
        $data = $request->all();
        $id = decrypt($data['id']);
       

            $data['content'] = json_encode($data['content']);

        return $this->_update($id, $data);
    }

}

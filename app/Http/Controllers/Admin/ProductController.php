<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Traits\ResourceTrait;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Attribute;

use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new Product;
        $this->route .= '.products';
        $this->views .= '.products';

        $this->permissions = ['list'=>'product_listing', 'create'=>'product_adding', 'edit'=>'product_editing', 'delete'=>'product_deleting'];
        $this->resourceConstruct();

    }

    protected function getCollection() {
        return $this->model->select('id', 'slug', 'name', 'title', 'priority', 'status', 'created_at', 'updated_at');
    }

    protected function setDTData($collection) {
        $route = $this->route;
        return $this->initDTData($collection)
            ->rawColumns(['action_edit', 'action_delete', 'status']);
    }

    protected function getSearchSettings(){}

    public function store(ProductRequest $request)
    {
        $request->validated();
        return $this->_store($request->all());
    }

    public function update(ProductRequest $request)
    {
        $request->validated();
        $id = decrypt($request->id);

        return $this->_update($id, $request->all());
    }

    public function CreateAttribute(Request $request)
    {
        // $request->validated();
        $id = decrypt($request->id);

        $data        = $request->all();
        $attributes  = $data['attributes'];
        
        foreach ($attributes as $item) {
            
            if (!empty($item['name']) && !empty($item['priority'])) {

                if (empty($item['id'])) {
                    
                    $attribute = new Attribute;
                } else {
                   
                    $attribute = Attribute::find($item['id']);
                    if (!$attribute) {
                        
                        continue; 
                    }
                }
        
                $attribute->fill($item);
                $attribute->product_id = $id; 
                $attribute->save();
            }
        }

        return redirect()->back();        
    }



}

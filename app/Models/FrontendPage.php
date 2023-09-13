<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use App\Traits\ValidationTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrontendPage extends Model
{
    use SoftDeletes;
    use ValidationTrait {
        ValidationTrait::validate as private parent_validate;
    }
    
    public function __construct() {
        
        parent::__construct();
        $this->__validationConstruct();
    }
    
    protected $table = 'frontend_pages';

     protected $fillable = array('slug', 'name', 'title', 'content', 'featured_image_id', 'banner_image_id', 'browser_title', 'meta_description', 'meta_keywords', 'top_description', 'bottom_description', 'og_title', 'og_description', 'og_image_id', 'extra_css', 'extra_js', 'status');

    protected $dates = ['created_at','updated_at'];

    protected function setRules() {

        $this->val_rules = array(
        );
    }

    protected function setAttributes() {
        $this->val_attributes = array(
        );
    }

    public function faq()
    {
        return $this->morphMany('App\Models\FaqQuestionAnswer', 'linkable')->orderBy('display_order', 'ASC')->orderBy('created_at', 'DESC');
    }

    public function featured_image()
    {
    	return $this->belongsTo('App\Models\Media', 'featured_image_id');
    }

    public function banner_image()
    {
    	return $this->belongsTo('App\Models\Media', 'banner_image_id');
    }

    public function og_image()
    {
    	return $this->belongsTo('App\Models\Media', 'og_image_id');
    }

    public function menu()
    {
        return $this->morphOne('App\Models\MenuItem', 'linkable');
    }

    public function created_user()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function updated_user()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }

    public function create_admin_menu()
    {
        $pages = static::where('status', 1)->get();
        $html = '';
        foreach ($pages as $key => $item) {
            $html .= '<div class="checkbox"><input type="checkbox" name="frontend_pages_links[]" class="frontend_pages_links" value="frontend_pages_link-'.$item->id.'" data-id="'.$item->id.'" data-name="'.$item->name.'" id="frontend_pages-'.$item->id.'"> <label for="frontend_pages-'.$item->id.'">'.$item->name.'</label></div>';
        }
        return $html;
    }
}

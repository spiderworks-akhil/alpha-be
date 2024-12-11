<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\SoftDeletes;

class TopRanker extends Model
{
    // use SoftDeletes;

    protected $table = 'top_rankers';

    protected $guarded = ['id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['created_at','updated_at'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function getContentAttribute($value)
    {
            $content = json_decode($value);
            $output = collect($content)->map(function($item, $key){

                if (strpos($key, 'media_id') !== false) {
                    if($item)
                        return Media::find((int)$item);
                    else
                        return $item;
                }
                else
                   return $item;

            });

            return $output;


    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable  = ['id', 'name', 'description', 'unit', 'active'];
    public $timestamps = false;

    public function good()
    {
        return $this->belongsTo('App\Good');
    }

    public function scopeFilter($query, $keyword = null)
    {
        $keyword = request('keyword', $keyword);
        if ($keyword) {
            $query->where('id', 'LIKE', '%'.$keyword.'%')
                ->orWhere('name', 'LIKE', '%'.$keyword.'%')
                ->orWhere('description', 'LIKE', '%'.$keyword.'%')
                ->orWhere('unit', 'LIKE', '%'.$keyword.'%');
        }
        return $query;
    }
}

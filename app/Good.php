<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable  = ['id', 'koperasi_id', 'category_id', 'price', 'active'];

    protected $appends = ['stock'];

    public function getStockAttribute()
    {
        return $this->hasMany('App\Stock')->sum('value');
    }

	public function koperasi()
    {
        return $this->belongsTo('App\Koperasi');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function stocks()
    {
        return $this->hasMany('App\Stock');
    }

    public function scopeFilter($query, $keyword = null)
    {
        $keyword = request('keyword', $keyword);
        if ($keyword) {
            $query->where('id', 'LIKE', '%'.$keyword.'%')
                ->orWhere('email', 'LIKE', '%'.$keyword.'%')
                ->orWhere('name', 'LIKE', '%'.$keyword.'%');
        }
        return $query;
    }
}

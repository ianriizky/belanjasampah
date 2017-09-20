<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{	
	protected $fillable  = ['id', 'user_id', 'name', 'address', 'description', 'order_number', 'active'];
	public $incrementing = FALSE;

    protected $appends = ['picture'];

    public function getPictureAttribute()
    {
        return asset('img/logo-bank-sampah.ico');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function customers()
    {
    	return $this->hasMany('App\Customer');
    }

    public function transactions()
    {
        return $this->hasManyThrough('App\Transaction', 'App\Customer');
    }

    public function scopeFilter($query, $keyword = null)
    {
        $keyword = request('keyword', $keyword);
        if ($keyword) {
            $query->where('id', 'LIKE', '%'.$keyword.'%')
                ->orWhere('user_id', 'LIKE', '%'.$keyword.'%')
                ->orWhere('name', 'LIKE', '%'.$keyword.'%')
                ->orWhere('address', 'LIKE', '%'.$keyword.'%');
        }
        return $query;
    }
}

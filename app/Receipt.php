<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable  = ['id', 'customer_id'];

    protected $appends = ['total'];

    public function getTotalAttribute()
    {
        return $this->hasMany('App\Detailreceipt')->sum('dtotal');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function koperasi()
    {
        return $this->belongsTo('App\Koperasi');
    }

    public function detailreceipts()
    {
    	return $this->hasOne('App\Detailreceipt');
    }

    public function scopeFilter($query, $keyword = null)
    {
        $keyword = request('keyword', $keyword);
        if ($keyword) {
            $query->where('id', 'LIKE', '%'.$keyword.'%')
                ->orWhere('code_id', 'LIKE', '%'.$keyword.'%')
                ->orWhere('customer_id', 'LIKE', '%'.$keyword.'%');
        }
        return $query;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailreceipt extends Model
{
    protected $fillable  = ['id', 'receipt_id', 'good_id', 'damount', 'dprice', 'dtotal'];
    public $timestamps = false;

    public function setDtotalAttribute()
    {
        $this->attributes['dtotal'] = $this->attributes['damount'] * $this->attributes['dprice'];
    }

    public function receipt()
    {
        return $this->belongsTo('App\Receipt');
    }

    public function good()
    {
        return $this->belongsTo('App\Good');
    }

    public function scopeFilter($query, $keyword = null)
    {
        // $keyword = request('keyword', $keyword);
        // if ($keyword) {
        //     $query->where('id', 'LIKE', '%'.$keyword.'%')
        //         ->orWhere('code_id', 'LIKE', '%'.$keyword.'%')
        //         ->orWhere('customer_id', 'LIKE', '%'.$keyword.'%');
        // }
        return $query;
    }
}

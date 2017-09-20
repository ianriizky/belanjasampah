<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable  = ['id', 'code_id', 'customer_id', 'value', 'order_number'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function code()
    {
    	return $this->belongsTo('App\Code');
    }

    public function scopeFilter($query, $keyword = null, $date = null)
    {
        $keyword = request('keyword', $keyword);
        $date = request('date', $date);
        $testDate = date_create($date);
        if ($keyword) {
            $query->where('id', 'LIKE', '%'.$keyword.'%');
        }
        if ($date) {
            $query->whereDate('created_at', date_format($testDate, 'Y-m-d'));
        }        
        return $query;
    }
}

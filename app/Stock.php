<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable  = ['id', 'good_id', 'value'];

    public function good()
    {
        return $this->belongsTo('App\Good');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
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

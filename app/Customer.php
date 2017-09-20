<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable  = ['id', 'user_id', 'bank_id', 'family_member', 'active'];

    protected $appends = ['balance'];

    public function getBalanceAttribute()
    {
        return $this->hasMany('App\Transaction')->sum('value');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function bank()
    {
    	return $this->belongsTo('App\Bank');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function scopeFilter($query, $keyword = null)
    {
        $keyword = request('keyword', $keyword);
        if ($keyword) {
            $query->where('id', 'LIKE', '%'.$keyword.'%')
                ->orWhere('user_id', 'LIKE', '%'.$keyword.'%')
                ->orWhere('bank_id', 'LIKE', '%'.$keyword.'%');
        }
        return $query;
    }
}

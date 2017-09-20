<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $fillable  = ['id', 'name', 'description', 'active'];
    public $timestamps = false;

    public function transaction()
    {
        return $this->hasOne('App\Transaction');
    }

    public function scopeFilter($query, $keyword = null)
    {
        $keyword = request('keyword', $keyword);
        if ($keyword) {
            $query->where('id', 'LIKE', '%'.$keyword.'%')
                ->orWhere('name', 'LIKE', '%'.$keyword.'%')
                ->orWhere('description', 'LIKE', '%'.$keyword.'%');
        }
        return $query;
    }
}

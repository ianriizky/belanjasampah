<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Creativeorange\Gravatar\Facades\Gravatar;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    public $incrementing = FALSE;

    protected $fillable = [
        'id', 'email', 'name', 'address', 'phone_number', 'gender', 'birth_date', 'password', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['picture'];

    public function getPictureAttribute()
    {
        if (isset($this->attributes['email'])) {
            return Gravatar::get($this->attributes['email']);
        }
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function koperasi()
    {
        return $this->hasOne('App\Koperasi');
    }

    public function bank()
    {
        return $this->hasOne('App\Bank');
    }

    public function customer()
    {
        return $this->hasOne('App\Customer');
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
                ->orWhere('email', 'LIKE', '%'.$keyword.'%')
                ->orWhere('name', 'LIKE', '%'.$keyword.'%');
        }
        return $query;
    }
}
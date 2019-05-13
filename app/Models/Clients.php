<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Clients extends Model
{
    use SoftDeletes, EntrustUserTrait {
    SoftDeletes::restore insteadof EntrustUserTrait;
    EntrustUserTrait::restore insteadof SoftDeletes;
    }

    const CLIENT_STATUS_ENABLE  = 1;
    const CLIENT_STATUS_DISABLE   = 0;

    public $timestamps    = true;

    protected $table    = 'clients';

    protected $fillable = [  
        'name',
        'email',
        'credits',
        'token',
        'status',
    ];

    protected $hidden = [
      
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function scopeSearchByString($query, $field, $column_name)
    {
        if (request()->has($field)) {
            return $query->where($column_name, 'LIKE', '%' . request()->get($field) . '%');
        }
    }

    public function sms_history()
    {
        return $this->hasMany(SmsHistory::class, 'client_id','id');
    }
}

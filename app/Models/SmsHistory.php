<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsHistory extends Model
{

    public $timestamps    = true;

    protected $table    = 'sms_histories';

    protected $fillable = [
        'phone_number',
        'sms_text',
        'send_status',
        'send_message',
        'send_desc',
        'phone_sender',
        'provider',
        'tag1',
        'tag2',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public function client()
    {
        return $this->belongsTo(Clients::class,'client_id','id');
    }

    public function scopeSearchByString($query, $field, $column_name)
    {
        if (request()->has($field)) {
            return $query->where($column_name, 'LIKE', '%' . request()->get($field) . '%');
        }
    }
    public function scopeSearchByDate($query, $created_startdate , $created_finishdate, $column_name)
    {
        
        
        if (request()->has($created_startdate) && request()->has($created_finishdate)) {  
            return $query->whereBetween('created_at', array(request()->get($created_startdate), request()->get($created_finishdate))) ;
        }

        if (request()->has($created_startdate)) {
            return $query->where($column_name, '>=',  request()->get( $created_startdate) );
        }

        if (request()->has($created_finishdate)) {
            return $query->where($column_name, '<=',  request()->get( $created_finishdate) );
        }

    }
    public function scopeSearchByNumber($query, $field, $column_name)
    {
        if (request()->has($field)) {
            return $query->where($column_name,  request()->get($field));
        }
    }
}

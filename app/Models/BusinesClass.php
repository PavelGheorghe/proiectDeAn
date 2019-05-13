<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinesClass extends Model
{
    public $timestamps = true;

    protected $table = 'bussines_classes';

    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function risk()
    {
        return $this->hasMany(Risks::class, 'bussines_classes_id');
    }
}

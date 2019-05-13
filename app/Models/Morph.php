<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Morph extends Model
{
    public $timestamps = false;
	protected $table = 'morphs';
	protected $fillable = ['name','model'];

	public static function getMorphByMorphed($morphed)
	{
		return Morph::firstOrCreate(['name' => get_class($morphed),'model' => strtolower(class_basename($morphed))]);
	}
}

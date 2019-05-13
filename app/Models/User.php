<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable {

	use SoftDeletes, EntrustUserTrait {
		SoftDeletes::restore insteadof EntrustUserTrait;
		EntrustUserTrait::restore insteadof SoftDeletes;
	}

	const USER_STATUS_UNACTIVE  = 0;
	const USER_STATUS_ACTIVE    = 1;

	public $timestamps	= true;

	protected $table	= 'users';

	protected $fillable = [
		'facebook_id',
		'first_name',
		'last_name',
		'password',
		'phone',
		'email',
		'status',
		'company_id',
		'remember_token',
		'type_company',
		'company'
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	const TPAA 			= 1;
	const COMPANIES 	= 2;
	const LONDONBROKERS = 3;
	const COVERHOLDERS 	= 4;
	const EXPERT 		= 5;


	public function scopeSearchByString($query, $field, $column_name)
    {
        if (request()->has($field)) {
            return $query->where($column_name, 'LIKE', '%'.request()->get($field).'%');
        }
    }

    public function scopeSearchByRoles($query, $field)
    {
        if (request()->has($field)) {
			$role_id = request()->get($field);
            return $query->whereHas('roles', function ($query) use($role_id) {
				$query->where('id', '=', $role_id );
			});
        }
    }

}

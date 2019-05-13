<?php 
namespace App\Models;

use Illuminate\Support\Facades\Validator;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    public $timestamps = true;
    protected $table = 'permissions';
    protected $fillable = ['name', 'display_name', 'description', 'group_criteria'];
    protected $dates = ['created_at', 'updated_at'];

    public static function boot()
    {
    }
}

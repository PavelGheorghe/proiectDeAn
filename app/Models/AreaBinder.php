<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class AreaBinder extends Model
{
    protected $fillable = [
        'label',
        'is_main',
        'placement_type',
        'umr',
        'agreement_nr',
        'section_nr',
        'inception_date',
        'expiration_date',
        'competence',
        'year_of_account',
        'insurance_type',
        'delegated_authority',
        'agreed_tpa_fee',
        'tpa_invoicing_method_opening',
        'tpa_invoicing_method_closing',
        'note'
    ];
    
    protected $dates = [
        'inception_date',
        'expiration_date',
    ];
    /**
     * Constants
    */

    const IS_MAIN_NO                                = 0;
    const IS_MAIN_YES                               = 1;
    
    const PLACEMENT_TYPE_FACULTATIVE                = 0;
    const PLACEMENT_TYPE_BINDER                     = 1;

    const COMPANY_ROLE_LEADER                       = 0;
    const COMPANY_ROLE_SECOND_LEADER                = 1;
    const COMPANY_ROLE_FOLLOWER                     = 2;

    const COMPETENCE_LONDRA                         = 0;
    const COMPETENCE_BRUXELLES                      = 1;

    const INSURANCE_TYPE_DIRECT                     = 0;
    const INSURANCE_TYPE_FACULTATIVE_REINSURANCE    = 1;
    const INSURANCE_TYPE_TREATY_REINSURANCE         = 2;
    const INSURANCE_TYPE_EXCESS_OF_LOSS             = 3;
    
    /**
     * Constant related operations
     */
    public static function getMainConstants()
    {
        return [
            self::IS_MAIN_NO,
            self::IS_MAIN_YES
        ];
    }
    public static function getMainsToString()
    {
        return [
            self::IS_MAIN_NO => 'No',
            self::IS_MAIN_YES => 'Yes'
        ];
    }

    public static function getPlacementTypesConstants()
    {
        return [
            self::PLACEMENT_TYPE_FACULTATIVE,
            self::PLACEMENT_TYPE_BINDER
        ];
    }

    public static function getPlacementTypesToString()
    {
        return [
            self::PLACEMENT_TYPE_FACULTATIVE => 'Facultative',
            self::PLACEMENT_TYPE_BINDER => 'Binder/CAA'
        ];
    }

    public static function getCompetenceConstants()
    {
        return [
            self::COMPETENCE_LONDRA,
            self::COMPETENCE_BRUXELLES
        ];
    }
    public static function getCompetenceToString()
    {
        return [
            self::COMPETENCE_LONDRA => 'Londra',
            self::COMPETENCE_BRUXELLES => 'Bruxelle'
        ];
    }

    public static function getInsuranceTypesConstants()
    {
        return [
            self::INSURANCE_TYPE_DIRECT ,
            self::INSURANCE_TYPE_FACULTATIVE_REINSURANCE ,
            self::INSURANCE_TYPE_TREATY_REINSURANCE ,
            self::INSURANCE_TYPE_EXCESS_OF_LOSS ,
        ];
    }

    public static function getInsuranceTypesToString()
    {
        return [
            self::INSURANCE_TYPE_DIRECT => 'Direct',
            self::INSURANCE_TYPE_FACULTATIVE_REINSURANCE => 'Facultative Reinsurance',
            self::INSURANCE_TYPE_TREATY_REINSURANCE => 'Treaty Reinsurance',
            self::INSURANCE_TYPE_EXCESS_OF_LOSS => 'Excess of Loss',
        ];
    }

    public static function getCompanyRolesToString()
    {
        return [
            self::COMPANY_ROLE_LEADER          => 'Leader',
            self::COMPANY_ROLE_SECOND_LEADER   => 'Second Leader',
            self::COMPANY_ROLE_FOLLOWER        => 'Follower',
        ];
    }


    /**
     * Relations
     */

    public function mainBinder()
    {
        return $this->belongsTo(self::class, 'group_id');
    }

    public function binders()
    {
        return $this->hasMany(self::class, 'group_id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class)->withPivot(['company_role', 'company_quota']);
    }

    public function company_leader()
    {
        return $this->belongsToMany(Company::class)->wherePivot('company_role', self::COMPANY_ROLE_LEADER);
    }

    public function london_broker()
    {
        return $this->belongsTo(LondonBroker::class);
    }
    
    public function coverholder()
    {
        return $this->belongsTo(Coverholder::class);
    }

    public function risk()
    {
        return $this->belongsTo(Risks::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * Model Accessors
    */

    public function getIsMainToStringAttribute()
    {
        return self::getMainsToString()[$this->is_main];
    }

    public function getPlacementTypeToStringAttribute()
    {
        return self::getPlacementTypesToString()[$this->placement_type];
    }

    public function getInsuranceTypeToStringAttribute()
    {
        return self::getInsuranceTypesToString()[$this->insurance_type];
    }

    /**
     * Scopes
    */

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }
}

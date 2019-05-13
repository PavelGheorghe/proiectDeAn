<?php
namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use App\Models\AreaBinder;
use Carbon\Carbon;

class AreaBinderFilter extends QueryFilter
{
    public function id($id)
    {
        $this->builder->where('area_binders.id', $id);
    }

    public function label($label)
    {
        $this->builder->where('label', 'like', "%{$label}%");
    }

    public function isMain($is_main)
    {
        $this->builder->where('is_main', AreaBinder::IS_MAIN_YES);
    }

    public function groupId($group_id)
    {
        $this->builder->where('group_id', $group_id);
    }

    public function umrAgreementNr($umr_agreement_nr)
    {
        $this->builder
        ->where('umr', 'like', "%{$umr_agreement_nr}%")
        ->orWhere('agreement_nr', 'like', "%{$umr_agreement_nr}%");
    }

    public function inceptionDate($date)
    {
        $this->builder->whereDate('inception_date', '=', Carbon::createFromFormat(config('date.default_format'), $date)->toDateString());
    }

    public function expirationDate($date)
    {
        $this->builder->whereDate('expiration_date', '=', Carbon::createFromFormat(config('date.default_format'), $date)->toDateString());
    }
    
    public function companyId($company_id)
    {
        $this->builder->whereHas('companies', function ($query) use ($company_id) {
            return $query->where('id', $company_id);
        });
    }

    public function companyRole($company_role)
    {
        $this->builder->whereHas('companies', function ($query) use ($company_role) {
            return $query->where('company_role', $company_role);
        });
    }

    public function insuranceType($insurance_type)
    {
        $this->builder->where('insurance_type', $insurance_type);
    }

    public function agreedTpaFee($agreed_tpa_fee)
    {
        $this->builder->where('agreed_tpa_fee', '=', $agreed_tpa_fee);
    }

    public function tpaInvoicingMethodOpening($value)
    {
        $this->builder->where('tpa_invoicing_method_opening', '=', $value);
    }

    public function tpaInvoicingMethodClosing($value)
    {
        $this->builder->where('tpa_invoicing_method_closing', '=', $value);
    }

    public function yearOfAccount($value)
    {
        $this->builder->where('year_of_account', '=', $value);
    }

    public function londonBrokerId($id)
    {
        $this->builder->where('london_broker_id', $id);
    }

    public function riskCode($risk_code)
    {
        $this->builder->whereHas('risk', function ($query) use ($risk_code) {
            return $query->where('risk_code', 'like', "%{$risk_code}%");
        });
    }

    public function riskCodeDescription($risk_code_description)
    {
        $this->builder->whereHas('risk', function ($query) use ($risk_code_description) {
            return $query->where('description', 'like', "%{$risk_code_description}%");
        });
    }

    public function riskClassOfBusiness($risk_class_of_business)
    {
        $this->builder->whereHas('risk', function ($query) use ($risk_class_of_business) {
            return $query->where('class_of_business', 'like', "%{$risk_class_of_business}%");
        });
    }
}

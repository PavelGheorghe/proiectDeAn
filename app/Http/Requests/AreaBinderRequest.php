<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AreaBinder;
use App\Models\LondonBroker;
use App\Models\Coverholder;
use App\Models\Risks;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator as CustomValidator;
use Validator;
use Illuminate\Auth\Access\AuthorizationException;

class AreaBinderRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Validation Extensions
        Validator::extend('array_length_min', function ($attribute, $value, $parameters, $validator) {
            return count(array_filter($value, function ($var) use ($parameters) {
                return ($var && $var >= $parameters[0]);
            }));
        });
        Validator::extend('number_of_leaders', function ($attribute, $value, $parameters, $validator) {
            return count(array_filter($value, function ($number) {
                return $number == AreaBinder::COMPANY_ROLE_LEADER;
            })) == $parameters[0];
        });
        Validator::extend('total_quota', function ($attribute, $value, $parameters, $validator) {
            return array_reduce($value, function ($accumulator, $current) {
                return $accumulator+=$current;
            }) == $parameters[0];
        });
        Validator::extend('tpa_sum', function ($attribute, $value, $parameters, $validator) {
            // Parameter 1 will be the sum number, parameter 0 will be the field value
            return $value + $parameters[0] == $parameters[1];
        });

        // Validation Placeholder Messages
        Validator::replacer('array_length_min', function ($message, $attribute, $rule, $parameters) {
            str_replace(':value', $parameters[0], $message);
        });
        
        Validator::replacer('number_of_leaders', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':value', $parameters[0], $message);
        });
        
        Validator::replacer('total_quota', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':value', $parameters[0], $message);
        });
        
        Validator::replacer('tpa_sum', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':value', $parameters[1], $message);
        });
        
        return [
            'label' => 'required',
            'group_id' => 'sometimes',
            'section_nr' => 'required',
            'placement_type' => 'required',
            'inception_date' => 'required|date_format:'.config('date.default_format'),
            'expiration_date' => 'required|date_format:'.config('date.default_format'),
            'company.id' => 'required|array_length_min:1',
            'company.role' => 'required|number_of_leaders:1',
            'company.quota' => 'required|total_quota:100',
            'competence' => 'required',
            'year_of_account' => 'required|digits:4',
            'broker_reference' => 'required',
            'coverholder' => 'required',
            'risk_code' => 'required',
            'insurance_type' => 'required',
            'delegated_authority' => 'required|numeric',
            'agreed_tpa_fee' => 'required|numeric',
            'tpa_invoicing_method_opening' => 'required_with:tpa_invoicing_method_closing|numeric|min:1|max:100|tpa_sum:'. $this->get('tpa_invoicing_method_closing') . ',100',
            'tpa_invoicing_method_closing' => 'required_with:tpa_invoicing_method_opening|numeric|min:1|max:100|tpa_sum:'. $this->get('tpa_invoicing_method_opening') . ',100',
            'upload_file' => 'max:11000'
        ];
    }

    /**
     * Override default methods to send custom response
     */
    protected function failedAuthorization()
    {
        throw new AuthorizationException(trans('lang.action_forbidden', [
            'action' => trans('lang.edit'),
            'target' => trans('lang.area_binder')
        ]));
    }

    protected function failedValidation(CustomValidator $validator)
    {
        throw new ValidationException($validator, response()->json($validator->errors()->all(), 422));
    }
}

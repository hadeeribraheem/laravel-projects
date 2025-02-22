<?php

namespace App\Http\Requests;

use App\Actions\HandleRulesValidation;
use Illuminate\Foundation\Http\FormRequest;

class ColleagueFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $arr = [
            'government_id' => 'required|exists:governments,id',
            'years_ids.*' => 'required|exists:years,id', // [[ id=>1,year_id=>2 ]]
            /*'years_ids' => 'required|array', // [[ id=>1,year_id=>2 ]]
            'years_ids.*.id' => 'filled',
            'years_ids.*.year_id' => 'required|exists:years,id',*/
        ];

        $arr_lang = ['name:required', 'info:nullable'];

        return HandleRulesValidation::handle($arr, $arr_lang);
    }
    public function attributes()
    {
        //dd('test');

        return [

            'government_id' => __('keywords.government'),
            'ar_name' => __('keywords.ar_name'),
            'en_name' => __('keywords.en_name'),
            'ar_info' => __('keywords.ar_info'),
            'en_info' => __('keywords.en_info'),
        ];
    }
}

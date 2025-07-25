<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
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
        return [
            'customerId' => ['required', 'numeric'],
            'officeId' => ['required', 'numeric'],
            'date.*' => ['required', 'date'],
            'transportKm' => ['required', 'numeric'],
            'transportTime' => ['required', 'numeric'],
            'technikId.*' => ['required', 'numeric'],
            'startTime.*' => [
                'required',
                'regex:/^([01]\d|2[0-3]):([0-5]\d)$/',
            ],
            'finishTime.*' => [
                'required',
                'regex:/^([01]\d|2[0-3]):([0-5]\d)$/',
            ],
            'description' => ['required', 'string'],
            'descriptionResult' => ['required', 'string'],
            /* 'typeDevice' => ['required', 'string', 'max:255'],
            'snDevice' => ['required', 'string', 'max:255'],
            'coolant' => ['required', 'string', 'max:255'],
            'newCoolant' => ['required', 'numeric'],
            'oldCoolant' => ['required', 'numeric'],
            'oil' => ['required', 'string', 'max:255'],
            'newOil' => ['required', 'numeric'],
            'oldOil' => ['required', 'numeric'],
            'nameSparePart.*' => ['required', 'string', 'max:255'],
            'quantitySparePart.*' => ['required', 'numeric'],
            'noteSparePart.*' => ['required', 'string', 'max:255'], */
            'mainTech' => ['required', 'string', 'max:255'],
            'nameCustomerSign' => ['required', 'string', 'max:255'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FolderRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'filePassport'=>'required|mimes:pdf, doc',
            //'gender'=>'string',
            //'residenceStatus'=>'string',
            'university'=>'string',
            'city'=>'required|string',
            'address'=>'required|string',
            'phone'=>'required|string',
            'profession'=>'string',
            'job'=>'string',
            'company'=>'string',
            'civilStatus'=>'string',
            'nbChildren'=>'numric',

            'firstNameReferent'=>'string',
            'lastNameReferent'=>'string',
            'emailReferent'=>'string',
            'phoneReferent'=>'string',
            'familyConnection'=>'string',
            //
        ];
    }
}

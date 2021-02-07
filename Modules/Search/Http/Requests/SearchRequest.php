<?php

namespace Modules\Search\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sort' => 'nullable|string|in:stars,forks',
            'order' => 'nullable|string|in:desc,asc',
            'per_page' => 'integer|in:10,50,100',
            'date' => 'required|date|date_format:Y-m-d',
            'language' => 'string'
        ];
    }
    
}

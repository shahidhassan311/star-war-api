<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MovieUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required',
            'overview' => 'sometimes|required',
            'release_date' => 'sometimes|required|date',
            'popularity' => 'sometimes|required|numeric',
            'vote_average' => 'sometimes|required|numeric',
            'vote_count' => 'sometimes|required|numeric',
            'original_language' => 'sometimes|required',
            'poster_path' => 'sometimes|required',
            'backdrop_path' => 'sometimes|required',
            'adult' => 'sometimes|required|boolean',
            'video' => 'sometimes|required|boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'overview.required' => 'The overview field is required.',
            'release_date.required' => 'The release date field is required.',
            'release_date.date' => 'Please enter a valid date for the release date.',
            'popularity.required' => 'The popularity field is required.',
            'popularity.numeric' => 'The popularity must be a number.',
            'vote_average.required' => 'The vote average field is required.',
            'vote_average.numeric' => 'The vote average must be a number.',
            'vote_count.required' => 'The vote count field is required.',
            'vote_count.numeric' => 'The vote count must be a number.',
            'original_language.required' => 'The original language field is required.',
            'poster_path.required' => 'The poster path field is required.',
            'backdrop_path.required' => 'The backdrop path field is required.',
            'adult.required' => 'The adult field is required.',
            'adult.boolean' => 'The adult field must be boolean (true/false).',
            'video.required' => 'The video field is required.',
            'video.boolean' => 'The video field must be boolean (true/false).',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors(),
        ], 422));
    }
}

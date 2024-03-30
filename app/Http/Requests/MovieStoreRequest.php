<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MovieStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s]+$/',
            'overview' => ['required', 'string', 'max:500', 'regex:/^[a-zA-Z0-9\s!@#$%^&*()_+|~=`{}\[\]:;"\',.<>?\/-]+$/'],
            'release_date' => 'required|date',
            'popularity' => 'required|numeric',
            'vote_average' => 'required|numeric',
            'vote_count' => 'required|numeric',
            'original_language' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',
            'poster_path' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s!@#$%^&*()_+|~=`{}\[\]:;"\',.<>?\/-]+$/'],
            'backdrop_path' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s!@#$%^&*()_+|~=`{}\[\]:;"\',.<>?\/-]+$/'],
            'adult' => 'required|boolean',
            'video' => 'required|boolean',
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
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than :max characters.',
            'title.regex' => 'The title must only contain letters, numbers, and spaces.',
            'overview.required' => 'The overview field is required.',
            'overview.string' => 'The overview must be a string.',
            'overview.max' => 'The overview may not be greater than :max characters.',
            'overview.regex' => 'The overview must only contain letters, numbers, and spaces.',
            'release_date.required' => 'The release date field is required.',
            'release_date.date' => 'Please enter a valid date for the release date.',
            'popularity.required' => 'The popularity field is required.',
            'popularity.numeric' => 'The popularity must be a number.',
            'vote_average.required' => 'The vote average field is required.',
            'vote_average.numeric' => 'The vote average must be a number.',
            'vote_count.required' => 'The vote count field is required.',
            'vote_count.numeric' => 'The vote count must be a number.',
            'original_language.required' => 'The original language field is required.',
            'original_language.string' => 'The original language must be a string.',
            'original_language.max' => 'The original language may not be greater than :max characters.',
            'original_language.regex' => 'The original language must only contain letters and spaces.',
            'poster_path.required' => 'The poster path field is required.',
            'poster_path.string' => 'The poster path must be a string.',
            'poster_path.max' => 'The poster path may not be greater than :max characters.',
            'poster_path.regex' => 'The poster path must only contain letters, numbers, forward slashes, and spaces.',
            'backdrop_path.required' => 'The backdrop path field is required.',
            'backdrop_path.string' => 'The backdrop path must be a string.',
            'backdrop_path.max' => 'The backdrop path may not be greater than :max characters.',
            'backdrop_path.regex' => 'The backdrop path must only contain letters, numbers, forward slashes, and spaces.',
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

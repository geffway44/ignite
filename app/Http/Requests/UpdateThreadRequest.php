<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateThreadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('thread'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'min:3'],
            'body' => ['required', 'min:3', 'spamfree'],
            'channel_id' => [
                'required',
                Rule::exists('channels', 'id')->where(function ($query) {
                    $query->where('archived', false);
                }),
            ],
        ];
    }
}

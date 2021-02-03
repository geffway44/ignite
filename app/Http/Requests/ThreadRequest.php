<?php

namespace App\Http\Requests;

use App\Models\Channel;
use Illuminate\Foundation\Http\FormRequest;
use Cratespace\Citadel\Http\Requests\Concerns\AuthorizesRequests;
use Cratespace\Citadel\Http\Requests\Traits\InputValidationRules;

class ThreadRequest extends FormRequest
{
    use AuthorizesRequests;
    use InputValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($thread = $this->route('thread')) {
            return $this->isAllowed('manage', $thread);
        }

        return $this->isAuthenticated();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() === 'DELETE') {
            return [];
        }

        return $this->getRulesFor('threads');
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $channel = $this->route('channel');

        if ($channel && is_null($this->channel_id) && $this->method() !== 'DELETE') {
            $this->merge([
                'channel_id' => Channel::whereSlug($channel)->first()->id,
            ]);
        }
    }
}

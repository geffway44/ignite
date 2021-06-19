<?php

namespace App\Http\Requests;

use Emberfuse\Scorch\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class ThreadRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if ($thread = $this->route('thread')) {
            return $this->isAllowed('manage', $thread, false);
        }

        return $this->isAuthenticated();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return $this->getRulesFor('thread');
    }
}

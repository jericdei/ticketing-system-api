<?php

namespace App\Http\Requests\Tickets;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'subject' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'is_follow_up' => ['boolean'],
            'client_name' => ['string'],
            'client_email' => ['string'],
            'client_phone' => ['integer'],
            'with_email' => ['boolean'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'type_id' => ['required', 'integer', 'exists:ticket_types,id'],
            'status_id' => ['required', 'integer', 'exists:ticket_statuses,id'],
            'priority_id' => ['required', 'integer', 'exists:ticket_priorities,id'],
            'concern_id' => ['required', 'integer', 'exists:ticket_concerns,id'],
            'status_updated_at' => ['date'],
            'resolved_at' => ['date']
        ];
    }
}

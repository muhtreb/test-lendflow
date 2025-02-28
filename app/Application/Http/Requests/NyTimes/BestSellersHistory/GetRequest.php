<?php

namespace App\Application\Http\Requests\NyTimes\BestSellersHistory;

use App\Application\Rules\NyTimesIsbnRule;
use App\Application\Rules\NyTimesOffsetRule;
use Illuminate\Foundation\Http\FormRequest;

class GetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'nullable|string|min:1|max:255',
            'offset' => ['nullable', 'integer', 'min:0', 'max:1000', new NyTimesOffsetRule()],
            'isbn' => ['nullable', 'string', new NyTimesIsbnRule()],
            'author' => 'nullable|string|min:1|max:255',
        ];
    }
}

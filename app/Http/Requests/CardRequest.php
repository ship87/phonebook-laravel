<?php

namespace App\Http\Requests;

use App\Models\Card;
use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:' . Card::MIN_LENGTH_NAME,
                'max:' . Card::MAX_LENGTH_NAME,
            ],
            'image' => [
                'nullable',
                'file',
                'mimes:jpg,png',
            ],
            'short_description' => [
                'nullable',
                'max:' . Card::MAX_LENGTH_SHORT_DESCRIPTION,
            ],
            'phone' => [
                'required',
                'regex:/^(\+7|7|8)?[\-]?\(?[0-9]{3}\)?[\-]?[0-9]{3}[\-]?[0-9]{2}[\-]?[0-9]{2}$/u',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.min' => 'Количество символов в поле "Имя" должно быть не менее :min',
            'name.max' => 'Количество символов в поле "Имя" должно быть не более :max',
            'name.required' => 'Поле "Имя" обязательно для заполнения',
            'image.mimes' => 'Выберите "Изображение" корректного формата',
            'phone.required' => 'Поле "Телефон" обязательно для заполнения',
            'phone.regex' => 'Поле "Телефон" некорректно заполнено',
            'short_description.max' => 'Количество символов в поле "Краткое описание" должно быть не более :max',
        ];
    }
}

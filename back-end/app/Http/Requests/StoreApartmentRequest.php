<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'apartment_type_id' => 'required|exists:apartment_types,id',
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0',
            'rooms' => 'required|integer|min:1',
            'beds' => 'required|integer|min:1',
            'bathrooms' => 'required|integer|min:1',
            'square_meters' => 'nullable|integer|min:0',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'nullable|string',
            'visible' => 'nullable|boolean',
            'slug' => 'required|string|unique:apartments,slug',
        ];
    }
}

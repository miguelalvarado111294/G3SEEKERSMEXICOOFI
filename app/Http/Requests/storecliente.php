<?php

namespace App\Http\Requests;

use App\Models\Cliente;

use Illuminate\Foundation\Http\FormRequest;

class storecliente extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $cliente = new Cliente;

        return [

            'nombre' =>                     'nullable|alpha|min:2|max:100',
            'segnombre' =>                  'nullable|alpha',
            'apellidopat' =>                'nullable|alpha|min:3|max:100',
            'apellidomat' =>                'nullable|alpha|min:3|max:100',
            'telefono' =>                   'nullable|numeric|digits:10|unique:clientes,telefono,' . $cliente->id,
            'direccion' =>                  'nullable',
            'email' =>                      'nullable|string|min:2|max:100|unique:clientes,email' . $cliente->id,
            'rfc' =>                        'nullable|alpha_num|min:2|max:100|unique:clientes,rfc'. $cliente->id,
            'actaconstitutiva' =>           'mimes:jpeg,png,jpg,png,pdf|max:5000',
            'consFiscal' =>                 'mimes:jpeg,png,jpg,png,pdf|max:5000',
            'comprDom' =>                   'mimes:jpeg,png,jpg,png,pdf|max:5000',
            'tarjetacirculacion' =>         'mimes:jpeg,png,jpg,png,pdf|max:5000',
            'compPago' =>                   'mimes:jpeg,png,jpg,png,pdf|max:5000'


        ];
    }
}

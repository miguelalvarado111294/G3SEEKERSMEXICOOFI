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
            'nombre' =>                     'required|alpha|min:2|max:100',
            'segnombre' =>                  'nullable|alpha',
            'apellidopat' =>                'required|alpha|min:3|max:100',
            'apellidomat' =>                'required|alpha|min:3|max:100',
            'telefono' =>                   'required|numeric|digits:10|unique:clientes,telefono,' . ($cliente->id ?? 'NULL') . ',id',
            'direccion' =>                  'required|string|max:255',
            'email' =>                      'required|string|email|max:100|unique:clientes,email,' . ($cliente->id ?? 'NULL') . ',id',
            'rfc' =>                        'nullable|alpha_num|min:2|max:13|unique:clientes,rfc,' . ($cliente->id ?? 'NULL') . ',id',
            'actaconstitutiva' =>           'nullable|mimes:jpeg,png,jpg,pdf|max:5000',
            'consFiscal' =>                 'nullable|mimes:jpeg,png,jpg,pdf|max:5000',
            'comprDom' =>                   'nullable|mimes:jpeg,png,jpg,pdf|max:5000',
            'tarjetacirculacion' =>         'nullable|mimes:jpeg,png,jpg,pdf|max:5000',
            'compPago' =>                   'nullable|mimes:jpeg,png,jpg,pdf|max:5000',
        ];
        
    }
}

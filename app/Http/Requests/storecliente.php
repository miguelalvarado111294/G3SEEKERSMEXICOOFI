<?php

namespace App\Http\Requests;
use App\Models\cliente;

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
       $cliente=new Cliente;

return [

            'nombre'=>'required|alpha|min:2|max:100',
            'segnombre'=> 'nullable|alpha',
            'apellidopat'=>'required|alpha|min:2|max:100',
            'apellidomat'=>'required|alpha|min:2|max:100',
            'telefono'=>'required|numeric|digits:10|unique:clientes,telefono,'. $cliente->id,
            'direccion'=>'required',
            'email'=>'required|string|min:2|max:100|email|unique:clientes',
            'rfc'=>'nullable|alpha_num|min:2|max:100|unique:clientes',
            'actaconstitutiva'=>'mimes:pdf,jpeg,png,jpg|max:5000',
            'consFiscal'=>'mimes:pdf,jpeg,png,jpg|max:5000',
            'comprDom'=>'mimes:pdf,jpeg,png,jpg|max:5000',
            'tarjetacirculacion'=>'mimes:pdf,jpeg,png,jpg,pdf|max:5000',
            'compPago'=>'mimes:pdf,jpeg,png,jpg|max:5000'
            //
        ];
    }
}

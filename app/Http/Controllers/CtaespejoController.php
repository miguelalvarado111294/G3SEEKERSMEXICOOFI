<?php

namespace App\Http\Controllers;

use App\Models\Ctaespejo;
use App\Models\Cuenta;
use App\Models\Cliente;
use Illuminate\Http\Request;

class CtaespejoController extends Controller
{
    public function index()
    {
        $ctaespejos = Ctaespejo::paginate(10);
        return view('ctaespejo.index', compact('ctaespejos'));
    }

    public function crearctaespejo($id)
    {
        return view('ctaespejo.createid', compact('id'));
    }

    public function storectaespejo(Request $request, $id)
    {
        $request->validate([
            'usuario' => 'required|alpha_dash|min:3|max:15|unique:ctaespejos,usuario,' . $id,
            'contrasenia' => 'alpha_dash|min:2|max:15|nullable',
            'comentarios' => 'alpha|max:100|nullable',
        ]);

        $datosCliente = $request->except('_token');
        $datosCliente['cuenta_id'] = $id;
        $datosCliente = array_map('strtoupper', $datosCliente);

        Ctaespejo::create($datosCliente);
        return redirect()->route('buscar.ctaespejo', $id);
    }

    public function edit($id)
    {
        $ctaespejo = Ctaespejo::findOrFail($id);
        return view('ctaespejo.edit', compact('ctaespejo'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'usuario' => 'required|alpha_dash|min:3|max:15',
            'contrasenia' => 'required|alpha_dash|max:15|nullable',
            'comentarios' => 'alpha|max:100|nullable',
        ]);
    
        // Encuentra el Ctaespejo y actualiza
        $ctaespejo = Ctaespejo::findOrFail($id);
        $ctaespejo->update($request->except(['_token', '_method']));
    
        // Obtén el cuenta_id del objeto actualizado
        $cuenta_id = $ctaespejo->cuenta_id; // Accede a cuenta_id directamente
    
        return redirect()->route('buscar.ctaespejo', $cuenta_id)->with('success', 'Datos actualizados con éxito.');
    }
    

    public function destroy($id)
    {
        Ctaespejo::destroy($id);
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required|alpha_dash|min:2|max:100',
            'contrasenia' => 'required|alpha_dash|min:2|max:100',
        ]);

        Ctaespejo::create($request->except('_token'));
        return redirect('ctaespejo')->with('mensaje', 'Cuenta agregada exitosamente.');
    }

    public function create()
    {
        $cuentas = Cuenta::all();
        $clientes = Cliente::all();
        return view('ctaespejo.create', compact('cuentas', 'clientes'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ctaespejo;
use Illuminate\Http\Request;
use App\Models\cuenta;
use App\Models\cliente;

class CtaespejoController extends Controller
{
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function index()
    {
        $datos['ctaespejos'] = Ctaespejo::paginate(10);
        return view('ctaespejo.index', $datos);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function crearctaespejo($id)
    {
        return view('ctaespejo.createid', ['id' => $id]);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function storectaespejo(Request $request, $id)
    {
        $cuenta_id = $id;
        $request->validate([
            'usuario' => 'required|alpha_dash|min:3|max:15|unique:ctaespejos,usuario,' . $id,
            'contrasenia' => 'alpha_dash|min:2|max:15',
            'comentarios' => 'alpha|max:100|nullable'
        ]);

        $datosCliente = $request->except('_token');
        $datosCliente['cuenta_id'] = $id;
        $mArray = array_map('strtoupper', $datosCliente);
        Ctaespejo::insert($mArray);
        return redirect()->route('buscar.ctaespejo', $cuenta_id);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function show(ctaespejo $ctaespejo) {}
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function edit($id)
    {
        $ctaespejo = Ctaespejo::find($id);
        return view('ctaespejo.edit', compact('ctaespejo'));
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function update(Request $request, $id)
    {
       //return $request;
        $request->validate([
            'usuario' => 'required|alpha_dash|min:3|max:15',
            'contrasenia' =>  'required|alpha_dash|max:15',
            'comentarios' =>  'alpha|max:100|nullable'
        ]);
        $datosctaespejo = $request->except(['_token', '_method']);
        Ctaespejo::where('id', '=', $id)->update($datosctaespejo);
        $ctaespejo = ctaespejo::findOrFail($id);
        return redirect()->route('buscar.ctaespejo', $ctaespejo->id);
/*
        $campos = [
            'usuario' =>        'required|alpha_dash|min:3|max:15',
            'contrasenia' =>    'required|alpha_dash|min:3|max:15',
            'comentarios' =>    'alpha|max:100|nullable'
        ];
        $this->validate($request, $campos);
        $datosctaespejo = $request->except(['_token', '_method']);
        ctaespejo::where('id', '=', $id)->update($datosctaespejo);
        $ctaespejo = ctaespejo::findOrFail($id);
        return redirect()->route('buscar.ctaespejo', $ctaespejo->id);
    */
        //return redirect()->route('cliente.show', $referencia->cliente_id);
   
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function destroy($id)
    {
        Ctaespejo::destroy($id);
        return redirect()->back();
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function store(Request $request)
    {
        $campos = [
            'usuario' => 'required|alpha_dash|min:2|max:100',
            'contrasenia' => 'required|alpha_dash|min:2|max:100'
        ];
        $this->validate($request, $campos/*$mensaje*/);
        $datosctaespejo = $request->except('_token');
        ctaespejo::insert($datosctaespejo);
        return redirect('ctaespejo')->with('mensaje', 'cuenta agregada exitosamente ');
    }
    public function create()
    {
        $cuentas = cuenta::all();
        $clientes = cliente::all();
        return view('ctaespejo.create', compact('cuentas', 'clientes'));
    }
}

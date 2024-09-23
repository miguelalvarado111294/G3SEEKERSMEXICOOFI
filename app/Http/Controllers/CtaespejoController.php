<?php

namespace App\Http\Controllers;

use App\Models\ctaespejo;
use Illuminate\Http\Request;
use App\Models\cuenta;
use App\Models\cliente;

class CtaespejoController extends Controller
{

    public function index()
    {

        $datos['ctaespejos'] = Ctaespejo::paginate(10);
        return view('ctaespejo.index', $datos);
    }

    public function create()
    {
        $cuentas = cuenta::all();
        $clientes = cliente::all();

        return view('ctaespejo.create', compact('cuentas', 'clientes'));
    }

    public function crearctaespejo($id)
    {


        return view('ctaespejo.createid', ['id' => $id]);
    }

    public function storectaespejo(Request $request, $id)
    {

        $ctaespejo = Ctaespejo::create([
            'usuario' => $request->usuario,
            'contrasenia' => $request->contrasenia,
            'comentarios' => $request->comentarios,
            'cuenta_id' => $id
        ]);

        return redirect()->route('buscar.ctaespejo', $ctaespejo->cuenta_id);
    }


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


    public function show(ctaespejo $ctaespejo) {}


    public function edit($id)
    {

        $cuentas = cuenta::all();
        $clientes = cliente::all();
        $ctaespejo = ctaespejo::findORfail($id);
        return view('ctaespejo.edit', compact('cuentas', 'clientes', 'ctaespejo'));
    }


    public function update(Request $request, $id)
    {

        $campos = [
            'usuario' => 'required|alpha_dash|min:2|max:100',
            'contrasenia' => 'required|alpha_dash|min:2|max:100'

        ];

        $this->validate($request, $campos/*$mensaje*/);
        $datosctaespejo = $request->except(['_token', '_method']);

        ctaespejo::where('id', '=', $id)->update($datosctaespejo);
        $ctaespejo = ctaespejo::findOrFail($id);
        return redirect()->route('buscar.ctaespejo', $ctaespejo->id);
    }

    public function destroy($id)
    {
        ctaespejo::destroy($id);
        return redirect()->route('buscar.ctaespejo', $id);
    }
}

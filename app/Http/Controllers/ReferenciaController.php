<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\referencia;
use App\Models\cliente;

class ReferenciaController extends Controller
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function index(Request $request)
    {
        $busqueda = $request->get('busqueda');  //recibe del input de index cliente y lo almacena en una variable 
        $referencias = Referencia::where('nombre', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('segnombre', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('apellidopat', 'LIKE', '%' . $busqueda . '%')             //busqueda 
            ->orWhere('apellidomat', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('telefono', 'LIKE', '%' . $busqueda . '%')->paginate(10);

        return view('referencia.index', compact('referencias', 'busqueda'));
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function crearref($id)
    {
        $cliente = cliente::all();
        return view('referencia.createid', compact('id'));
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function crearr($id)
    {
        $cliente_id = $id;
        return view('registroCliente.datosreferencia', compact('cliente_id'));
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function storef(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|alpha|min:2|max:100',
            'segnombre' => 'nullable|alpha',
            'apellidopat' => 'required|alpha|min:4|max:100',
            'apellidomat' => 'required|alpha|min:4|max:100',
            'telefono' => 'required|numeric|digits:10|unique:referencias,telefono,' . $id,
            'parentesco' => 'required'
        ]);

        $referencia = Referencia::create([
            'nombre' => $request->nombre,
            'segnombre' => $request->segnombre,
            'apellidopat' => $request->apellidopat,
            'apellidomat' => $request->apellidomat,
            'parentesco' => $request->parentesco,
            'telefono' => $request->telefono,
            'cliente_id' => $id
        ]);

        return redirect()->route('cliente.show', $id);
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function createnuevoref(Request $request, $id)
    {
        $cliente_id = $id;

        $request->validate([
            'nombre' => 'required|alpha|min:2|max:100',
            'segnombre' => 'nullable|alpha',
            'apellidopat' => 'required|alpha|min:4|max:100',
            'apellidomat' => 'required|alpha|min:4|max:100',
            'telefono' => 'required|numeric|digits:10|unique:referencias,telefono,' . $id,
            'parentesco' => 'required'
        ]);

        $referencia = Referencia::create([
            'nombre' => $request->nombre,
            'segnombre' => $request->segnombre,
            'apellidopat' => $request->apellidopat,
            'apellidomat' => $request->apellidomat,
            'parentesco' => $request->parentesco,
            'telefono' => $request->telefono,
            'cliente_id' => $cliente_id
        ]);

        return redirect()->route('crear.nuevo.cuenta', $id);
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function edit($id)
    {
        $clientes = Cliente::all();
        $referencia = Referencia::findOrfail($id);
        return view('referencia.edit', compact('referencia', 'clientes'));
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function update(Request $request, $id)
    {
        $referencia_id = $id;
        $request->validate([
            'nombre' => 'required|alpha|min:2|max:100',
            'segnombre' => 'nullable|alpha',
            'apellidopat' => 'required|alpha|min:4|max:100',
            'apellidomat' => 'required|alpha|min:4|max:100',
            'telefono' => 'required|numeric|digits:10',
            'parentesco' => 'required'
        ]);

        $referencia = Referencia::where('id', '=', $referencia_id)->update($request->except(['_token', '_method']));
        $referencia = Referencia::find($referencia_id);
        return redirect()->route('cliente.show', $referencia->cliente_id);
    }

    public function destroy($id)
    {
        $referencia = Referencia::findOrFail($id);
        Referencia::destroy($id);
        return redirect()->route('cliente.show', $referencia->cliente_id);
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|alpha|min:2|max:100',
            'segnombre' => 'nullable|alpha',
            'apellidopat' => 'required|alpha|min:4|max:100',
            'apellidomat' => 'required|alpha|min:4|max:100',
            'telefono' => 'required|numeric|digits:10',
            'parentesco' => 'required'
        ]);

        $datosCliente = $request->except('_token');

        Referencia::create($request->all());
        return redirect('referencia')->with('mensaje', 'Referencia agregado exitosamente ');
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

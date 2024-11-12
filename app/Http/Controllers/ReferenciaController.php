<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Referencia;
use App\Models\Cliente;

class ReferenciaController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->get('busqueda', '');
        $referencias = Referencia::query()
            ->where('nombre', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('segnombre', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('apellidopat', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('apellidomat', 'LIKE', '%' . $busqueda . '%')
            ->orWhere('telefono', 'LIKE', '%' . $busqueda . '%')
            ->paginate(10);

        return view('referencia.index', compact('referencias', 'busqueda'));
    }

    public function crearref($id)
    {
        return view('referencia.createid', compact('id'));
    }

    public function crearr($id)
    {
        $cliente_id=$id;
        return view('registroCliente.datosreferencia', compact('cliente_id'));
    }

    public function storef(Request $request, $id)
    {
        $this->validateReferencia($request, $id);

        Referencia::create($this->referenciaData($request, $id));

        return redirect()->route('cliente.show', $id);
    }

    
    public function createnuevoref(Request $request, $cliente_id)
{
    // Validación de los datos del formulario
    $request->validate([


        'nombre' => 'required|alpha|min:2|max:100',
        'segnombre' => 'nullable|alpha',
        'apellidopat' => 'required|alpha|min:4|max:100',
        'apellidomat' => 'required|alpha|min:4|max:100',
        'telefono' => 'required|numeric|digits:10|unique:referencias,telefono',
        'parentesco' => 'required',


    ]);

    // Crear la referencia
    $referencia = new Referencia([
        'nombre' => $request->nombre,
        'segnombre' => $request->segnombre,
        'apellidopat' => $request->apellidopat,
        'apellidomat' => $request->apellidomat,
        'telefono' => $request->telefono,
        'parentesco' => $request->parentesco,
        'cliente_id' => $cliente_id,
    ]);

    $referencia->save();

    // Redirigir con mensaje de éxito
    return redirect()->route('crear.nuevo.ref', $cliente_id)->with('mensaje', 'Referencia registrada con éxito!');
}


    public function edit($id)
    {
        $clientes = Cliente::all();
        $referencia = Referencia::findOrFail($id);
        return view('referencia.edit', compact('referencia', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $this->validateUpdate($request);

        Referencia::where('id', $id)->update($request->except(['_token', '_method']));

        return redirect()->route('cliente.show', Referencia::find($id)->cliente_id);
    }

    public function destroy($id)
    {
        $referencia = Referencia::findOrFail($id);
        $referencia->delete();
        return redirect()->route('cliente.show', $referencia->cliente_id);
    }

    public function store(Request $request)
    {
        $this->validateReferencia($request);

        Referencia::create($request->all());
        return redirect('referencia')->with('mensaje', 'Referencia agregada exitosamente');
    }

    // Validaciones
    protected function validateReferencia(Request $request, $id = null)
    {
        $request->validate([
            'nombre' => 'required|alpha|min:2|max:100',
            'segnombre' => 'nullable|alpha',
            'apellidopat' => 'required|alpha|min:4|max:100',
            'apellidomat' => 'required|alpha|min:4|max:100',
            'telefono' => 'required|numeric|digits:10|unique:referencias,telefono' . ($id ? ',' . $id : ''),
            'parentesco' => 'required',
            
            
        

        ]);
    }

    protected function validateUpdate(Request $request)
    {
        $request->validate([
            'nombre' => 'required|alpha|min:2|max:100',
            'segnombre' => 'nullable|alpha',
            'apellidopat' => 'required|alpha|min:4|max:100',
            'apellidomat' => 'required|alpha|min:4|max:100',
            'telefono' => 'required|numeric|digits:10',
            'parentesco' => 'required',
        ]);
    }

    protected function referenciaData(Request $request, $cliente_id)
    {
        return [
            'nombre' => $request->nombre,
            'segnombre' => $request->segnombre,
            'apellidopat' => $request->apellidopat,
            'apellidomat' => $request->apellidomat,
            'parentesco' => $request->parentesco,
            'telefono' => $request->telefono,
            'cliente_id' => $cliente_id,
        ];
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\cuenta;

class CuentaController extends Controller
{
    public function index(Request $request)
    {

        $busqueda = $request->get('busqueda');  //recibe del input de index cliente y lo almacena en una variable 
        $cuentas = Cuenta::where('usuario', 'LIKE', '%' . $busqueda . '%')->paginate(10);
        return view('cuenta.index', compact('cuentas', 'busqueda'));
    }


    public function crearcta($id)
    {
        
        return view('cuenta.createid', compact('id'));
    }

    public function crearc($id)
    {
        
        return view('registroCliente.datoscuenta', compact('id'));
    }

    
    public function createnuevocta(Request $request, $id)
    {

        $request->validate([
            'usuario' => 'required|alpha_dash|min:3|max:15|unique:cuentas,usuario,' . $id,
            'contrasenia' => 'required|alpha_dash|min:2|max:15',
            'contraseniaParo' => 'required|alpha_dash|min:2|max:100',
            'comentarios' => 'nullable|alpha|min:10|max:100'
        ]);

        // $usuario = strtoupper($request);

        $datosCliente = $request->except('_token');
        $datosCliente['cliente_id'] = $id;
        $mArray = array_map('strtoupper', $datosCliente);
        Cuenta::insert($mArray);

        /*  $cuenta = Cuenta::create([
            'usuario' => $request->usuario,
            'contrasenia' => $request->contrasenia,
            'contraseniaParo' => $request->contraseniaParo,
            'comentarios' => $request->comentarios,
            'cliente_id' => $id
        ]);*/

        return redirect()->route('buscar.cuenta', $id);
    }

    public function stocta(Request $request, $id)
    {

        $request->validate([
            'usuario' => 'required|alpha_dash|min:3|max:15|unique:cuentas,usuario,' . $id,
            'contrasenia' => 'required|alpha_dash|min:2|max:15',
            'contraseniaParo' => 'required|alpha_dash|min:2|max:100',
            'comentarios' => 'nullable|alpha|min:10|max:100'
        ]);

        // $usuario = strtoupper($request);

        $datosCliente = $request->except('_token');
        $datosCliente['cliente_id'] = $id;
        $mArray = array_map('strtoupper', $datosCliente);
        Cuenta::insert($mArray);

        /*  $cuenta = Cuenta::create([
            'usuario' => $request->usuario,
            'contrasenia' => $request->contrasenia,
            'contraseniaParo' => $request->contraseniaParo,
            'comentarios' => $request->comentarios,
            'cliente_id' => $id
        ]);*/

        return redirect()->route('buscar.cuenta', $id);
    }

    public function store(Request $request)
    {

        $campos = [
            'usuario' => 'required|alpha_dash|min:3|max:15',
            'contrasenia' => 'required|alpha_dash|min:2|max:15',
            'contraseniaParo' => 'required|alpha_dash|min:2|max:100',
            'comentarios' => 'nullable|alpha|min:10|max:100'
        ];

        $this->validate($request, $campos/*$mensaje*/);
        $datosCuenta = $request->except('_token');
        Cuenta::insert($datosCuenta);

        return redirect('cuenta')->with('mensaje', 'cuenta agregado exitosamente ');
    }

    public function show(cuenta $referencia) {}

    public function edit($id)
    {

        $cuenta = Cuenta::findOrfail($id);
        return view('cuenta.edit', compact('cuenta'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'usuario' => 'required|alpha_dash|min:3|max:15',
            'contrasenia' => 'required|alpha_dash|min:2|max:15',
            'contraseniaParo' => 'required|alpha_dash|min:2|max:100',
            'comentarios' => 'nullable|alpha|min:10|max:100'

        ]);

        $cuenta = Cuenta::where('id', '=', $id)->update($request->except(['_token', '_method']));
        $cuenta = Cuenta::findOrFail($id);
        return redirect()->route('buscar.cuenta', $cuenta->cliente_id);
    }

    public function destroy(Request $request, $id)
    {
        cuenta::destroy($id);
        return redirect()->back();
    }



    public function create()
    {
        return view('cuenta.create');
    }
}

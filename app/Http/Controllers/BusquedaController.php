<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class BusquedaController extends Controller
{
    public function formsearch()
    {
        return view('busqueda');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $searchTerm = '%' . $request->search . '%';

            $data = Cliente::where('id', 'like', $searchTerm)
                ->orWhere('nombre', 'like', $searchTerm)
                ->orWhere('segnombre', 'like', $searchTerm)
                ->orWhere('apellidopat', 'like', $searchTerm)
                ->orWhere('apellidomat', 'like', $searchTerm)
                ->orWhere('telefono', 'like', $searchTerm)
                ->orWhere('email', 'like', $searchTerm)
                ->orWhere('rfc', 'like', $searchTerm)
                ->get();

            if ($data->isNotEmpty()) {
                return $this->generateTable($data);
            }

            return 'No results';
        }
    }

    private function generateTable($data)
    {
        $output = '
            <table class="table">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Nombre</th>
                <th scope="col">Segundo nombre</th>
                <th scope="col">Apellido paterno</th>
                <th scope="col">Apellido materno</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>';

        foreach ($data as $row) {
            $output .= '
                <tr>
                <td><a href="' . route('cliente.show', $row->id) . '" class="btn btn-default">Ir a Detalles</a></td>
                <td>' . e($row->nombre) . '</td>
                <td>' . e($row->segnombre) . '</td>
                <td>' . e($row->apellidopat) . '</td>
                <td>' . e($row->apellidomat) . '</td>
                <td>' . e($row->telefono) . '</td>
                <td>' . e($row->email) . '</td>
                </tr>';
        }

        $output .= '
            </tbody>
            </table>';

        return $output;
        
    }


    public function confirmation (){



        return view('registroCliente.confirmacion');
    }


}

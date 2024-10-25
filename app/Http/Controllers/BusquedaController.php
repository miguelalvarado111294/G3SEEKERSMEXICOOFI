<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class BusquedaController extends Controller
{
    //
    public function formsearch()
    {

        return view('busqueda');
    }


    public function search(Request $request)
    {

        if ($request->ajax()) {

            $data = Cliente::where('id', 'like', '%' . $request->search . '%')
                ->orwhere('nombre', 'like', '%' . $request->search . '%')
                ->orwhere('segnombre', 'like', '%' . $request->search . '%')
                ->orwhere('apellidopat', 'like', '%' . $request->search . '%')
                ->orwhere('apellidomat', 'like', '%' . $request->search . '%')
                ->orwhere('telefono', 'like', '%' . $request->search . '%')
                ->orwhere('email', 'like', '%' . $request->search . '%')
                ->orwhere('rfc', 'like', '%' . $request->search . '%')->get();

            $output = '';
            if (count($data) > 0) {
                $output = '
                    <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">nombre</th>
                        <th scope="col">segnombre</th>
                        <th scope="col">apellidopat</th>
                        <th scope="col">apellidoat</th>
                        <th scope="col">telefono</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>';
                foreach ($data as $row) {
                    $output .= '
                            <tr>
                            <th scope="row">' . $row->id . '</th>
                            <td>' . $row->nombre . '</td>
                            <td>' . $row->segnombre . '</td>
                            <td>' . $row->apellidopat . '</td>
                            <td>' . $row->apellidoat . '</td>
                            <td>' . $row->telefono . '</td>
                            <td>' . $row->email . '</td>
                            </tr>
                            ';
                }
                $output .= '
                    </tbody>
                    </table>';
            } else {
                $output .= 'No results';
            }
            return $output;
        }
    }
}

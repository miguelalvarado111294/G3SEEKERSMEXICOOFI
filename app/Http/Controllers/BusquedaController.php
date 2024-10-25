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
                        <th scope="col">Nombre</th>
                        <th scope="col">Segundo nombre</th>
                        <th scope="col">Apellidopat</th>
                        <th scope="col">Apellidoat</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>';
                foreach ($data as $row) {
                    $output .= '
                            <tr>
                           
                            <td>' .  '<a href="' . route('cliente.show', $row->id) . '">' . $row->nombre . '</td>
                            <td>' .  '<a href="' . route('cliente.show', $row->id) . '">' . $row->segnombre . '</td>
                            <td>' . '<a href="' . route('cliente.show', $row->id) . '">' .  $row->apellidopat . '</td>
                            <td>' .  '<a href="' . route('cliente.show', $row->id) . '">' . $row->apellidoat . '</td>
                            <td>' . '<a href="' . route('cliente.show', $row->id) . '">' .  $row->telefono . '</td>
                            <td>' .  '<a href="' . route('cliente.show', $row->id) . '">' . $row->email . '</td>
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



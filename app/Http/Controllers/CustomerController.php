<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Método para obtener todos los clientes
     */
    public function records()
    {
        $records = app('db')->select("
            SELECT
                c.id AS customer_id, a.name AS advisor, c.name AS customer_name
            FROM
                customers c
            INNER JOIN
                advisors AS a ON c.advisor_id = a.id
        ");

        return response()->json([
            'success' => true,
            'message' => 'OK',
            'data' => $records
        ], 201);
    }

    /**
     * Método para obtener el cliente y actualizarlo
     * @params $id
     */
    public function record($id)
    {
        return Customer::findOrFail($id);
    }

    /**
     * Método para crear o actulizar cliente
     */
    public function store(Request $request)
    {
        $id = $request->input('id');
        $customer = Customer::firstOrNew(['id' => $id]);
        $customer->fill($request->all());
        $customer->save();

        return response()->json([
            'success' => true,
            'message' => ($id)
				? 'cliente editado con éxito'
				: 'cliente registrado con éxito',
            'id' => $customer->id
        ], 200);
    }

    /**
     * Método para eliminar cliente
     * @params $id
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update([
            'status' => 0
        ]);

        return [
            'success' => true,
            'message' => 'Cliente eliminado con éxito'
        ];
    }
}

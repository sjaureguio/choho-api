<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advisor;

class ProductTypeController extends Controller
{
    /**
     * Obtenemos todos los asesores de la BD
     */
    public function records()
    {
        $records = app('db')->select("SELECT id, name FROM advisors");

        return response()->json([
            'success' => true,
            'message' => 'OK',
            'data' => $records
        ], 201);
    }

    /**
     * Método para obtener el asesor y actualizarlo
     * @params $id
     */
    public function record($id)
    {
        return Advisor::findOrFail($id);
    }

    /**
     * Método para crear o actulizar asesor
     */
    public function store(Request $request)
    {
        $id = $request->input('id');
        $product_type = Advisor::firstOrNew(['id' => $id]);
        $product_type->fill($request->all());
        $product_type->save();

        return response()->json([
            'success' => true,
            'message' => ($id)
                ? 'Asesor editado con éxito'
                : 'Asesor registrado con éxito',
            'id' => $product_type->id
        ], 200);
    }

    /**
     * Método para eliminar asesor
     * @params $id
     */
    public function destroy($id)
    {
        $product_type = Advisor::findOrFail($id);
        $product_type->update([
            'status' => 0
        ]);

        return [
            'success' => true,
            'message' => 'Asesor eliminado con éxito'
        ];
    }
}

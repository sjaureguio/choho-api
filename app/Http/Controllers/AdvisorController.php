<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductType;

class AdvisorController extends Controller
{
    public function records()
    {
        // Obtenemos todos los tipos de producto de la BD
        $records = app('db')->select("SELECT id, name FROM advisors");

        return response()->json([
            'success' => true,
            'message' => 'OK',
            'data' => $records
        ], 200);
    }

    /**
     * Método para obtener el tipo de producto y actualizarlo
     * @params $id
     */
    public function record($id)
    {
        return ProductType::findOrFail($id);
    }

    /**
     * Método para crear o actulizar Tipo de producto
     */
    public function store(Request $request)
    {
        $id = $request->input('id');
        $product_type = ProductType::firstOrNew(['id' => $id]);
        $product_type->fill($request->all());
        $product_type->save();

        return response()->json([
            'success' => true,
            'message' => ($id)
                ? 'Tipo de producto editado con éxito'
                : 'Tipo de producto registrado con éxito',
            'id' => $product_type->id
        ], 200);
    }

    /**
     * Método para eliminar tipo de producto
     * @params $id
     */
    public function destroy($id)
    {
        $product_type = ProductType::findOrFail($id);
        $product_type->update([
            'status' => 0
        ]);

        return [
            'success' => true,
            'message' => 'Tipo de producto eliminado con éxito'
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Método para obtener todos los productos
     */
    public function records()
    {
        $records = app('db')->select("
            SELECT
                p.id, pt.name AS type, p.name  AS name, p.unit_price
            FROM
                products p
            INNER JOIN
                product_types AS pt ON p.product_type_id = pt.id
        ");

        return response()->json([
            'success' => true,
            'message' => 'OK',
            'data' => $records
        ], 201);
    }

    /**
     * Método para obtener el producto y actualizarlo
     * @params $id
     */
    public function record($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Método para crear o actulizar producto
     */
    public function store(Request $request)
    {
        $id = $request->input('id');
        $product = Product::firstOrNew(['id' => $id]);
        $product->fill($request->all());
        $product->save();

        return response()->json([
            'success' => true,
            'message' => ($id)
				? 'Producto editado con éxito'
				: 'Producto registrado con éxito',
            'id' => $product->id
        ], 200);
    }

    /**
     * Método para eliminar producto
     * @params $id
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'status' => 0
        ]);

        return [
            'success' => true,
            'message' => 'Producto eliminado con éxito'
        ];
    }
}

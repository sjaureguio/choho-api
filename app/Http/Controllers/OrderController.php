<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Advisor;

class OrderController extends Controller
{
    /**
     * Método para obtener los asesores con los clientes asignados y estos con sus pedidos
     */
    public function records()
    {
        $advisors = app('db')->select("
            SELECT
                a.id,
                a.code AS asesor_cod,
                a.name AS asesor_nombre,
                COUNT(c.advisor_id) as clientes_asignados,
                0 as total_pedidos,
                '' as clientes
            FROM
                advisors AS a
            INNER JOIN
                customers AS c ON c.advisor_id = a.id
            GROUP BY
                a.id, a.name, c.advisor_id
        ");

        foreach ($advisors as $advisor) {
            $advisor->clientes = app('db')->select("
                SELECT
                    c.id as cliente_id,
                    c.name AS cliente_nombre,
                    COUNT(o.id) AS total_pedidos,
                    '' as pedidos
                FROM
                        customers AS c
                LEFT JOIN
                    orders AS o ON o.customer_id = c.id
                WHERE
                    c.advisor_id = " . $advisor->id. "
                GROUP BY
                    c.id, c.name
            ");



            foreach ($advisor->clientes as $cliente) {
                $advisor->total_pedidos += $cliente->total_pedidos;
                $cliente->pedidos = app('db')->select("
                    SELECT
                        o.id as pedido_id,
                        COUNT(op.id) as total_productos,
                        ROUND(SUM(op.unit_price * op.quantity), 2) AS total_pedido,
                        o.status as estado,
                        o.date_of_payment AS fecha_pago,
                        '' AS productos
                    FROM
                        orders AS o
                    LEFT JOIN
                        order_products AS op ON op.order_id = o.id
                    WHERE
                        o.customer_id = ". $cliente->cliente_id ."
                    GROUP BY
                        o.id, o.status, o.date_of_payment
                ");

                foreach ($cliente->pedidos as $pedido) {
                    $pedido->productos = app('db')->select("
                        SELECT
                            op.product_id as producto_id,
                            p.name AS producto,
                            pt.name AS tipo,
                            op.quantity AS cantidad,
                            op.unit_price AS valor_unitario,
                            ROUND(SUM(op.quantity * op.unit_price), 2) AS total
                        FROM
                            order_products AS op
                        INNER JOIN
                            products AS p ON op.product_id = p.id
                        INNER JOIN
                            product_types AS pt ON p.product_type_id = pt.id
                        WHERE
                            op.order_id = ". $pedido->pedido_id ."
                        GROUP BY
                            op.product_id, p.name, pt.name, op.quantity, op.unit_price
                    ");
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'OK',
            'data' => $advisors
        ], 201);
    }
}

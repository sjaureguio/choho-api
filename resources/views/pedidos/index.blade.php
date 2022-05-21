<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedidos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="row ma-2">
        <div class="col-lg-12">
            <h1 class="text-center">LISTA DE PEDIDOS</h1>
            <div id="divTabla">
                <table class="table table-sm table-bordered">
                    <thead class="bg-danger text-white">
                        <tr>
                            <th>Asesor Cod.</th>
                            <th>Asesor Nombre</th>
                            <th class="text-right">Clientes asignados</th>
                            <th class="text-right">N° Pedidos</th>
                            <th class="text-center">Clientes</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    function getData() {
        const url = 'https://choho-api.test/api/orders';

        fetch(url)
        .then((resp) => resp.json())
        .then(function(data) {
            let asesores = data.data;

            mostrarAsesores(asesores);
        })
        .catch(function(error) {
            console.log(error);
        });
    }

    function mostrarAsesores(asesores) {

         // Obteniendo el cuerpo de la tabla a donde añadiremos nuestros datos
         let tableBody = document.getElementById('tbody');

        // Recorriendo los datos obtenidos
        for (let i = 0; i < asesores.length; i++) {
            const asesor = asesores[i];

            // Creando los 'td' que almacenará cada parte de la información del asesor actual
            let asesorCod = `<td>${asesor.asesor_cod}</td>`;
            let asesorNombre = `<td>${asesor.asesor_nombre}</td>`;
            let numClientes = `<td class="text-right">${asesor.clientes_asignados}</td>`;
            let totalPedidos = `<td class="text-right">${asesor.total_pedidos}</td>`;

            let clientes = mostrarClientes(asesor);

            tableBody.innerHTML += `<tr>${asesorCod + asesorNombre + numClientes + totalPedidos + clientes }</tr>`;
        }
    }

    function mostrarClientes(asesor) {
        let clienteFila = '';
        for (let index = 0; index < asesor.clientes.length; index++) {
            const cliente = asesor.clientes[index];

            let pedidos = mostrarPedidos(cliente);

            clienteFila += `<tr>
                <td>${cliente.cliente_nombre}</td>
                <td class="text-right">${cliente.total_pedidos}</td>
                <td>${pedidos}</td>
            </tr>`;
        }


        let clientes = `<td class="text-center">
            <table class="table table-sm table-bordered m-0 p-0">
                <thead>
                    <tr>
                        <th>Nombre Cliente</th>
                        <th class="text-right">Total Pedidos</th>
                        <th class="text-center">Pedidos</th>
                    </tr>
                </thead>
                <tbody>
                    ${ clienteFila }
                </tbody>
            </table>
        </td>`;

        return clientes;
    }

    function mostrarPedidos(cliente) {
        let pedidoFila = '';
        let pedidos = '';

        for (let ind = 0; ind < cliente.pedidos.length; ind++) {
            const pedido = cliente.pedidos[ind];

            let productos = mostrarProductos(pedido);

            pedidoFila += `<tr>
                <td>${pedido.total_productos}</td>
                <td>${pedido.total_pedido}</td>
                <td>${productos}</td>
            </tr>`;
        }

        pedidos += `
            <table class="table table-sm table-bordered m-0 p-0">
                <thead class="bg-success text-white">
                    <tr>
                        <th>Total productos</th>
                        <th class="text-right">Total Pedido</th>
                        <th class="text-center">Productos</th>
                    </tr>
                </thead>
                <tbody>
                    ${ pedidoFila }
                </tbody>
            </table>`;

        return pedidos;
    }

    function mostrarProductos(pedido) {
        let productoFila = '';
        let productos = '';

        for (let counter = 0; counter < pedido.productos.length; counter++) {
            const producto = pedido.productos[counter];

            productoFila += `<tr>
                <td class="text-left">${producto.producto}</td>
                <td class="text-right">${producto.cantidad}</td>
                <td class="text-right">${producto.valor_unitario}</td>
                <td class="text-right">${producto.total}</td>
            </tr>`;;
        }

        productos += `<table class="table table-sm table-bordered m-0 p-0">
            <thead class="bg-info text-white">
                <tr>
                    <th class="text-left">Producto</th>
                    <th class="text-right">Cantidad</th>
                    <th class="text-right">Valor Unit.</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                ${ productoFila }
            </tbody>
        </table>`;

        return productos;
    }

    getData();
</script>
</html>

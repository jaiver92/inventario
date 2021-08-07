<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="js/angular.min.js" type="text/javascript"></script>
    <script src="interfaces/inventario.js" type="text/javascript"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Inventario!</title>
</head>

<body ng-app="inventarioApp" ng-controller="inventarioController">
    <?php
    include_once('menu/menu.php')
    ?>

    <div class="container">
        <div class="col-sm-12 col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Lote</th>
                        <th>Fecha Vencimiento</th>
                        <th>Precio</th>
                        <th>Cantidad Vendida</th>
                        <th>Cantidad Restante</th>
                        <th>Modificar</th>
                        <th>Cancelar Venta</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="inv in inventario_general">
                        <td>{{inv.id}}</td>
                        <td>{{inv.nombre}}</td>
                        <td>{{inv.cantidad}}</td>
                        <td>{{inv.lote}}</td>
                        <td>{{inv.fecha_v}}</td>
                        <td>${{inv.precio | number}}</td>
                        <td>{{inv.cantidad_vendida}}</td>
                        <td>{{inv.cantidad_restante}}</td>
                        <td><button class="btn btn-primary btn-tiny" ng-click="EditarInventario($index)">Modificar</button></td>
                        <td ng-show="inv.id_compra > 0"><button class="btn btn-danger btn-tiny" ng-click="BorrarCompra(inv.id_compra)">Cancelar Venta</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>
<div class="modal fade" id="editarinventario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Fecha Actual</td>
                            <td>Actualizar Fecha</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{inventario_seleccionado.fecha_v}}</td>
                           <td><input type="date" id="fecha_actualizar"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" ng-click="GuardarCambios()">Guardar</button>
            </div>
        </div>
    </div>
</div>

</html>
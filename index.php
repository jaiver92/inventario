<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="js/angular.min.js" type="text/javascript"></script>

    <script src="interfaces/index.js?reload=1" type="text/javascript"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Inventario!</title>
</head>

<body ng-app="indexApp" ng-controller="indexController">
    <?php
    include_once('menu/menu.php')
    ?>

    <div class="container">
        <div class="col-sm-12 col-md-8 offset-md-2">
            <form ng-submit="CrearInventario()">
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="">Seleccione Producto</label>
                        <select class="form-control" required ng-model="datos_producto.id_producto">
                            <option ng-repeat="pro in productos" value="{{pro.id}}">{{pro.nombre}}</option>
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-6 form-group">
                        <label>Cantidad</label>
                        <input class="form-control" required  type="number" placeholder="Cantidad" ng-model="datos_producto.cantidad">
                    </div>
                    <div class="col-sm-12 col-md-6 form-group">
                        <label>Lote</label>
                        <input class="form-control" required type="text" placeholder="Lote" ng-model="datos_producto.lote">
                    </div>
                    <div class="col-sm-12 col-md-6 form-group">
                        <label>Fecha Vencimiento</label>
                        <input class="form-control" required id="fecha_v" type="date" placeholder="Fecha Vencimiento" ng-model="datos_producto.fecha_v">
                    </div>
                    <div class="col-sm-12 col-md-6 form-group">
                        <label>Precio C/U</label>
                        <input class="form-control" required type="number" placeholder="Precio" ng-model="datos_producto.precio">
                    </div>
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </div>
            </form>
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

</html>
angular.module('indexApp', []).controller('indexController', function ($scope, $http) {

    $scope.datos_producto = {
        id_producto: "",
        cantidad: "",
        lote: "",
        fecha_v: "",
        precio: ""
    };

    $scope.CargarProductos = function () {

        var parametros = {
            catalogo: "productos"
        };
        $scope.EjecutarLlamado("catalogos", "CargaCatalogo", parametros, $scope.MostrarProductos);

    };

    $scope.MostrarProductos = function (data) {
        $scope.productos = data;
    };

    $scope.CrearInventario = function () {

        var datos = {
            id_producto: $scope.datos_producto.id_producto,
            cantidad: $scope.datos_producto.cantidad,
            lote: $scope.datos_producto.lote,
            fecha_v: $("#fecha_v").val(),
            precio: $scope.datos_producto.precio,
        };
        var parametros = {
            catalogo: "inventario",
            datos: datos

        };
        $scope.EjecutarLlamado("catalogos", "RegistraCatalogoSimple", parametros, $scope.ResultadoRegistroInventario);
    };

    $scope.ResultadoRegistroInventario = function (data)
    {
        alert("Registro Creado")
        location.reload(true)
    }

    $scope.EjecutarLlamado = function (modelo, operacion, parametros, CallBack) {
        $http({
            method: "POST",
            url: "clases/jarvis.php",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            data: {
                modelo: modelo,
                operacion: operacion,
                parametros: parametros
            }
        }).success(function (data) {
            if (data.error == "") {
                CallBack(data.data);
            } else {
                console.log(data);
                $scope.errorGeneral = data.error;
            }
        });
    };
    $scope.CargarProductos();
});
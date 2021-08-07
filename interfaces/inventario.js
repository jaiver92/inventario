angular.module('inventarioApp', []).controller('inventarioController', function ($scope, $http) {

    $scope.datos_inventario = {
        id_inventario: ""
    };

    $scope.CargarProductos = function () {
        $('#editarinventario').modal('hide');
        var parametros = {
            catalogo: "inventario_general"
        };
        $scope.EjecutarLlamado("catalogos", "CargaCatalogo", parametros, $scope.MostrarInventario);

    };

    $scope.MostrarInventario = function (data) {

        $scope.inventario_general = data;
    };

    $scope.BorrarCompra = function (data) {

        var parametros = {
            catalogo: "productos_comprados",
            id: data
        };
        $scope.EjecutarLlamado("catalogos", "EliminaCatalogoSimple", parametros, $scope.CargarProductos);
    };

    $scope.EditarInventario = function (data) {
        $scope.inventario_seleccionado = $scope.inventario_general[data]
        $('#editarinventario').modal('show')
    };

    $scope.GuardarCambios = function () {

        var datos = {
            fecha_v: $("#fecha_actualizar").val()
        };

        var parametros = {
            catalogo: "inventario",
            datos: datos,
            id: $scope.inventario_seleccionado.id
        };

        $scope.EjecutarLlamado("catalogos", "ModificaCatalogoSimple", parametros, $scope.CargarProductos);
    };


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
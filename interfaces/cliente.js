angular.module('clienteApp', []).controller('clienteController', function ($scope, $http) {

    $scope.datos_comprados = {
        id_producto: "",
        cantidad: ""
    };

    $scope.CargarProductos = function () {

        var parametros = {
            catalogo: "productos_registrados"
        };
        $scope.EjecutarLlamado("catalogos", "CargaCatalogo", parametros, $scope.MostrarProductos);

    };

    $scope.MostrarProductos = function (data) {

        $scope.productos = data;
    };

    $scope.ValorProductoSeleccionado = function (data) {
        console.log(data)

        var parametros = {
            catalogo: "productos_seleccionado",
            id_producto: data
        };
        $scope.EjecutarLlamado("catalogos", "CargaCatalogo", parametros, $scope.MostrarProductoSeleccionado);

    };

    $scope.MostrarProductoSeleccionado = function (data) {
        $scope.productos_seleccionado = data;
    };

    $scope.CalcularValor = function (data) {
        $scope.cantidad_productos = data;
        $scope.valor_total = $scope.productos_seleccionado[0].precio * $scope.cantidad_productos;
    };



    $scope.Comprar = function () {

        var datos = {
            id_inventario: $scope.productos_seleccionado[0].id,
            cantidad: $scope.datos_comprados.cantidad
        };
        var parametros = {
            catalogo: "productos_comprados",
            datos: datos

        };
        $scope.EjecutarLlamado("catalogos", "RegistraCatalogoSimple", parametros, $scope.ResultadoRegistro);
    };

    $scope.ResultadoRegistro = function (data) {
        alert("Compra Realizada")
        $scope.ConstruirDocumento();
    }

    $scope.ConstruirDocumento = function ()
    {
        $scope.boton = 0;
        var pdf = new jsPDF();
        var elem = document.getElementById("tabla_productos");
        var res = pdf.autoTableHtmlToJson(elem);
       
        pdf.text(20, 80, 'Gracias por su compra');
        pdf.text(20, 100,'La cantidad y productos que compro esta relacionado');
        pdf.text(20, 110,'en la siguiente tabla:');
        pdf.autoTable(res.columns, res.data, {margin: {top: 120}});


        // Save the PDF
        pdf.save('Factura_Inventario.pdf');
        location.reload(true);
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
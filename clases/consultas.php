<?php

class Consultas {

    public static $inventario = '
    select 
        inv.id,
        pro.nombre,
        inv.cantidad,
        inv.lote,
        inv.fecha_v,
        inv.precio,
        ifnull(com.cantidad,0) cantidad_vendida,
        inv.cantidad - ifnull(com.cantidad,0) cantidad_restante,
        ifnull(com.id,0) id_compra
    from inventario inv 
        inner join productos pro on pro.id = inv.id_producto
        left join productos_comprados com on com.id_inventario = inv.id
    ';

}

?>

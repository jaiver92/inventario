<?php

include_once('clsDDBBOperations.php');
include_once('consultas.php');

class clsCatalogos
{
    public static function EjecutarOperacion($operacion, $parametros)
    {
        switch($operacion)
        {
            case "CargaCatalogo": return clsCatalogos::EjecutarConsulta($parametros); break;
            case "RegistraCatalogoSimple": return clsCatalogos::EjecutarInsercion($parametros); break;
            case "RegistraCatalogoMixto": return clsCatalogos::EjecutarInsercionMixta($parametros); break;
            case "RegistraCatalogoMixtoMasivo": return clsCatalogos::EjecutarInsercionMixtaMasiva($parametros); break;
            case "ModificaCatalogoSimple": return clsCatalogos::EjecutarModificacion($parametros); break;
            case "ModificaCatalogoMixto": return clsCatalogos::EjecutarModificacionMixta($parametros); break;
            case "EliminaCatalogoSimple": return clsCatalogos::EjecutarEliminacion($parametros); break;
            case "EliminaCatalogoMixta": return clsCatalogos::EjecutarEliminacionMixta($parametros); break;
        }
    }

    private static function EjecutarConsulta($parametros)
    {
        $query = "SELECT * FROM ".$parametros->catalogo;
        $order = " ORDER BY 1";

        switch ($parametros->catalogo)
        {
            case "productos": {
                $query = "select * from productos";
                $order = " order by 1 ";
            }; break;
            
            case "productos_registrados": {
                $query = "select inv.id,pro.id id_producto,pro.nombre from inventario inv inner join productos pro on pro.id = inv.id_producto";
                $order = " order by 1 ";
            }; break;
            
            case "productos_seleccionado": {
                $query = "select * from inventario where id = ". $parametros->id_producto;
                $order = " order by 1 ";
            }; break;

            case "inventario_general": {
                $query = Consultas::$inventario;
                $order = " order by 1 ";
            }; break;
        }
        $query = $query.$order;
        return clsDDBBOperations::ExecuteSelectNoParams($query);

    }

    private static function EjecutarInsercion($parametros)
    {
        $result = clsDDBBOperations::ExecuteInsert((array)$parametros->datos, $parametros->catalogo);
        return clsCatalogos::EjecutarConsulta($parametros);
    }

    private static function EjecutarInsercionMixta($parametros)
    {
        $result = clsDDBBOperations::ExecuteInsert((array)$parametros->datos, $parametros->catalogo_real);
        return clsCatalogos::EjecutarConsulta($parametros);
    }

    private static function EjecutarInsercionMixtaMasiva($parametros)
    {
        foreach ($parametros->lista_datos as $datos)
        {
            $result = clsDDBBOperations::ExecuteInsert((array)$datos, $parametros->catalogo_real);
        }

        return clsCatalogos::EjecutarConsulta($parametros);
    }

    private static function EjecutarModificacion($parametros)
    {
        clsDDBBOperations::ExecuteUpdate((array)$parametros->datos, $parametros->catalogo, $parametros->id);
        return clsCatalogos::EjecutarConsulta($parametros);
    }

    private static function EjecutarModificacionMixta($parametros)
    {
        clsDDBBOperations::ExecuteUpdate((array)$parametros->datos, $parametros->catalogo_real, $parametros->id);
        return clsCatalogos::EjecutarConsulta($parametros);
    }

    private static function EjecutarEliminacion($parametros)
    {
        clsDDBBOperations::ExecuteDelete($parametros->catalogo, $parametros->id);
        return clsCatalogos::EjecutarConsulta($parametros);
    }

    private static function EjecutarEliminacionMixta($parametros)
    {
        clsDDBBOperations::ExecuteDelete($parametros->catalogo_real, $parametros->id);
        return clsCatalogos::EjecutarConsulta($parametros);
    }
}

?>

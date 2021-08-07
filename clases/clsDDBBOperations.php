<?php

include_once('consultas.php');
include_once('meekrodb.2.3.class.php');
    
class clsDDBBOperations
{
    public static function ExecuteUniqueRowNoParams($query)
    {
        $result = "";
        try 
        {
             $result = DB::queryFirstRow($query);
        } 
        catch(MeekroDBException $e) {
            $result = $_SERVER["HTTP_HOST"] == 'localhost' ? "Error: " . $e->getMessage() : "Error en la operación.";
            //echo "SQL Query: " . $e->getQuery() . "<br>\n"; // INSERT INTO accounts...
        }
        return $result;
    }
    
    public static function ExecuteUniqueRow($query, $searchedValue)
    {
        $result = "";
        try 
        {
             $result = DB::queryFirstRow($query, $searchedValue);
        } 
        catch(MeekroDBException $e) {
            $result = $_SERVER["HTTP_HOST"] == 'localhost' ? "Error: " . $e->getMessage() : "Error en la operación.";
             // something about duplicate keys
            //echo "SQL Query: " . $e->getQuery() . "<br>\n"; // INSERT INTO accounts...
        }
        return $result;
    }
    
    public static function ExecuteSelectNoParams($query)
    {
        $result = "";
        try 
        {
             $result = DB::query($query);
        } 
        catch(MeekroDBException $e) {
            $result = $_SERVER["HTTP_HOST"] == 'localhost' ? "Error: " . $e->getMessage() : "Error en la operación.";
            //echo "SQL Query: " . $e->getMessage() . "<br>\n"; // INSERT INTO accounts...
        }
        return $result;
    }
    
    public static function ExecuteSelect($query, $searchedValue)
    {
        $result = "";
        try 
        {
             $result = DB::query($query, $searchedValue);
        } 
        catch(MeekroDBException $e) {
            $result = $_SERVER["HTTP_HOST"] == 'localhost' ? "Error: " . $e->getMessage() : "Error en la operación.";
            //echo "SQL Query: " . $e->getQuery() . "<br>\n"; // INSERT INTO accounts...
        }
        return $result;
    }
    
    public static function ExecuteUpdate($updates, $tabla, $condicion)
    {
        $result = "";
        try 
        {
             DB::update($tabla, $updates , "id=%s", $condicion);
             
             $result = array();
             $result["mensaje"] = DB::affectedRows()." actualizados correctamente.";
        } 
        catch(MeekroDBException $e) {
            $result = $_SERVER["HTTP_HOST"] == 'localhost' ? "Error: " . $e->getMessage() : "Error en la operación.";
            //echo "SQL Query: " . $e->getQuery() . "<br>\n"; // INSERT INTO accounts...
        }
        return $result;
    }
    
    public static function ExecuteInsert($inserts, $tabla)
    {
        $result = "";
        try 
        {
             DB::insert($tabla, $inserts);
             
             $result = array();
             $result["mensaje"] = DB::affectedRows()." registradas correctamente.";
        } 
        catch(MeekroDBException $e) {
            $result = $_SERVER["HTTP_HOST"] == 'localhost' ? "Error: " . $e->getMessage() : "Error en la operación.";
            //echo "SQL Query: " . $e->getQuery() . "<br>\n"; // INSERT INTO accounts...
        }
        return $result;
    }
    
    public static function ExecuteDelete($tabla, $identificador)
    {
        DB::delete($tabla, "ID=%i", $identificador);
    }
    
    public static function GetLastInsertedId()
    {
        return DB::insertId();
    }
}
    
?>
<?php


class Attribute_values extends Db_object
{
    public $id;
    public $name;
    public $attribute_id;

    protected static $db_table = "attribute_values";
    protected static $db_table_fields = array('name', 'attribute_id');
    protected static $foreign_column = "attribute_id";

   public static function find_the_specific_value($attribute_id, $specific_product_attribute_value_id ){
        global $database;
        $sql = "SELECT * FROM " . static::$db_table;
        $sql .= " WHERE " . static::$foreign_column . " = " . $database->escape_string($attribute_id);
        $sql .= " AND id = " . $database->escape_string($specific_product_attribute_value_id);


        return static::find_this_query($sql);
    }


}

class Attributes extends Db_object
{
    public $id;
    public $name;

    protected static $db_table = "attributes";
    protected static $db_table_fields = array('name');
}



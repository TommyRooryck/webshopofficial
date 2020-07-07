<?php


class Super_category extends Db_object
{
    public $id;
    public $name;
    public $description;

    protected static $db_table = "super_category";
    protected static $db_table_fields = array('name','description');

    public static function check_super_category_exist($super_category_id){
        global $database;
        $category = $database->escape_string($super_category_id);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE id = '{$super_category_id}'";

        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

}

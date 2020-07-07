<?php


class Category extends Db_object
{
    public $id;
    public $name;
    public $description;
    public $super_category_id;


    protected static $db_table = "category";
    protected static $db_table_fields = array('name', 'description', 'super_category_id');

    public static function create_category($name, $description, $super_category_id)
    {
        if (!empty($super_category_id) && !empty($name) && !empty($description))
        {

            $category = new Category();
            $category->name = $name;
            $category->description = $description;
            $category->super_category_id = $super_category_id;

            return $category;

        }    else{
            return false;
        }
    }

    public static function find_the_categories($super_category_id){
        global $database;
        $sql = "SELECT * FROM " . self::$db_table;
        $sql .= " WHERE super_category_id = " . $database->escape_string($super_category_id);
        $sql .= " ORDER BY name ASC";

        return self::find_this_query($sql);
    }
}

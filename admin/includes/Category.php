<?php


class Category extends Db_object
{
    public $id;
    public $name;
    public $description;
    public $super_category_id;



    protected static $db_table = "category";
    protected static $db_table_fields = array('name', 'description', 'super_category_id');
    protected static $foreign_column = "super_category_id";

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
}

class Sub_category extends Db_object
{
    public $id;
    public $name;
    public $description;
    public $category_id;

    protected static $db_table = "sub_category";
    protected static $db_table_fields = array('name', 'description', 'category_id');
    protected static $foreign_column = "category_id";

    public static function create_sub_category($name, $description, $category_id)
    {
        if (!empty($category_id) && !empty($name) && !empty($description))
        {

            $sub_category = new Sub_category();
            $sub_category->name = $name;
            $sub_category->description = $description;
            $sub_category->category_id = $category_id;

            return $sub_category;

        }    else{
            return false;
        }
    }

}

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



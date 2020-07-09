<?php


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

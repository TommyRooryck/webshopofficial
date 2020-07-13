<?php


class Attribute_values extends Db_object
{
    public $id;
    public $name;
    public $attribute_id;

    protected static $db_table = "attribute_values";
    protected static $db_table_fields = array('name', 'attribute_id');
    protected static $foreign_column = "attribute_id";


}

class Attributes extends Db_object
{
    public $id;
    public $name;

    protected static $db_table = "attributes";
    protected static $db_table_fields = array('name');
}



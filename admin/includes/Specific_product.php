<?php


class Specific_product
{
    public $id;
    public $attribute_values_id;
    public $product_id;

    protected static $db_table = "specific_product";
    protected static $db_table_fields = array('attribute_values_id', 'product_id');

}

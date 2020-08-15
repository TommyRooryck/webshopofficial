<?php


class Order_products extends Db_object
{
    public $id;
    public $order_id;
    public $product_id;
    public $attribute_id;
    public $attribute_values_id;

    protected static $db_table = 'order_products';
    protected static $db_table_fields = array(
        'id',
        'order_id',
        'product_id',
        'attribute_id',
        'attribute_values_id'
    );

    protected static $foreign_column = "product_id";
}
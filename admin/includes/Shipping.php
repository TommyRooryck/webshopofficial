<?php


//class Shipping_zone{
//    public $id;
//    public $name;
//
//    protected static $db_table = "shipping_zone";
//    protected static $db_table_fields = array('name');
//}
//
//class Shipping_price{
//    public $id;
//    public $price;
//
//    protected static $db_table = "shipping_price";
//    protected static $db_table_fields = array('price');
//}

class Shipping extends Db_object
{
    public $id;
    public $shipping_zone;
    public $shipping_price;

    protected static $db_table = "shipping";
    protected static $db_table_fields = array('shipping_zone', 'shipping_price');
}
<?php


class Order_status
{
    public $id;
    public $name;


    protected static $db_table = 'order_status';
    protected static $db_table_fields = array(
        'id',
        'name',
    );

}
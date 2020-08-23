<?php


class Orders extends Db_object
{
    public $id;
    public $customer_id;
    public $created_at;
    public $products;
    public $status;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $adress;
    public $city;
    public $postal_code;
    public $region;
    public $country;
    public $shipping_adress;
    public $shipping_city;
    public $shipping_postal_code;
    public $shipping_region;
    public $shipping_country;
    public $total_price;
    public $payment_id;
    public $bestelcode;

    protected static $db_table = "orders";
    protected static $db_table_fields = array(
        'id',
        'customer_id',
        'created_at',
        'products',
        'status',
        'first_name',
        'last_name',
        'email',
        'phone',
        'adress',
        'city',
        'postal_code',
        'region',
        'country',
        'shipping_adress',
        'shipping_city',
        'shipping_postal_code',
        'shipping_region',
        'shipping_country',
        'total_price',
        'payment_id',
        'bestelcode',
    );
    protected static $foreign_column = "customer_id";

    public static function find_by_bestelnummer($bestelnummer){
        global $database;
        $the_result_array = static::find_this_query("SELECT * FROM " . static::$db_table . " WHERE bestelcode = '$bestelnummer' LIMIT 1" );
        return !empty($the_result_array) ? array_shift($the_result_array): false;
    }
}
<?php


class Orders extends Db_object
{
    public $id;
    public $created_at;
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

    protected static $db_table = "orders";
    protected static $db_table_fields = array(
        'id',
        'created_at',
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
        'total_price'
    );
}
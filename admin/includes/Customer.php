<?php


class Customer extends Db_object
{
    public $id;
    public $username;
    public $password;
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

    protected static $db_table = "customers";
    protected static $db_table_fields = array(
        'username',
        'password',
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
        'shipping_country'
        );

    public static function verify_customer($username, $password){
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function check_customer_exist($username){
        global $database;
        $username = $database->escape_string($username);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '{$username}'";

        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

}

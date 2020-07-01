<?php


class Admin extends Db_object
{
    public $id;
    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $role;

    protected static $db_table = "users";
    protected static $db_table_fields = array('first_name','last_name','username', 'password', 'role');

    public static function verify_admin($username, $password)
    {
        global $database;
        $username = $database->escape_string(($username));
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }


    public static function check_admin_exist($username){
        global $database;
        $username = $database->escape_string($username);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '{$username}'";

        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }


}

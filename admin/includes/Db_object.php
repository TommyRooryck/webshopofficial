<?php


class Db_object
{
    public static function find_all()
    {
        return static::find_this_query("SELECT * FROM " . static::$db_table . " ");
    }

    public static function order_by_name($a, $b)
    {
        return strcmp($a->name, $b->name);
    }

    public static function order_by_date($a, $b)
    {
        return strcmp($a->created_at, $b->created_at);
    }

    public static function find_by_id($id)
    {
        global $database;
        $the_result_array = static::find_this_query("SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function find_by_username($username)
    {
        global $database;
        $username = $database->escape_string($username);

        $sql = "SELECT * FROM " . static::$db_table . " WHERE username = '{$username}'";

        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function find_by($column, $parameter)
    {
        global $database;
        $parameter = $database->escape_string($parameter);
        $column = $database->escape_string($column);

        $sql = "SELECT * FROM " . static::$db_table . " WHERE {$column} = '{$parameter}'";

        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function find_by_array($column, $parameter)
    {
        global $database;
        $parameter = $database->escape_string($parameter);
        $column = $database->escape_string($column);

        $sql = "SELECT * FROM " . static::$db_table . " WHERE {$column} = '{$parameter}'";

        return static::find_this_query($sql);
    {
        global $database;
        $parameter = $database->escape_string($parameter);
        $column = $database->escape_string($column);

        $sql = "SELECT * FROM " . static::$db_table . " WHERE {$column} = '{$parameter}'";

        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    }


    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }

    public static function instantie($result)
    {
        $calling_class = get_called_class();
        $the_object = new $calling_class;
        foreach ($result as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }
        return $the_object;
    }

    public static function find_this_query($sql)
    {
        global $database;
        $result = $database->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result)) {
            $the_object_array[] = static::instantie($row);
        }
        return $the_object_array;
    }

    public function properties()
    {
        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    protected function clean_properties()
    {
        global $database;
        $clean_properties = array();
        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }

    public function create()
    {
        global $database;
        $properties = $this->clean_properties();
        $sql = "INSERT INTO " . static::$db_table . " (" . implode(",", array_keys($properties)) . ")";
        $sql .= " VALUES ('" . implode("','", array_values($properties)) . "')";

        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }

        $database->query($sql);
    }

    public function update()
    {
        global $database;
        $properties = $this->clean_properties();
        $properties_assoc = array();

        foreach ($properties as $key => $value) {
            $properties_assoc[] = "{$key} = '{$value}'";
        }

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", $properties_assoc);
        $sql .= " WHERE id= " . $database->escape_string($this->id);

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    public function delete()
    {
        global $database;

        $sql = "DELETE FROM " . static::$db_table;
        $sql .= " WHERE id= " . $database->escape_string($this->id);
        $sql .= " LIMIT 1";

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public $errors = array();
    public $upload_errors_array = array( //Toon de volgende strings bij de bepaalde errors
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload maximum filesize from php.ini",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds MAX_FILE_SIZE in php.ini for html form ",
        UPLOAD_ERR_NO_FILE => "No file uploaded",
        UPLOAD_ERR_PARTIAL => "The file was partially uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write to disk",
        UPLOAD_ERR_EXTENSION => "A php extension stopped your upload"
    );

    public static function count_all()
    {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$db_table;
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array(($result_set));

        return array_shift($row);
    }

    public static function count_by_column($column, $parameter)
    {
        global $database;


        $sql = "SELECT COUNT(*) FROM " . static::$db_table;
        $sql .= " WHERE {$column}= " . $database->escape_string($parameter);
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array(($result_set));

        return array_shift($row);
    }

    public static function paginate($items_per_page, $offset)
    {
        global $database;
        $items_per_page = $database->escape_string($items_per_page);
        $offset = $database->escape_string($offset);

        $sql = "SELECT * FROM " . static::$db_table;
        $sql .= " LIMIT " . $items_per_page . " OFFSET " . $offset;

        return static::find_this_query($sql);
    }

    public static function find_the_key($foreign_key)
    {
        global $database;
        $sql = "SELECT * FROM " . static::$db_table;
        $sql .= " WHERE " . static::$foreign_column . " = " . $database->escape_string($foreign_key);


        return static::find_this_query($sql);
    }

}

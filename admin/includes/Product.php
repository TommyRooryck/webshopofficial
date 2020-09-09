<?php


class Product extends Db_object
{

    /**Properties van objecten van de class**/
    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $created_at;
    public $product_placeholder;
    public $category_id;
    public $sub_category_id;

    public $image_placeholder = 'https://via.placeholder.com/100';
    public $upload_directory = 'img' . DS . 'products' .DS . 'placeholders';
    public $tmp_path;

    /**Abstractie van universele klasse: static property**/
    protected static $db_table = "products";
    protected static $db_table_fields = array('name', 'description', 'price', 'stock','created_at', 'product_placeholder', 'category_id', 'sub_category_id');




    public function image_path_and_placeholder()
    {
        return empty($this->product_placeholder) ? $this->image_placeholder : $this->upload_directory . DS . $this->product_placeholder;
    }



    /**Methods uit Photo() class**/

    public function set_file($file)
    {
        // print $file;

        if (empty($file) || !$file || !is_array($file)){
            $this->errors[] = "There was no file uploaded here";
            return $this->errors;
        } elseif ($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return $this->errors;
        } else{
            $this->product_placeholder = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
        }
    }


    public function create_image()
    {
        if ($this->id) {
            $this->update();
        } else { //anders:
            if (!empty($this->errors)) {
                return false;
            }
            if (empty($this->product_placeholder) || empty($this->tmp_path)) {
                $this->errors[] = "File not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . "admin" . DS . $this->upload_directory . DS . $this->product_placeholder;
            $target_path2 = SITE_ROOT . DS . "admin" . DS . $this->upload_directory . DS . $this->product_placeholder;

            if (file_exists($target_path)) {
                $this->errors[] = "File {$this->product_placeholder} exists!";
                return false;
            }
            if (move_uploaded_file($this->tmp_path, $target_path)) {
                if ($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->errors[] = "This folder has no rights!";
                return false;
            }

            if (file_exists($target_path2)) {
                $this->errors[] = "File {$this->product_placeholder} exists!";
                return false;
            }
            if (move_uploaded_file($this->tmp_path, $target_path2)) {
                if ($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->errors[] = "This folder has no rights!";
                return false;
            }
        }
    }

    public function save_image()
    {
        $target_path = SITE_ROOT . DS . "admin" . DS . $this->upload_directory . DS . $this->product_placeholder;
        $target_path2 = SITE_ROOT . DS . $this->upload_directory . DS . $this->product_placeholder;

        if ($this->id){
            move_uploaded_file($this->tmp_path,$target_path);
            $this->update();
            unset($this->tmp_path);
            return true;
        }else{
            if (!empty($this->errors)){
                return false;
            }
            if (empty($this->user_image) || empty($this->tmp_path)){
                $this->errors[] = "File not available";
                return false;
            }
            if (move_uploaded_file($this->tmp_path, $target_path)){
                if ($this->create()){
                    unset($this->tmp_path);
                    return true;
                }
            } else{
                $this->errors[] = "This folder has no write rights!";
                return false;
            }
        }

        if ($this->id){
            move_uploaded_file($this->tmp_path,$target_path2);
            $this->update();
            unset($this->tmp_path);
            return true;
        }else{
            if (!empty($this->errors)){
                return false;
            }
            if (empty($this->user_image) || empty($this->tmp_path)){
                $this->errors[] = "File not available";
                return false;
            }
            if (move_uploaded_file($this->tmp_path, $target_path2)){
                if ($this->create()){
                    unset($this->tmp_path);
                    return true;
                }
            } else{
                $this->errors[] = "This folder has no write rights!";
                return false;
            }
        }

    }

    public function delete_product()
    {
        if ($this->delete()) {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->image_path_and_placeholder();
            $target_path2 = SITE_ROOT .  DS . $this->image_path_and_placeholder();
            return unlink($target_path) ? true : false;
            return unlink($target_path2) ? true : false;
        } else {
            return false;
        }
    }

    public static function paginate_categories($items_per_page, $offset, $category_id)
    {
        global $database;
        $items_per_page = $database->escape_string($items_per_page);
        $offset = $database->escape_string($offset);

        $sql = "SELECT * FROM " . static::$db_table;
        $sql .= " WHERE category_id= " . $database->escape_string($category_id);
        $sql .= " LIMIT " . $items_per_page . " OFFSET " . $offset;

        return static::find_this_query($sql);
    }

    public static function paginate_sub_categories($items_per_page, $offset, $sub_category_id)
    {
        global $database;
        $items_per_page = $database->escape_string($items_per_page);
        $offset = $database->escape_string($offset);

        $sql = "SELECT * FROM " . static::$db_table;
        $sql .= " WHERE sub_category_id= " . $database->escape_string($sub_category_id);
        $sql .= " LIMIT " . $items_per_page . " OFFSET " . $offset;

        return static::find_this_query($sql);
    }
}



class Specific_product extends Db_object
{
    public $id;
    public $attribute_id;
    public $attribute_values_id;
    public $product_id;
    public $quantity;

    protected static $db_table = "specific_product";
    protected static $db_table_fields = array('attribute_id','attribute_values_id', 'product_id', 'quantity');
    protected static $foreign_column = 'product_id';


    public static function find_specific_product_attribute($attribute_id, $product_id)
    {
        global $database;
        $sql = "SELECT * FROM " . static::$db_table;
        $sql .= " WHERE attribute_id =  " . $database->escape_string($attribute_id);
        $sql .= " AND product_id = " . $database->escape_string($product_id);

        return static::find_this_query($sql);
    }

    public static function find_specific_product_attribute_value($attribute_value_id, $product_id)
    {
        global $database;
        $sql = "SELECT * FROM " . static::$db_table;
        $sql .= " WHERE attribute_values_id =  " . $database->escape_string($attribute_value_id);
        $sql .= " AND product_id = " . $database->escape_string($product_id);

        return static::find_this_query($sql);
    }


}


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



    /**Locatie van de afbeelding**/
    public function image_path_and_placeholder()
    {
        return empty($this->product_placeholder) ? $this->image_placeholder : $this->upload_directory . DS . $this->product_placeholder;
    }
    /*
         * Wanneer we geen image vinden dan geven we de standaard locatie als default terug, nl. image_placeholder die de link bevat naar http://place-holt.it
         * In Het andere geval wordt de echte image teruggegeven.
    */

    /**Methods uit Photo() class**/

    public function set_file($file) //Zie Photo() class
    {
        // print $file;

        if (empty($file) || !$file || !is_array($file)){
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif ($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
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
        }
    }

    public function save_image()
    {
        $target_path = SITE_ROOT . DS . "admin" . DS . $this->upload_directory . DS . $this->product_placeholder;

        if ($this->id){ //Als er een id opgevangen wordt:
            move_uploaded_file($this->tmp_path,$target_path);
            $this->update(); //voer method update() uit
            unset($this->tmp_path); //tmp_path wordt leeggemaakt
            return true; //return true
        }else{ //anders:
            if (!empty($this->errors)){ //als errors niet leeg zijn return false
                return false;
            }
            if (empty($this->user_image) || empty($this->tmp_path)){ //als er geen user_image is of geen tmp_path (file) aanwezig is:
                $this->errors[] = "File not available"; //Steek deze string in de errors[] array
                return false; //return false
            }
            if (move_uploaded_file($this->tmp_path, $target_path)){ //Indien de file successvol verplaats werd naar de target_path:
                if ($this->create()){ //indien de create() method wordt uigevoerd unset de tmp_path(file) en return true
                    unset($this->tmp_path);
                    return true;
                }
            } else{ //Anders steek de error in de array en return false
                $this->errors[] = "This folder has no write rights!";
                return false;
            }
        }
    }

    public function delete_product()
    {
        if ($this->delete()) {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->image_path_and_placeholder();
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }
}

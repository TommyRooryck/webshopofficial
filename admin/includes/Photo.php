<?php


class Photo extends Db_object
{

    protected static $db_table = "photos";
    protected static $db_table_fields = array('title', 'description', 'filename', 'type', 'size', 'product_id');
    protected static $foreign_column = "product_id";

    public $id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;
    public $product_id;


    public $tmp_path;
    public $upload_directory = 'img' . DS . 'products';


    public function set_file($file)
    {
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "No file uploaded!";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

    public static function set_files($files){;

        $countfiles = count($files['name']);
        for ($x=0 ; $x<$countfiles; $x++){

            $photo = new self();

            $filename = $files['name'][$x];
            $tmp_path = $files['tmp_name'][$x];
            $type = $files['type'][$x];
            $size = $files['size'][$x];



            $photo->filename = $filename;
            $photo->tmp_path = $tmp_path;
            $photo->type = $type;
            $photo-> size = $size;

            $photo->save();
            var_dump($photo);
        }
    }

    public static function set_files_product($files,$product_id){

        $countfiles = count($files['name']);
        for ($x=0 ; $x<$countfiles; $x++){

            $photo = new self();

            $filename = $files['name'][$x];
            $tmp_path = $files['tmp_name'][$x];
            $type = $files['type'][$x];
            $size = $files['size'][$x];



            $photo->filename = $filename;
            $photo->tmp_path = $tmp_path;
            $photo->type = $type;
            $photo-> size = $size;
            $photo->product_id = $product_id;

            $photo->save();

        }
    }




    public function save()
    {
        if ($this->id) {
            $this->update();
        } else { //anders:
            if (!empty($this->errors)) {
                return false;
            }
            if (empty($this->filename) || empty($this->tmp_path)) {
                $this->errors[] = "File not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . "admin" . DS . $this->upload_directory . DS . $this->filename;

            if (file_exists($target_path)) {
                $this->errors[] = "File {$this->filename} exists!";
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

    public function picture_path()
    {
        return $this->upload_directory . DS . $this->filename;
    }

    public function delete_photo()
    {
        if ($this->delete()) {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }

}

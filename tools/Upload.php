<?php

class Upload
{
    protected $upfile;

    private $name;

    private $type;

    private $size;

    private $error;

    private $tmp_name;

    public function __construct()
    {
        $this->upfile = $_FILES['upfile'];
        $this->name = $_FILES['upfile']['name'];
        $this->type = $_FILES['upfile']['type'];
        $this->size = $_FILES['upfile']['size'];
        $this->error = $_FILES['upfile']['error'];
        $this->tmp_name = $_FILES['upfile']['tmp_name'];
    }

    public function up()
    {
        if (!is_uploaded_file($this->tmp_name)) {
            return false;
        }
        $okType = $this->checkType($this->type);
        if ($okType) {
            $error = $this->error;//上传后系统返回的值
            $destination = './files/' . $this->name;
            move_uploaded_file($this->tmp_name, $destination);
            if ($error == 0) {
                $img = urlencode('/files/' . $this->name);
                $imgUrl = "localhost/upload_img/upload/" . $img;
            }
            return $imgUrl;
        }
    }

    public function checkType($type)
    {
        switch ($type) {
            case 'image/pjpeg':
                return true;
                break;
            case 'image/jpeg':
                return true;
                break;
            case 'image/gif':
                return true;
                break;
            case 'image/png':
                return true;
                break;
            case 'swf':
                return true;
                break;
        }
    }
}
?>
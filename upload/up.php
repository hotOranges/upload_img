<?php
include './tools/Response.php';
include './tools/Upload.php';
$file = new Upload();
$img = $file->up();
if ($img){
    Response::retData(0,'success',$img);
}else{
    Response::retData(500,'fail');//
}
?>
<?php
class Response{
    const FORMAT = 'json';
    /**
     * @param int $code 错误码
     * @param string $message 错误信息
     * @param array $data 数据
     * @return string 返回json
     */
    public static function retData($code=0,$message='',$data=array())
    {
        $format = isset($_GET['format'])?$_GET['format']:self::FORMAT;
        switch ($format){
            case 'json':
                echo self::getJson($code,$message,$data);
                break;
            case 'xml':
                echo self::getXml($code,$message,$data);
                break;
            case 'array':
                print_r(array('code'=>$code,'message'=>$message,'data'=>$data));
                break;
            default;
        }
    }

    /**
     * @param int $code 错误码
     * @param string $message 错误信息
     * @param array $data 数据
     * @return string 返回json
     */
    public static function getJson($code=0,$message='',$data=array())
    {
        if(!is_numeric($code)){
            return '';
        }
        $result = array(
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        );
        return json_encode($result);
    }

    /**
     * @param int $code 错误码
     * @param string $message 错误信息
     * @param array $data 数据
     * @return string 返回json
     */
    public static function getXml($code=0,$message='',$data=array())
    {
        if(!is_numeric($code)){
            return '';
        }
        $result = array(
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        );
        header('Content-Type:text/xml');
        $xml = "<?xml version='1.0' encoding='UTF-8'?>";
        $xml .= "<root>";
        $xml .= self::dataToXml($result);
        $xml .= "</root>";
        return $xml;
    }

    protected static function dataToXml($data)
    {
        $xml = $attr = "";
        foreach ($data as $key=>$value){
            if(is_numeric($key)){
                $attr = "id='$key'";
                $key = 'item';
            }
            $xml .= "<{$key} {$attr}>";
            $xml .= is_array($value)?self::datatoXml($value):$value;
            $xml .= "</{$key}>\n";
        }
        return $xml;
    }
}
?>
<?php
namespace App\Http\Response;

trait ResponseJson{
    /**
     * 返回一个json
     * @param $code
     * @param $message
     * @param $data
     * @return string
     */
    public function jsonResponse($code,$message,$data){
        $content=[
            'code'=>$code,
            'msg'=>$message,
            'data'=>$data
        ];
        return json_encode($content,JSON_FORCE_OBJECT);
        //return response()->json($content);
    }

    /**
     * App接口调用成功时的返回
     * @param array $data
     * @return string
     */
    public function jsonSuccessData($data=[]){
        return $this->jsonResponse(0,'Success',$data);
    }

    /**
     * 出现异常的返回
     * @param $code
     * @param $message
     * @param array $data
     * @return string
     */
    public function jsonData($code,$message,$data=[]){
        //echo 123;die;
        return $this->jsonResponse($code,$message,[]);
    }
}
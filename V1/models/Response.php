<?php

namespace Models;

/**
 * Class Response 
 * @namespace Models
 * Handling a HTTP RESPONSE
 */
class Response{

    /**
     * Success message
     *
     * @var boolean
     */
    private $success;
    /**
     * Status code definition
     *
     * @var int
     */
    private $httpStatusCode;
    /**
     * custom messages
     *
     * @var array
     */
    private $messages = array();

 
    /**
     * the Data handled by the response
     *
     * @var mixed
     */
    private $data;

    /**
     * Caching handler
     *
     * @var boolean
     */
    private $toCache = false;

    /**
     * Response data handler
     *
     * @var array
     */
    private $responseData = array();

    /**
     * set success message
     *
     * @param string $_success
     * @return void
     */
    public function setSuccess($_success) : void{

            $this->success = $_success;

    }

    /**
     * set http status code for response
     *
     * @param int $_httpCode
     * @return void
     */
    public function setHttpStatusCode($_httpCode) : void{

         $this->httpStatusCode = $_httpCode;

    }  

    public function addMessage($_message){

         $this->messages[]= $_message;
    }

    public function setData($_data){

         $this->data = $_data;
    }

    public function toCache($_cache){

        $this->toCache = $_cache;

    }

    public function sendResponseData(){
         header('Content-type: application/json;charset=utf-8');
         if($this->toCache === true){
                header('Cache-control: max-age=60');
         }else{

             header('Cache-control: no-cache, no-store');
         }

         if(($this->success !== false && $this->success !== true) || !is_numeric($this->httpStatusCode)){
            http_response_code(500);
            $this->responseData["statusCode"] = 500;
            $this->responseData["success"] = false;
            $this->addMessage('Internal Server Error Response Creation encouter an error !!');
            $this->responseData['messages'] = $this->messages;
         }else{
            http_response_code($this->httpStatusCode);
            $this->responseData['statusCode'] = $this->httpStatusCode;
            $this->responseData["success"] = $this->success;
            $this->responseData['messages'] = $this->messages;
            $this->responseData['data'] = $this->data;
        
         }

         echo json_encode($this->responseData);
    }
}
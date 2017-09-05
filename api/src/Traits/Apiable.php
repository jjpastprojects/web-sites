<?php

namespace Lembarek\Api\Traits;

trait Apiable
{
     private $statusCode = 200;


    /**
     * it response with 200
     *
     * @param  mix  $data
     * @return Response
     */
    public function response($data)
    {
        return response()->json(['status' =>'success', 'data' => $data], $this->getStatusCode());
    }

    /**
     * response when new record created
     *
     * @param  mix  $data
     * @return Response
     */
    public function responseCreate($data)
    {
        return $this->setStatusCode(201)->response($data);
    }

    /**
     * response when recored updated
     *
     * @param  mix  $data
     * @return Response
     */
    public function responseUpdate($data)
    {
        return $this->setStatusCode(200)->response($data);
    }

    /**
     * response when a record deleted
     *
     * @param  mix  $data
     * @return Response
     */
    public function responseDelete($data)
    {
        return $this->setStatusCode(200)->response($data);
    }

    /**
     * response with error
     *
     * @param  string  $message
     * @return Response
     */
    public function responseWithError($message)
    {
        return response()->json(['status' => 'fail', 'message' => $message], $this->getStatusCode());
    }

    /**
     * return when the user do not exist
     *
     * @return Response
     */
    public function responseNotFound($message=null)
    {
        return $this->setStatusCode(404)->responseWithError($message);
    }

    /**
     * set the status code
     *
     * @param  integer  $statusCode
     * @return void
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * get the status Code
     *
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

}

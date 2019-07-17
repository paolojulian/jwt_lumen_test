<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

// Helpers
use App\Http\Helper\ResponseBuilder;

class Controller extends BaseController
{
    //

    /**
     * JSON error response
     * @param data - data to be passed
     * @param statusCode - statusCode of the http response
     */
    public function errorResponse($msg="", $data = [], $statusCode = 500)
    {
        Log::debug($msg);
        return response()->json($data, $statusCode);
    }

    /**
     * JSON success response
     * @param data - data to ba passed
     * @param statusCode - http response code
     */
    public function successResponse($data=[], $statusCode=200)
    {
        $load = ResponseBuilder::result(true, '', $data);
        return response()->json($load, $statusCode);
    }

    /**
     * JSON success response
     */
    public function notFoundResponse()
    {
        return response()->json([], 404);
    }

    public function unauthorizedResponse()
    {
        abort(401);
    }

    /**
     * Response for a successfully created object
     * @param name - name of the object
     * @param data - data to be passed
     */
    public function successCreateResponse($name, $data=[])
    {
        $info = $name ? "$name has been successfully created!": '';
        $load = ResponseBuilder::result(true, $info, $data);
        return response()->json($load, 201);
    }

    /**
     * Response for a successfully updated object
     * @param name - name of the object
     * @param data - data to be passed
     */
    public function successUpdateResponse($name, $data=[])
    {
        $info = $name ? "$name has been successfully updated!": '';
        $load = ResponseBuilder::result(true, $info, $data);
        return response()->json($load, 200);
    }

    /**
     * Response for a successfully created object
     * @param name - name of the object
     */
    public function successDeleteResponse($name)
    {
        $info = $name ? "$name has been successfully deleted!": '';
        $load = ResponseBuilder::result(true, $info);
        return response()->json($load, 410);
    }
}

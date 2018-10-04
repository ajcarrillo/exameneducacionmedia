<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 20/04/18
 * Time: 12:31
 */

namespace ExamenEducacionMedia\Traits;

use Illuminate\Http\Response;

trait ResponseTrait
{

    /**
     * Status code of response
     *
     * @var int
     */
    protected $statusCode = 200;

    protected $exception = NULL;

    public function getException()
    {
        return $this->exception;
    }

    public function setException($exception)
    {
        $this->exception = $exception;

        return $this;
    }

    /**
     * Getter for statusCode
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Setter for statusCode
     *
     * @param int $statusCode Value to set
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Send custom data response
     *
     * @param $status
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendCustomResponse($status, $message)
    {
        return response()->json([ 'status' => $status, 'message' => $message ], $status);
    }

    /**
     * Send this response when api user provide fields that doesn't exist in our application
     *
     * @param $errors
     * @return mixed
     */
    public function sendUnknownFieldResponse($errors)
    {
        return response()->json(([ 'status' => 400, 'unknown_fields' => $errors ]), 400);
    }

    /**
     * Send this response when api user provide filter that doesn't exist in our application
     *
     * @param $errors
     * @return mixed
     */
    public function sendInvalidFilterResponse($errors)
    {
        return response()->json(([ 'status' => 400, 'invalid_filters' => $errors ]), 400);
    }

    /**
     * Send this response when api user provide incorrect data type for the field
     *
     * @param $errors
     * @return mixed
     */
    public function sendInvalidFieldResponse($errors)
    {
        return response()->json(([ 'status' => 400, 'invalid_fields' => $errors ]), 400);
    }

    /**
     * Send this response when a api user try access a resource that they don't belong
     *
     * @return string
     */
    public function sendForbiddenResponse()
    {
        return response()->json([ 'status' => 403, 'message' => 'Forbidden' ], 403);
    }

    /**
     * Send 404 not found response
     *
     * @param string $message
     * @return string
     */
    public function sendNotFoundResponse($message = '')
    {
        if ($message === '') {
            $message = 'The requested resource was not found';
        }

        return response()->json([ 'status' => 404, 'message' => $message ], 404);
    }

    /**
     * Send empty data response
     *
     * @return string
     */
    public function sendEmptyDataResponse()
    {
        return response()->json([ 'data' => new \StdClass() ], $this->statusCode);
    }

    public function respondeWithErrorsException()
    {
        $errors           = [ 'error' => $this->exception->getMessage(), 'trace' => $this->exception->getTraceAsString() ];
        $this->statusCode = Response::HTTP_EXPECTATION_FAILED;

        return $this->respondWithArray(compact('errors'));
    }

    /**
     * Return a json response from the application
     *
     * @param array $array
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithArray(array $array, array $headers = [])
    {
        return response()->json($array, $this->statusCode, $headers);
    }

}

<?php

namespace Modules\Infrastructure\Exceptions;

use Exception;

abstract class AbstractGitReposException extends Exception
{
    protected $statusCode;
    protected $errorcode;
    protected $message;

    abstract protected function setErrorCode(int $statusCode);
    abstract protected function setStatusCode(int $statusCode);
    abstract protected function setMessage(string $message);

    /**
     * class construct.
     *
     * @param string $message
     * @param integer $statusCode
     */
    public function __construct(string $message, int $statusCode)
    {
        $this->setErrorCode($statusCode)
            ->setStatusCode($statusCode)
            ->setMessage($message);

        parent::__construct();
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        $data = array(
            'code'      => $this->errorcode,
            'message'   => $this->message
        );

        return response()->json($data, $this->statusCode);
    }
}

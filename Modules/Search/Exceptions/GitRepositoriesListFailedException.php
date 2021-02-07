<?php

namespace Modules\Search\Exceptions;

use Illuminate\Http\Response;
use Modules\Infrastructure\Exceptions\AbstractGitReposException;

class GitRepositoriesListFailedException extends AbstractGitReposException
{
    /**
     * set error code.
     *
     * @param integer $statusCode
     * @return GitRepositoriesListFailedException
     */
    protected function setErrorCode(int $statusCode)
    {
        $this->errorcode = $statusCode;
        return $this;
    }

    /**
     * set code status.
     *
     * @param integer $statusCode
     * @return GitRepositoriesListFailedException
     */
    protected function setStatusCode(int $statusCode)
    {
        $this->statusCode =$statusCode;
        return $this;
    }

    /**
     * set error mssage.
     *
     * @param string $message
     * @return GitRepositoriesListFailedException
     */
    protected function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }
}
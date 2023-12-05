<?php

namespace Core\BoundedContext\Course\Domain\Exception;

use Core\Shared\Domain\Exception\DomainException;
use Throwable;

class CourseNotFound extends DomainException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $message = $message === "" ? "Course Not Found" : $message;
        parent::__construct($message, $code, $previous);
    }
}

<?php

namespace Core\BoundedContext\Course\Domain\Exception;

use Core\Shared\Domain\Exception\DomainException;
use Throwable;

class CourseAlreadyExists extends DomainException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $message = "" === $message ? "Course already exists" : $message;

        parent::__construct($message, $code, $previous);
    }
}

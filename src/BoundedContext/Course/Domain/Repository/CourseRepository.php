<?php

namespace Core\BoundedContext\Course\Domain\Repository;

use Core\BoundedContext\Course\Domain\Course;
use Core\BoundedContext\Course\Domain\Courses;
use Core\BoundedContext\Course\Domain\ValueObjects\CourseId;

interface CourseRepository
{
    public function list(): Courses;
    public function save( Course $course ): void;
    public function find( CourseId $id ): ?Course;
    public function delete( CourseId $id ): void;
}

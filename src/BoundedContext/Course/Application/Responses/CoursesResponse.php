<?php

namespace Core\BoundedContext\Course\Application\Responses;

use Core\BoundedContext\Course\Domain\Courses;

class CoursesResponse
{
    /**
     * @param CourseResponse[] $courses
     */
    public function __construct( private readonly array $courses ) { }
    public static function fromCourses( Courses $courses ): self
    {
        $courseResponses = array_map(function ( $course ) {
            return CourseResponse::fromCourse( $course );
        }, $courses->all());

        return new self( $courseResponses );
    }
    public function toArray(): array
    {
        return array_map( function ( CourseResponse $response ) {
            return $response->toArray();
        }, $this->courses);
    }
}

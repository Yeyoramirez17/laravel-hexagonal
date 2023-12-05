<?php
declare(strict_types=1);

namespace Core\BoundedContext\Course\Infrastructure\Persistence\Eloquent;

use Core\Shared\Infrastructure\Persistence\Eloquent\EloquentException;
use Core\BoundedContext\Course\Domain\{
    Course,
    Courses,
    Exception\CourseAlreadyExists,
    Exception\CourseNotFound,
    Repository\CourseRepository as CourseRepositoryContract,
    ValueObjects\CourseId};
use Illuminate\Support\Facades\DB;
use Exception;

class CourseRepository implements CourseRepositoryContract
{

    public function __construct(
        private CourseModel $model
    ) { }

    private function toDomain( CourseModel $eloquentCourseModel ): Course
    {
        return Course::fromPrimitives(
            $eloquentCourseModel->id,
            $eloquentCourseModel->name
        );
    }
    public function list(): Courses
    {
        $eloquentCourses = $this->model->all();

        $courses = $eloquentCourses->map( function ( CourseModel $eloquentCourse ) {
            return $this->toDomain( $eloquentCourse );
        })->toArray();

        return new Courses( $courses );
    }

    /**
     * Create or Update a Course en Database.
     *
     * @param \Core\BoundedContext\Course\Domain\Course $course
     * @throws EloquentException
     */
    public function save(Course $course): void
    {
        $courseModel = $this->model->find( $course->id()->value() );

        if ( null === $courseModel )
        {
            $courseModel = new CourseModel();
            $courseModel->id = $course->id()->value();
        }
        $courseModel->name = $course->name()->value();

        DB::beginTransaction();
        try {
            $courseModel->save();
            DB::commit();
        } catch ( Exception $ex ) {
            DB::rollBack();
            throw new EloquentException(
                $ex->getMessage(),
                $ex->getCode(),
                $ex->getPrevious()
            );
        }
    }

    public function find(CourseId $id): ?Course
    {
        $courseModel = $this->model->find( $id->value() );

        if( null === $courseModel ) return null;

        return $this->toDomain( $courseModel );
    }

    /**
     * @param CourseId $id
     * @return void
     * @throws CourseNotFound
     */
    public function delete(CourseId $id): void
    {
        $course = $this->model->find( $id->value() );

        if ( null === $course )
        {
            throw new CourseNotFound();
        }

        $course->delete();
    }
}

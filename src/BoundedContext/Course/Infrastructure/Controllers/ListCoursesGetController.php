<?php

namespace Core\BoundedContext\Course\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Core\BoundedContext\Course\Application\Actions\ListCourses;
use Core\BoundedContext\Course\Infrastructure\Persistence\Eloquent\CourseRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ListCoursesGetController extends Controller
{
    public function __construct(
        private CourseRepository $repository
    ) { }

    public function __invoke(): JsonResponse
    {
       $coursesResponse = ( new ListCourses($this->repository) ) ();
       return new JsonResponse([
           'courses' => $coursesResponse->toArray()
       ], Response::HTTP_OK);
    }
}

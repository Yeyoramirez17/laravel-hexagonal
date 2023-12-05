<?php

namespace Core\BoundedContext\Course\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Core\BoundedContext\Course\Application\Actions\CreateCourse;
use Core\BoundedContext\Course\Domain\Exception\CourseAlreadyExists;
use Core\BoundedContext\Course\Infrastructure\Persistence\Eloquent\CourseRepository;
use Core\Shared\Domain\Utils\UuidGenerator;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

final class CreateCoursePostController extends Controller
{
    public function __construct(
        private UuidGenerator $uuidGenerator,
        private CourseRepository $repository,
    ) { }

    /**
     * @throws CourseAlreadyExists
     */
    public function __invoke(Request $request ): JsonResponse
    {
        $id = $request->get('id', $this->uuidGenerator->generate() );

        $courseResponse = ( new CreateCourse($this->repository) )(
            $id,
            $request->get('name')
        );

        return new JsonResponse([
            'course' => $courseResponse->toArray()
        ], Response::HTTP_OK );
    }
}

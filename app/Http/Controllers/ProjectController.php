<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projects\CreateProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;
use App\Http\Requests\Projects\DeleteProjectRequest;
use App\Http\Requests\Projects\GetProjectRequest;
use App\Http\Requests\Projects\SearchProjectsRequest;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    public function create(CreateProjectRequest $request, ProjectService $service): JsonResponse
    {
        $data = $request->onlyValidated();

        $result = $service->create($data);

        return response()->json($result);
    }

    public function get(GetProjectRequest $request, ProjectService $service, $id): JsonResponse
    {
        $result = $service
            ->with($request->input('with', []))
            ->withCount($request->input('with_count', []))
            ->find($id);

        return response()->json($result);
    }

    public function search(SearchProjectsRequest $request, ProjectService $service): JsonResponse
    {
        $result = $service->search($request->onlyValidated());

        return response()->json($result);
    }

    public function update(UpdateProjectRequest $request, ProjectService $service, $id): Response
    {
        $service->update($id, $request->onlyValidated());

        return response('', Response::HTTP_NO_CONTENT);
    }

    public function delete(DeleteProjectRequest $request, ProjectService $service, $id): Response
    {
        $service->delete($id);

        return response('', Response::HTTP_NO_CONTENT);
    }

}

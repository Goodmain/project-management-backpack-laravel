<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Http\Requests\Tasks\DeleteTaskRequest;
use App\Http\Requests\Tasks\GetTaskRequest;
use App\Http\Requests\Tasks\SearchTasksRequest;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function create(CreateTaskRequest $request, TaskService $service): JsonResponse
    {
        $data = $request->onlyValidated();

        $result = $service->create($data);

        return response()->json($result);
    }

    public function get(GetTaskRequest $request, TaskService $service, $id): JsonResponse
    {
        $result = $service
            ->with($request->input('with', []))
            ->withCount($request->input('with_count', []))
            ->find($id);

        return response()->json($result);
    }

    public function search(SearchTasksRequest $request, TaskService $service): JsonResponse
    {
        $result = $service->search($request->onlyValidated());

        return response()->json($result);
    }

    public function update(UpdateTaskRequest $request, TaskService $service, $id): Response
    {
        $service->update($id, $request->onlyValidated());

        return response('', Response::HTTP_NO_CONTENT);
    }

    public function delete(DeleteTaskRequest $request, TaskService $service, $id): Response
    {
        $service->delete($id);

        return response('', Response::HTTP_NO_CONTENT);
    }

}

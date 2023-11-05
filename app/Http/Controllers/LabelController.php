<?php

namespace App\Http\Controllers;

use App\Http\Requests\Labels\CreateLabelRequest;
use App\Http\Requests\Labels\UpdateLabelRequest;
use App\Http\Requests\Labels\DeleteLabelRequest;
use App\Http\Requests\Labels\GetLabelRequest;
use App\Http\Requests\Labels\SearchLabelsRequest;
use App\Services\LabelService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LabelController extends Controller
{
    public function create(CreateLabelRequest $request, LabelService $service): JsonResponse
    {
        $data = $request->onlyValidated();

        $result = $service->create($data);

        return response()->json($result);
    }

    public function get(GetLabelRequest $request, LabelService $service, $id): JsonResponse
    {
        $result = $service
            ->with($request->input('with', []))
            ->withCount($request->input('with_count', []))
            ->find($id);

        return response()->json($result);
    }

    public function search(SearchLabelsRequest $request, LabelService $service): JsonResponse
    {
        $result = $service->search($request->onlyValidated());

        return response()->json($result);
    }

    public function update(UpdateLabelRequest $request, LabelService $service, $id): Response
    {
        $service->update($id, $request->onlyValidated());

        return response('', Response::HTTP_NO_CONTENT);
    }

    public function delete(DeleteLabelRequest $request, LabelService $service, $id): Response
    {
        $service->delete($id);

        return response('', Response::HTTP_NO_CONTENT);
    }

}

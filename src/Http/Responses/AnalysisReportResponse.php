<?php

namespace Ijpatricio\NovaLarastanTool\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;

class AnalysisReportResponse implements Responsable
{
    /**
     * @var string
     */
    private $errors;

    /**
     * AnalysisReportResponse constructor.
     *
     * @param array $errors
     */
    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        $json = [
            'data' => $this->errors,
        ];

        return response()->json($json);
    }
}

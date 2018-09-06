<?php

namespace Ijpatricio\NovaLarastanTool\Http\Controllers;

use Exception;
use LogicException;
use Illuminate\Routing\Controller;
use Ijpatricio\NovaLarastanTool\Services\CodeAnalyseService;
use Ijpatricio\NovaLarastanTool\Http\Responses\AnalysisReportResponse;

class AnalysisReportController extends Controller
{
    /**
     * Show the Larastan analysis report.
     *
     * @param CodeAnalyseService $codeAnalyseService
     * @return AnalysisReportResponse|\Illuminate\Http\JsonResponse
     */
    public function show(CodeAnalyseService $codeAnalyseService)
    {
        try {
            $errors = $codeAnalyseService->handle();
        } catch (LogicException $exception) {
            abort(400, $exception->getMessage());
        } catch (Exception $exception) {
            abort(500, $exception->getMessage());
        }

        return new AnalysisReportResponse($errors);
    }
}

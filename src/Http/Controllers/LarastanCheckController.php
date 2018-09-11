<?php

namespace Ijpatricio\NovaLarastanTool\Http\Controllers;

use Illuminate\Routing\Controller;
use NunoMaduro\Larastan\Console\CodeAnalyseCommand;
use Ijpatricio\NovaLarastanTool\Http\Responses\AnalysisReportResponse;

class LarastanCheckController extends Controller
{
    /**
     * Check if Larastan is installed.
     *
     * @return AnalysisReportResponse|\Illuminate\Http\JsonResponse
     */
    public function show()
    {
        if (class_exists(CodeAnalyseCommand::class)) {
            return response()->json([
                'success' => true,
            ]);
        }

        return response()->json([
            'success' => false,
        ], 200);
    }
}

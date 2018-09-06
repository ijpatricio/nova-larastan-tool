<?php

namespace Ijpatricio\NovaLarastanTool\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Ijpatricio\NovaLarastanTool\Services\FileContentsIntervalResolver;

class FileIntervalContentController extends Controller
{
    /**
     * Show a file contents interval/fragment.
     *
     * @param FileContentsIntervalResolver $fileContentsIntervalResolver
     * @return JsonResponse
     */
    public function show(FileContentsIntervalResolver $fileContentsIntervalResolver): JsonResponse
    {
        $filePath = request('fileName');
        $errorLine = (int) request('errorLine');
        abort_unless($errorLine > 0 && $filePath !== null,400, 'Invalid filename or error line.');

        try {
            $jsonArray = $fileContentsIntervalResolver->resolveIntervalFor($filePath, $errorLine);
        } catch (\LogicException $e) {
            return abort(400, $e->getMessage());
        }

        return response()->json($jsonArray);
    }
}

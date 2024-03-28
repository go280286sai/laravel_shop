<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Listeners\MessageEventListen;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GetFilesController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getFiles(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'path' => ['required', 'string', 'max:255'],
            ]);
            if ($validated['path'] == 'notification') {
                event(new MessageEventListen($validated['name']));

                return response()->json(['status' => 'ok'])->setStatusCode(200);
            }
            $this->upload($validated['name'], $validated['path'], $request->file('file'));
            Log::info('UploadImage:' . Auth::id());

            return response()->json(['status' => 'ok'])->setStatusCode(200);
        } catch
        (Exception $e) {
            Log::info('Error UploadImage:' . Auth::id());

            return response()->json(['status' => $request->file('file'),
                'error' => $e->getMessage()])->setStatusCode(400);
        }
    }

    /**
     * @param string $name
     * @param string $path
     * @param $data
     * @return void
     */
    public function upload(string $name, string $path, $data): void
    {
        $filename = $name . '.' . $data->extension();
        $data->storeAs('uploads/' . $path, $filename);
    }

}

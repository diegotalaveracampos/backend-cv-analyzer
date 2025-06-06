<?php

namespace App\Http\Controllers;

use App\Models\CV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CVController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        try {
            $file = $request->file('cv');
            $path = $file->store('cvs', 'public');

            $cv = CV::create([
                'original_name' => $file->getClientOriginalName(),
                'stored_path'   => $path,
            ]);

            return response()->json([
                'message' => 'CV uploaded successfully.',
                'cv'      => $cv,
            ], 201);

        } catch (\Throwable $e) {
            Log::error('CV Upload Error: ' . $e->getMessage());

            return response()->json([
                'message' => 'Upload failed.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function index()
    {
        $cvs = CV::all();

        return response()->json([
            'cvs' => $cvs,
        ]);
    }
}

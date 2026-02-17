<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrochureController extends Controller
{
    /**
     * Display the brochure page.
     */
    public function index()
    {
        return view('brochure');
    }

    /**
     * Handle the brochure download request.
     *
     * @param string $filename
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download($filename)
    {
        // Define allowed files for robustness
        $allowedFiles = [
            'tenamart_brochure_1.png',
            'tenamart_brochure_2.png'
        ];

        // Validating the file request
        if (in_array($filename, $allowedFiles)) {
            $path = public_path($filename);

            // Check if file exists in the public disk
            if (!file_exists($path)) {
                abort(404, 'File not found');
            }
            return response()->download($path);
        }

        abort(403);
    }
}

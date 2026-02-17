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
            'b2ff1712-1.png',
            'b2ff1712-2.png'
        ];

        // Validating the file request
        if (in_array($filename, $allowedFiles)) {
            $path = 'brochure/' . $filename;

            // Check if file exists in the public disk
            if (Storage::disk('public')->exists($path)) {
                return Storage::disk('public')->download($path);
            }
        }

        // Return 404 if file is not allowed or doesn't exist
        abort(404, 'File not found');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgreementController extends Controller
{
    public function terms()
    {
        return view('agreements.terms-of-service');
    }
    
    public function privacyPolicy()
    {
        return view('agreements.privacy-policy');
    }
    
    public function dataProcessing()
    {
        return view('agreements.data-processing');
    }
}

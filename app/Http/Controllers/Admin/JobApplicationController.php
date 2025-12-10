<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::with('job')->paginate(10);
        return view('admin.job_applications.index', compact('applications'));
    }
}

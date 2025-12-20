<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\wholesale;
use Illuminate\Http\Request;

class WholesaleController extends Controller
{
    public function index()
    {
        $wholesales = wholesale::latest()->paginate(15);
        return view('admin.wholesales.index', compact('wholesales'));
    }
    public function destroy(wholesale $wholesale)
    {
        $wholesale->delete();
        return redirect()->route('admin.wholesales.index')
            ->with('success', 'Message deleted successfully.');
    }
}

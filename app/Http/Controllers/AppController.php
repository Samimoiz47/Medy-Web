<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\App;

class AppController extends Controller
{
    public function index()
    {
        $apps = App::where('is_free', true)
                  ->orderBy('download_count', 'desc')
                  ->get();
        return view('apps.index', compact('apps'));
    }

    public function show($id)
    {
        $app = App::findOrFail($id);
        return view('apps.show', compact('app'));
    }

    public function download($id)
    {
        $app = App::findOrFail($id);
        $app->increment('download_count');
        
        return response()->json([
            'success' => true,
            'message' => 'Download started for ' . $app->name,
            'download_url' => $app->download_url
        ]);
    }
}

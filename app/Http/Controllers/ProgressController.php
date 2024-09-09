<?php

namespace App\Http\Controllers;
use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function update(Request $request, Progress $progress)
    {
        $progress->update(['is_completed' => $request->is_completed]);
        return response()->json(['status' => 'updated']);
    }
}

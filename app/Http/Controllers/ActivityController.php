<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of activities for the authenticated user.
     */
    public function index()
    {
        $activities = Activity::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('user.activities.index', compact('activities'));
    }

    /**
     * Display a listing of all activities for admin.
     */
    public function adminIndex()
    {
        $activities = Activity::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.activities.index', compact('activities'));
    }

    /**
     * Show a single activity detail.
     */
    public function show(Activity $activity)
    {
        // Check authorization
        if ($activity->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.activities.show', compact('activity'));
    }

    /**
     * Show a single activity detail for admin.
     */
    public function adminShow(Activity $activity)
    {
        $activity->load('user');
        return view('admin.activities.show', compact('activity'));
    }
}

<?php
namespace Rudestewing\ActivityLogger\Http\Controllers;

use App\Http\Controllers\Controller;
use Rudestewing\ActivityLogger\Models\ActivityLog;
use Yajra\DataTables\Facades\DataTables;

class ActivityLogController extends Controller
{
    public function index()
    {
        return view('activity-log::index');
    }

    public function show(ActivityLog $activityLog)
    {
        return view('activity-log::show', compact('activityLog'));
    }

    public function fetchData()
    {
        $query = ActivityLog::with([
            'causerable',
            'subjectable'
        ]);
        
        return DataTables::of($query)
            ->make(true);
    }
}
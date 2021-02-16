<?php

namespace Modules\Admin\Http\Controllers;

use App\Grids\ActivitiesGrid;
use App\Grids\ActivityLogGrid;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Activitylog\ActivityLogger;
use App\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ActivityLogGrid $activitiesGrid, Request $request)
    {
        $page_title = __(' Activity Log ');

        $query = Activity::with('causer');

        return $activitiesGrid
            ->create(compact('query', 'request'))
            ->renderOn('admin::grid.index', compact('page_title'));
    }
}

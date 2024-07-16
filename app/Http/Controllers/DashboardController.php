<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\Collections;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use App\Models\Flat;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $pendingCollections = Collections::where('status',0)->count();
        // $todayCollections = Collections::whereDate('date',Carbon::today())->sum('amount');
        // $thisMonthCollections = Collections::whereMonth('date', Carbon::now()->month)->whereYear('date', Carbon::now()->year)->sum('amount');
        
        // $totalProjects = Project::count();;
        // $totalUsers = User::count();
        // $totalClients = Client::count();
        // $totalFlats = Flat::count();
        // $flatSold = Flat::where('status',1)->count();
        // $flatUnsold = Flat::where('status',0)->count();
        // $flatDeliverd = Flat::where('deliveryStatus',1)->count();
        // ,compact("pendingCollections","totalProjects","totalUsers","totalClients","totalFlats","flatSold","flatUnsold","flatDeliverd","todayCollections","thisMonthCollections")

        return view('admin.index');
        
    }
}


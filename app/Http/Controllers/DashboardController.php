<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Artisan;

class DashboardController extends Controller
{

    public function Dashboard()
    {

        return view("Dashboard");
    }
    
   
    public function localcommands()
    {
        // Clear caches to avoid issues with configuration, routes, and views
        // \Artisan::call('optimize:clear');
    
        // Drop and re-run all migrations to ensure a fresh database
        \Artisan::call('migrate:fresh', [
            '--seed' => true
        ]);
    
      
        
    
        // Ensure the sessions table is created
        \Artisan::call('session:table');
        \Artisan::call('migrate');
    
        // Ensure cache tables are available (if using cache database driver)
        \Artisan::call('cache:table');
        \Artisan::call('migrate');
    
        // Clear and rebuild event cache
        \Artisan::call('event:clear');
        \Artisan::call('event:cache');
    
        // Flush session and set a success message
        \Session::flash('success_message', 'Successfully refreshed database.');
        \Session::flush();
    
        return redirect()->route('login');
    }
}

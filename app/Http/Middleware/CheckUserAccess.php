<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Route;
use App\Models\UserModule;
use App\Models\UserRoles;
use App\Models\UserAccessManages;
use Session;
use Illuminate\Support\Facades\Auth;

class CheckUserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {

            session::flash('error_message', 'Login to proceed');


            return redirect('admin');

        } else {

            $admin_type = Auth::user()->user_type;

            $userModulesArr = UserModule::get()->toArray();

            if ($admin_type != 1) {


                if (!empty($userModulesArr)) {
                    foreach ($userModulesArr as $userModulesAr) {

                        $userModulesAr_id = $userModulesAr['id'];
                        $userModulesAr_module_slug = $userModulesAr['module_slug'];


                        $UserAccessManagesCount = UserAccessManages::where('user_role_id', $admin_type)->where('module_id', $userModulesAr_id)->count();
                        if ($UserAccessManagesCount > 0) {

                            $userAccessArr[$userModulesAr_module_slug] = 1;

                        } else {

                            $userAccessArr[$userModulesAr_module_slug] = 0;

                        }

                        Session::put('userAccessArr', $userAccessArr);


                    }

                }




            } else {

                if (!empty($userModulesArr)) {
                    foreach ($userModulesArr as $userModulesAr) {

                        $userModulesAr_id = $userModulesAr['id'];
                        $userModulesAr_module_slug = $userModulesAr['module_slug'];

                        $userAccessArr[$userModulesAr_module_slug] = 1;

                        Session::put('userAccessArr', $userAccessArr);

                    }
                }
            }


            // dd($userModulesArr);

        }

        return $next($request);


    }
}

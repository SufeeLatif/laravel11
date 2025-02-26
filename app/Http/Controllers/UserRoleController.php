<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRoles;
use App\Models\UserModule;
use App\Models\UserAccessManages;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use Stevebauman\Location\Facades\Location;


use Illuminate\Foundation\Validation\ValidatesRequests; // <-- This is the important one


class UserRoleController extends Controller
{

    /*userRoleAccess*/
    public function userRoleAccess(Request $request, $id = null)
    {


        if ($request->isMethod('post')) {

            $data = $request->all();


            if (!empty($data['access'])) {
                UserAccessManages::where("user_role_id", $data['userID'])->delete();

                foreach ($data['access'] as $access) {

                    $UserAccessManages = new UserAccessManages();
                    $UserAccessManages->user_role_id = $data['userID'];
                    $UserAccessManages->module_id = $access;
                    $UserAccessManages->save();
                }

                $message = "Updated successfully";

                Session::flash("success_message", $message);
                return redirect()->back();
            } else {

                UserAccessManages::where("user_role_id", $data['userID'])->delete();

                $message = "Updated successfully";

                Session::flash("success_message", $message);
                return redirect()->back();

            }


        }


        $UserRoles = UserRoles::find($id);
        $UserModule = UserModule::select('module_parent')->distinct()->get()->toArray();
        $UserModule1 = UserModule::select('module_parent')->distinct()->get()->toArray();
        $UserModuleUnique = UserModule::distinct()->pluck('module_parent');

        return view('UserRole.userRoleAccess')->with(compact('UserRoles', 'UserModule', 'UserModule', 'UserModuleUnique'));


    }


    public function index(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {

            if ($id == "") {


                $UserRoles = new UserRoles();
                $message = "Addedd Successfully";

            } else {


                $UserRoles = UserRoles::find($id);
                $message = "Updated Successfully";

            }


            $data = $request->all();


            $validatedData = $request->validate([
                'title' => 'required|max:255',
            ]);

            $UserRoles->title = $data['title'];
            if ($id == "") {

                $UserRoles->created_by = Auth()->user()->id;

            } else {


                $UserRoles->updated_by = Auth()->user()->id;
                $UserRoles->updated_at = date('Y-m-d H:m:s');


            }

            $UserRoles->save();


            session::flash('success_message', $message);
            return redirect()->route('userRole');
        }
        $UserRoles = UserRoles::orderby('id', 'desc')->where('deleted', 0)->where('id', '>', 2)->get()->toArray();

        return view('UserRole.index')->with(compact('UserRoles'));
    }


    /*userCheckRole*/
    public function userCheckRole(Request $request)
    {

        $data = $request->all();
        $titleCount = UserRoles::where('title', $data['title'])->where('deleted', 0)->count();
        if ($titleCount > 0) {
            return "false";
        } else {
            return "true";
        }

    }


    /*deleteUserAjax*/
    public function delete(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {

            $dataArr = $request->all();


            $returnAffected = UserRoles::where('id', $dataArr['deleteId'])->update(['deleted' => 1, 'updated_by' => Auth::user()->id]);

            if ($returnAffected === 0) {
                $message = "Some Issue Occurs try later";
                return response()->json(array(
                    'status' => false,
                    'message' => $message,
                ));
            }

            $message = "Deleted successfully";

            return response()->json(array(
                'status' => true,
                'message' => $message,
                'returnAffected' => $returnAffected,
            ));

        } else {
            $message = "Some Issue Occurs try later";
            return response()->json(array(
                'status' => false,
                'message' => $message,
            ));
        }


    }
}

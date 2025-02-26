<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRoles;
use App\Models\UserModule;
use App\Models\UserAccessManages;
use Session;



class UserRoleController extends Controller
{

    /*userRoleAccess*/
    public function userRoleAccess(Request $request, $id = null)
    {


        if ($request->isMethod('post')) {

            $data = $request->all();

//            echo "<PRE>";
//            print_r($data);
//            exit;

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

//                $message = "Choose any access please.";
//                session::flash('error_message', $message);
//                return redirect()->back();
            }


        }


        $UserRoles = UserRoles::find($id);
//      $userRoles = UserRoles::where('id',$id)->first();

        $UserModule = UserModule::select('module_parent')->distinct()->get()->toArray();

//        echo "<PRE>";print_r($UserModule);exit;

        $UserModule1 = UserModule::select('module_parent')->distinct()->get()->toArray();

        $UserModuleUnique = UserModule::distinct()->pluck('module_parent');

//        echo "<PRE>";print_r($UserModuleUnique);exit;

        return view('UserRole.userRoleAccess')->with(compact('UserRoles', 'UserModule', 'UserModule','UserModuleUnique'));


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
// //            echo "<PRE>";print_r($data);exit;

//             $rules = array(
//                 'title' => 'required|max:255',
//             );


//             $this->validate($request, $rules);

// //            echo "<PRE>";print_r($data);exit;

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
        $UserRoles = UserRoles::orderby('id', 'desc')->where('id', '>', 2)->get()->toArray();

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
}

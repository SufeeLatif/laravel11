<?php

namespace App\Http\Controllers;

use App\Models\UserRoles;
use App\Models\User;
use Illuminate\Http\Request;
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


class UserController extends Controller
{

    use ValidatesRequests;  // Add this line

    /* toggleTheme */
    public function toggleTheme(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(["status" => "error", "message" => "Unauthorized"], 401);
        }

        $user = Auth::user();
        $user->theme = $request->theme; // Set theme to 1 (Dark) or 0 (Light)
        $user->save();

        return response()->json(["status" => "success", "theme" => $user->theme]);
    }

    /* createUpdate */
    public function createUpdate(Request $request, $id = null)
    {
        // If there is no ID, this means we are creating a new user
        if ($id == "") {
            $user = new User();
            $message = "Created Successfully...";
        } else {
            // If there's an ID, we are updating an existing user
            $user = User::find($id);
            $message = "Updated Successfully...";
        }

        // Check if the form is submitted via POST
        if ($request->isMethod('post')) {


            $data = $request->all();

            // dd($data);

            // Define validation rules
            $rules = [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'mobile' => 'required',  // assuming a limit of 15 digits for phone number
            ];

            // If creating a new user, add these rules
            if ($id == "") {
                $rules['email'] = 'required|email|max:255|unique:users,email';
                $rules['password'] = 'required|min:6';
                $rules['password_confirm'] = 'required|same:password';  // confirm password match
            }

            // Validate the request data
            $this->validate($request, $rules);

            // Fill the model with the validated data
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->user_type = $data['user_role'];

            if ($id == "") {
                $user->email = $data['email'];
                $user->unique_in = Str::lower(implode('-', str_split(Str::random(16), 4)));

            }

            $user->mobile = $data['mobile'];

            $slug = Str::slug($data['first_name'] . ' ' . $data['last_name'], '-');
            $existingSlugs = User::where('name', 'like', $slug . '%')->pluck('name')->toArray();

            if (in_array($slug, $existingSlugs)) {
                $count = 1;
                while (in_array($slug . '-' . $count, $existingSlugs)) {
                    $count++;
                }
                $slug = $slug . '-' . $count;
            }

            $user->name = $slug;


            if (isset($data['password']) && !empty($data['password'])) {

                $user->password = bcrypt($data['password']);
            }


            // Handle image upload if provided
            if ($request->hasFile('avatar')) {

                $avatar = $request->file('avatar');
                $extension = $avatar->getClientOriginalExtension();
                $filename = time() . '.' . $extension;

                // Define the directory
                $directory = public_path('uploads/profile_img');

                // Create the directory if it doesn't exist
                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true); // recursive directory creation
                }

                // Move the uploaded file to the directory
                $avatar->move($directory, $filename);

                // Save the image path to the user's avatar field
                $user->image = $filename;
            }


            $user->save();

            // Redirect with a success message
            return redirect()->route('userList')->with('success_message', $message);
        }

        $UserRoles = UserRoles::orderby('id', 'desc')->where('id', '>', 2)->get()->toArray();

        // Return the view with data (if editing, send the user data)
        return view('User.createUpdate', compact('user', 'UserRoles'));
    }


    /**
     * Display a listing of the resource (if applicable).
     */
    public function index()
    {


        if (Session::get('userAccessArr')['userList'] == 0 || Session::get('userAccessArr')['userList'] == null) {

            $message = "You don't have access to it contact with admin thanks";
            session::flash('error_message', $message);

            return redirect()->route('Dashboard');


        }

        return view('User.index');

    }


    /* userListDatatable */
    public function listDatatable()
    {

        $data = User::with('user_roles')->orderBy('id', 'desc')->where('user_type', '>', 2)->where('deleted', 0);
        $data = $data->get()->toArray();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                // Check if the status is active (1) or not (0)
                $statusChecked = $row['status'] == 1 ? 'checked' : '';

                // Generate the HTML for the custom switch with the appropriate checked status
                $status = '
                <div class="media-body icon-state switch-outline">
                    <label class="custom-switch">
                        <input type="checkbox" name="statusUpdate" class="custom-switch-input" data-id="' . $row['id'] . '" ' . $statusChecked . '>
                        <span class="custom-switch-indicator custom-switch-indicator-lg"></span>
                    </label>
                </div>';

                return $status;
            })

            ->addColumn('action', function ($row) {
                $btn = "";

                if (Session::get('userAccessArr')['userUpdate'] && Session::get('userAccessArr')['userUpdate'] == 1) {

                    $btn .= ' &nbsp; <a href="' . Route('userUpdate') . '/' . $row['id'] . '" title="Edit"><i class="fa fa-edit fa-2x"></i></a>';


                }
                if (Session::get('userAccessArr')['userDelete'] && Session::get('userAccessArr')['userDelete'] == 1) {

                    $btn .= ' &nbsp;<a title="Delete" href="javascript:void(0)" class="confirmDeleteIt"  data-id="' . $row['id'] . '"> <i class="fa fa-trash fa-2x"></i></a>';


                }


                return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);


    }

    /* status */
    public function status(Request $request, $id)
    {
        // Find the user by ID
        $user = User::find($id);

        if ($user) {
            // Update the user's status based on the request
            $user->status = $request->input('status');
            $user->save();

            return response()->json(['success' => true, 'success_message' => 'Status Updated']);

        }

        return response()->json(['success' => false, 'error_message' => 'User not found']);
    }

    /**
     * Handle user login using the Auth facade.
     */
    public function login1(Request $request)
    {
        if ($request->isMethod('post')) {

            // Validate input fields
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            // Check user credentials
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {


                // Check if the user is active
                $user = Auth::user();
                if ($user->status == 0) {
                    Auth::logout(); // Log out the user if inactive
                    return back()->withErrors([
                        'email' => 'Your account is inactive. Please contact support.',
                    ]);
                }

                User::where('id', Auth::user()->id)->where('deleted', 0)->update(['logged_in' => 1, 'logged_in_at' => date('Y-m-d h:m:s')]);

                $ip = $request->ip(); /*Dynamic IP address*/

                $currentUserInfo = Location::get($ip);
                $currentUserInfo = json_decode(json_encode($currentUserInfo), true);

                User::where('id', Auth::user()->id)->where('deleted', 0)->update(['location_sign_in' => $currentUserInfo]);

                $message = "Successfully logged in...";
                session::flash('success_message', $message);
                return redirect()->route('Dashboard');

            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->withInput($request->except('password'));

        }
    }
    public function login(Request $request)
    {

        if (Auth::check()) {

            return redirect()->route('Dashboard');
        }

        if ($request->isMethod('post')) {

            // Validate input fields
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            // Check user credentials
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {


                // Check if the user is active
                $user = Auth::user();
                if ($user->status == 0) {
                    Auth::logout(); // Log out the user if inactive
                    return back()->withErrors([
                        'email' => 'Your account is inactive. Please contact support.',
                    ]);
                }

                User::where('id', Auth::user()->id)->where('deleted', 0)->update(['logged_in' => 1, 'logged_in_at' => date('Y-m-d h:m:s')]);

                $ip = $request->ip(); /*Dynamic IP address*/

                $currentUserInfo = Location::get($ip);
                $currentUserInfo = json_decode(json_encode($currentUserInfo), true);

                User::where('id', Auth::user()->id)->where('deleted', 0)->update(['location_sign_in' => $currentUserInfo]);

                $message = "Successfully logged in...";
                session::flash('success_message', $message);
                return redirect()->route('Dashboard');

            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->withInput($request->except('password'));

        }

        return view('login');

    }


    /* loginEmail */
    public function loginEmail(Request $request)
    {
        $data = $request->all();
        $emailCount = User::where('email', $data['email'])->where('deleted', 0)->count();
        if ($emailCount == 0) {
            return "false";
        } else {
            return "true";
        }
    }


    /* registerEmail */
    public function registerEmail(Request $request)
    {
        $data = $request->all();
        $emailCount = User::where('email', $data['email'])->where('deleted', 0)->count();
        if ($emailCount > 0) {
            return "false";
        } else {
            return "true";
        }
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {

            // Validate input fields
            $request->validate(
                [
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email',
                    'password' => 'required|string|min:6',
                    'cpassword' => 'required|string|min:6|same:password',
                ],
                [
                    'cpassword.same' => 'The confirmation password must match the password.',
                    'cpassword.required' => 'Please confirm your password.',
                ]
            );

            // Sanitize and format names
            $firstName = Str::title(trim($request->first_name));  // Properly format first name
            $lastName = Str::title(trim($request->last_name));    // Properly format last name


            $baseSlug = Str::slug(Str::of($firstName)->append(' ', $lastName)); // Generate base slug

            // Ensure the slug is unique
            $slug = $baseSlug;
            $count = 1;

            while (User::where('name', $slug)->exists()) {
                $slug = $baseSlug.'-'.$count;  // Append a number if slug exists
                $count++;
            }


            // Create the user instance and save to the database
            $user = new User();
            $user->first_name = $firstName;
            $user->last_name = $lastName;
            $user->name = $slug;
            $user->user_type = 3;
            $user->email = trim($request->email);  // Clean the email input
            $user->password = Hash::make($request->password);  // Securely hash the password
            $user->unique_in = Str::lower(implode('-', str_split(Str::random(16), 4)));




            // Save the user to the database
            $user->save();


            $ip = $request->ip(); /*Dynamic IP address*/

            $currentUserInfo = Location::get($ip);
            $currentUserInfo = json_decode(json_encode($currentUserInfo), true);

            User::where('id', $user->id)->where('deleted', 0)->update(['location_sign_up' => $currentUserInfo]);



            /* emailData */
            $emailData = array(
                'user' => $user
            );
            /*Send confirmation email*/
            Mail::send('emails.registerEmail', $emailData, function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Admitro - Register Account')
                    ->cc(env('CC_EMAIL'), env('CC_EMAIL_NAME'))
                    ->bcc(env('BCC_EMAIL'), env('BCC_EMAIL_NAME'));
            });

            // return view('emails.registerEmail',compact('user'));

            return redirect()->route('login')->with('success_message', 'Account created successfully. Please check your email to confirm your account.');

        }

        return view('register');

    }


    /* registerConfirm*/
    public function registerConfirm($code)
    {
        $email = base64_decode($code);


        $user = User::where('email', $email)->where('deleted',0)->first();

        if (!$user) {
            return redirect()->route('login')->with('message_warning', 'Invalid confirmation link.');
        }

        if ($user->email_verified_at) {
            return redirect()->route('login')->with('success_message', 'Your account is already verified.');
        }

        // Mark the user's email as verified
        $user->email_verified_at = now();
        $user->status = 1;
        $user->save();

        // Redirect to login with success message
        return redirect()->route('login')->with('success_message', 'Your account has been successfully verified. Please log in.');
    }



    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {


        User::where('id', Auth::user()->id)->where('deleted', 0)->update(['logged_in' => 0, 'logged_out_at' => date('Y-m-d h:m:s')]);

        Auth::logout();
        Session::flush();


        Session::flush();
        $message = "Successfully logged OUT...";
        session::flash('success_message', $message);

        return redirect()->route('login');

    }

    /* forgotPassword */
    
    public function forgotPassword(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                ? back()->with('success_message', 'Reset link sent to your email.')
                : back()->withErrors(['email' => __($status)]);

        }
        return view('User.forgotPassword');

    }

    // Show Reset Password Form
    public function showResetPasswordForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    // Handle Password Reset Submission
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password reset successfully.')
            : back()->withErrors(['email' => [__($status)]]);
    }



    /*deleteUserAjax*/
    public function delete(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {

            $dataArr = $request->all();


            $returnAffected = User::where('id', $dataArr['deleteId'])->update(['deleted' => 1, 'updated_by' => Auth::user()->id]);

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

    public function profile(Request $request)
    {
        // Get the logged-in user's data
        $user = Auth::user();



        if ($request->isMethod('post') && $request->hasFile('image')) {

            $rules = [
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            $this->validate($request, $rules);

            // Handle Image Upload
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $uploadPath = 'uploads/profile_img/';

            // Ensure directory exists
            if (!is_dir(public_path($uploadPath))) {
                mkdir(public_path($uploadPath), 0755, true);
            }

            // Move uploaded file
            $avatar->move(public_path($uploadPath), $filename);

            // Delete previous image if exists
            if (!empty($user->image) && file_exists(public_path($uploadPath . $user->image))) {
                unlink(public_path($uploadPath . $user->image));
            }

            // Update user image
            $user->image = $filename;
            $user->save();

            return redirect()->route('profile')->with('success_message', 'Profile updated successfully!');
        }



        if ($request->isMethod('post')) {


            
            $formType = $request->input('form_type');
            if ($formType === 'profile_update') {

                $rules = [
                    'first_name' => 'required|max:255',
                    'last_name' => 'required|max:255',
                    'mobile' => 'required',
                    'email' => 'required|email|max:255'

                ];

                $this->validate($request, $rules);

                // Get the form data
                $data = $request->all();

                $user->first_name = $data['first_name'];
                $user->last_name = $data['last_name'];
                $user->mobile = $data['mobile'];
                $user->about_user = $data['about_user'];


                $user->save();
                return redirect()->route('profile')->with('success_message', 'Profile updated successfully!');

            }

            if ($formType === 'password_update') {

                // Validate input
                $request->validate([
                    'current_password' => 'required',
                    'new_password' => 'required|min:6',
                    'confirm_password' => 'required|same:new_password',
                ]);

                
                $user = Auth::user();

                // Check if current password matches
                if (!Hash::check($request->current_password, $user->password)) {
                    // echo "HERE";exit;
                    return back()->with('error_message', 'Current password is incorrect.');
                }

                // Update new password
                $user->password = Hash::make($request->new_password);
                $user->save();


                User::where('id', Auth::user()->id)->where('deleted', 0)->update(['logged_in' => 0, 'logged_out_at' => date('Y-m-d h:m:s')]);

                Auth::logout();
                Session::flush();

                
                return redirect()->route('login')->with('success_message', 'Password updated successfully! Please log in again.');

            }
        }


        return view('User.profile', compact('user'));
    }

    /* checkCurrentPassword */
    public function checkCurrentPassword(Request $request)
    {
        // dd($request->all());

        if (Auth::check()) {
            $isValid = Hash::check($request->current_password, Auth::user()->password);

            return response()->json($isValid); // Just return true or false
        }
    
        return response()->json(false, 401); // Unauthorized if not authenticated
    }
    


}

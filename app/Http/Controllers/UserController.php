<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Datatables;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Campus;
use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $user = DB::table('users')
            ->join('compuses', 'users.campus_id', '=', 'compuses.id')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*', 'compuses.name_en', 'roles.name')
            ->get();
            return Datatables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function($user) {
                    return '<a onclick="editForm('. $user->id .')" class="btn btn-primary btn-xs text-white"><i class="fa fa-edit"></i> Edit</a>' . ' <a onclick="deleteData('. $user->id .')" class="btn btn-danger btn-xs text-white"><i class="fa fa-trash"></i> Delete</a>';
                })->make(true);
        }

        $compuses = DB::table('compuses')->get();
        $role = DB::table('roles')->get();
        $user = DB::table('users')
            ->join('compuses', 'users.campus_id', '=', 'compuses.id')
            ->select('users.*', 'compuses.name_en')
            ->get();
        return view('user/user', [
            'compuses' => $compuses,
            'user' => $user,
            'role' => $role
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = DB::table('roles')->get();
        $compuses = DB::table('compuses')->get();
        return view('user/user_add', [
            'role' => $role,
            'compuses' => $compuses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'avatar' => 'mimes:jpeg,jpg,png,gif,svg'
        ]);

        $image = $request->file('avatar');
        
        if(isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('user'))
            {
                Storage::disk('public')->makeDirectory('user');
            }

            $postImage = Image::make($image)->resize(180,180)->stream();
            Storage::disk('public')->put('user/'.$imageName, $postImage);
        } else{
            $imageName = "default.png";
        }

        $user = new User;
        $user->campus_id = $request->campus_id;
        $user->role_id = $request->role_id;
        $user->fullname = $request->fullname;
        $user->name = $request->name;
        $user->email  = $request->email;
        $user->password  = Hash::make($request->password);
        $user->avatar = $imageName;
        $user->date_join  = Carbon::now()->toDateString();
        $user->status = 'active';
        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findorfail($id);
        $image = $request->file('img');

        if (isset($image)) {

            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('user'))
            {
                Storage::disk('public')->makeDirectory('user');
            }

            if(Storage::disk('public')->exists('user/'.$user->avatar))
            {
                Storage::disk('public')->delete('user/'.$user->avatar);
            }

            $postImage = Image::make($image)->stream();
            $upload = Storage::disk('public')->put('user/'.$imageName, $postImage);

            if ($upload) {
                $user->avatar = $imageName;
                $user->save();
            }

        } else {
            $user->campus_id = $request->campus;
            $user->role_id = $request->role;
            $user->fullname = $request->fname;
            $user->email = $request->email;
            $user->status = $request->status;
            $user->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Storage::delete('public/user' . '/' . $user->avatar);
        $user->delete();
    }

    public function viewFormChangePassword()
    {
        return view('auth/passwords/change_password');
    }

    public function ChangePassword(Request $request)
    {

        if($request->get('new_password') != $request->get('confirm_password')) {
            return back()->with('error', 'Your new password and confirm password dose not match !');
        }

        if(!(Hash::check($request->get('current_password'), Auth::user()->password))){
            return back()->with('error', 'Your current password does not match with what you provided !');
        }

        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
            return back()->with('error', 'Your current password cannot be same with the new password !');
        }

        $user = Auth::user();
        $user->password = Hash::make($request->get('new_password'));
        $user->save();
        return redirect()->route('dashboard.index');

    }
}

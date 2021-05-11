<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Rules\CurrentPassword;

class UserController extends Controller
{
    use SendsPasswordResetEmails;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'unique:users'
        ]);
        $rand = Str::random(12);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($rand),
            'role' => $request->role,
        ]);

        if($user){
            if (isset($request->send_email)) {
                $this->broker()->sendResetLink(
                    $request->only('email')
                );
            }
            return redirect()->route('user.index')->with('message', 'you have successfully added new user');
        }else{
            return redirect()->route('user.index')->with('message', 'sorry, you have unsuccessfully added new user');
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
        $user = User::find($id);
        if ($user->delete()) {
            return redirect()->route('user.index')->with('message', 'you have successfully deleted the user');
        }else{
            return redirect()->route('user.index')->with('message', 'sorry, you have unsuccessfully deleted the user');
        }
    }

    public function editPassword()
    {
        return view('password');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'old_password'=>['required',new CurrentPassword()],
            'password'=>'required|string|min:8',
        ]);

        $password = $request->password;
        $user = Auth::user();
        $user->password = Hash::make($password);
        if ($user->save()) {
            return redirect()->route('home')->with('message', 'you have successfully updated your password');
        }else{
            return redirect()->route('home')->with('message', 'sorry, you have unsuccessfully updated your password');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Session;
use Exception;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.role.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->profile()->create([
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
        ]);


        //Kiểm tra Insert để trả về một thông báo
        if ($user) {
            Session::flash('success', 'Add Successful !');
        } else {
            Session::flash('error', 'Add Failed !');
        }

        return redirect('admin/list-user');
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
        try
            {
            $users = User::findOrFail($id);
            return view('admin.role.edit', compact('users'));
        }
        catch (Exception $e)
            {
                return $e->getMessage();
            }
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
        try
            {
            $user = User::findOrFail($id);
            $user->update($request->all());
            $user->profile()->update([
                'phone' => $request->phone,
                'address' => $request->address,
                'gender' => $request->gender,

            ]);
            //Kiểm tra delete để trả về một thông báo
            if ($user) {
                Session::flash('success', 'Update Successful !');
            } else {
                Session::flash('error', 'Update Failed !');
            }
            }
        catch (Exception $e)
                {
                    return $e->getMessage();
                }
        return redirect('admin/list-user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
            {
                $users = User::findOrFail($id);
                $users->delete();
                //Kiểm tra delete để trả về một thông báo
                if ($users) {
                    Session::flash('success', 'Delete Successful !');
                }else {
                    Session::flash('error', 'Delete Failed !');
                }
            }
        catch (Exception $e)
            {
                return $e->getMessage();
            }
        return redirect('/admin/list-user');
    }
}

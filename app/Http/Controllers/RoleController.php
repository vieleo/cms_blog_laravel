<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Session;

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
    public function create($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
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
            $user->roles()->update([
                'role' => $request->role,
            ]);
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('personal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        //
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changename(Request $request)
    {
        $user = auth()->user();
        $newEmail = $request->get('name');
        $user->name = $newEmail;
        $user->save();
        return redirect()->route('personal');
    }

    public function changeemail(Request $request)
    {
        $user = auth()->user();
        $user->email = $request->get('email');
        $user->save();
        return redirect()->route('personal');
    }

    public function changepassword(Request $request)
    {
        $user = auth()->user();
        $oldPassword = $request->get('old_password');
        $newPassword = $request->get('new_password');
        
        if (Hash::check($oldPassword, $user->getAuthPassword())) {
            $user->password=Hash::make($newPassword);
            $user->save();
            return redirect()->route('personal');
        }
    }
}

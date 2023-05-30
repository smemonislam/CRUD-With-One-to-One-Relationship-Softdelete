<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->data['users'] = User::with('profile')->latest()->paginate(8);
        
        return view('user.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.created');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create([
            'username'  => $request->username, 
            'email'     => $request->email, 
            'password'  => $request->password, 
        ]);

        $user->profile()->create([
            'fname'     => $request->fname, 
            'lname'     => $request->lname, 
            'address'   => $request->address, 
            'phone'     => $request->phone, 
            'age'       => $request->age, 
        ]);

        return redirect()->back()->with(['message' => "Added successfully.", 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            'username'  => $request->username, 
            'email'     => $request->email, 
            'password'  => $request->password, 
        ]);

        $user->profile()->update([
            'fname'     => $request->fname, 
            'lname'     => $request->lname, 
            'address'   => $request->address, 
            'phone'     => $request->phone, 
            'age'       => $request->age,
        ]);

        return redirect()->route('user.index')->with(['message' => "Update successfully.", 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $delete = $user->delete();
        return redirect()->back()->with(['message' => "Delete successfully.", 'type' => 'success']);
    }

    public function trashed(){
        $trashed = User::with('profile')
        ->onlyTrashed()
        ->where('deleted_at', '!=', NULL)
        ->latest()
        ->paginate(5);
        return view('user.restore', compact('trashed'));
    }

    public function restore($id){

        $restore = User::withTrashed()->findOrFail($id);
        if($restore){
            $restore->restore();
        }                
        return redirect()->route('user.index')->with(['message' => "Restore successfully.", 'type' => 'success']);
    }

    public function delete($id){
        $delete = User::withTrashed()->findOrFail($id);
        if($delete){
            $delete->forceDelete();
        }                
        return redirect()->route('user.index')->with(['message' => "Delete successfully.", 'type' => 'warning']);
    }
}

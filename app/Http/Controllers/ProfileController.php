<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->data['profiles'] = Profile::with('user')->latest()->paginate(10);
        return view('profile.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.created');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $user = new User();
        // $user->username     = $request->username;
        // $user->email        = $request->email;
        // $user->password     = $request->password;
        // $user->save();

        // $profile = new Profile();
        // $profile->user_id   =  $user->id;
        // $profile->fname     = $request->fname;
        // $profile->lname     = $request->lname;
        // $profile->address   = $request->address;
        // $profile->phone     = $request->phone;
        // $profile->age       = $request->age;
        // $profile->save();

        $id = DB::table('users')->insertGetId(
            [
                'username'  => $request->username, 
                'email'     => $request->email, 
                'password'  => $request->password, 
            ]
        );

        $id = Profile::create(
            [
                'user_id'   => $id, 
                'fname'     => $request->fname, 
                'lname'     => $request->lname, 
                'address'   => $request->address, 
                'phone'     => $request->phone, 
                'age'       => $request->age, 
            ]
        );

        return redirect()->back()->with(['message' => "Added successfully.", 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        return view('profile.edit',compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $profile->update([
            'user_id'   => $profile->user_id,
            'fname'     => $request->fname, 
            'lname'     => $request->lname, 
            'address'   => $request->address, 
            'phone'     => $request->phone, 
            'age'       => $request->age,
            
        ]);

        $profile->user()->update([
            'username'  => $request->username, 
            'email'     => $request->email, 
            'password'  => $request->password, 
        ]);

        return redirect()->route('profile.index')->with(['message' => "Update successfully.", 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $delete = $profile->delete();
       
        return redirect()->back()->with(['message' => "Delete successfully.", 'type' => 'success']);
    }

    public function trashed(){
        $trashed = Profile::with('user')
        ->onlyTrashed()
        ->where('deleted_at', '!=', NULL)
        ->latest()
        ->paginate(5);
        return view('profile.restore', compact('trashed'));
    }

    public function restore($id){

        $restore = Profile::with('user')->withTrashed()->findOrFail($id);
        if($restore){
            $restore->restore();
        }                
        return redirect()->route('profile.index')->with(['message' => "Restore successfully.", 'type' => 'success']);
    }

    public function delete($id){
        $delete = Profile::withTrashed()->findOrFail($id);
        if($delete){
           $forceDelete = $delete->forceDelete();
            if($forceDelete){
                $delete->user()->delete();
            }
        }                
        return redirect()->route('profile.index')->with(['message' => "Delete successfully.", 'type' => 'warning']);
    }
}

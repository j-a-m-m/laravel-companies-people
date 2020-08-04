<?php

namespace App\Http\Controllers;

use App\User;
use App\UserNote;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select(['id', 'first_name', 'last_name', 'email'])->withCount('notes')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'first_name' => 'required|max:35',
            'last_name' => 'required|max:35',
            'email' => 'required|email:rfc,dns|max:255', // TODO validation on email field
            'password' => 'max:50', //TODO hash password
        ]);
        
        //Not sure if best practise to do the hashing here
        $password = $storeData['password'];
        $hashedPassword = Hash::make($password);
        $storeData['password'] = $hashedPassword;


        $user = User::create($storeData);

        return redirect('/users')->with('completed', 'User has been saved!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeNote($id, Request $request)
    {

        //
        $storeData = $request->validate([
            'message' => 'required|max:255',
        ]);
        $storeData['user_id'] = $id;
        $note = UserNote::create($storeData);

        return redirect('/users/'.$id)->with('completed', 'Note has been saved!');
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
        $user = User::where('id', '=', $id)->firstOrFail();
        $notes = User::find($user->id)->notes;
        return view('users.show', compact('user'), compact('notes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
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
        $updateData = $request->validate([
            'first_name' => 'required|max:35',
            'last_name' => 'required|max:35',
            'email' => 'required|email:rfc,dns|max:255',
            'password' => 'max:50',
        ]);

        //Not sure if best practise to do the hashing here
        // Tried to extract into private function but it didn't work
        $password = $updateData['password'];
        $hashedPassword = Hash::make($password);
        $updateData['password'] = $hashedPassword;

        User::whereId($id)->update($updateData);
        return redirect('/users')->with('completed', 'User has been updated');
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
        $user->delete();

        return redirect('/users')->with('completed', 'User has been deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyNote($user_id, $note_id)
    {
        //
        $userNote = UserNote::findOrFail($note_id);
        $userNote->delete();

        return redirect('/users/'.$user_id)->with('completed', 'Note has been deleted');
    }
}

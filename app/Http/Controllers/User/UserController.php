<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valdidator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email'=>['unique:users,email'],
            'password'=>'required'
        ]);

        if($valdidator->fails()){
            return response()->json([
                'messages' => $valdidator->errors(),
            ]);
        }

        $newUser = User::create([
            'nama' => $request->nama,
            'email' => $request->nama,
            'password' => Hash::make($request->password),
        ]);

        return $newUser;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(compact('user'));
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
        $valdidator = Validator::make($request->all(), [
            'name' => ['string', 'nullable'],
            'email'=>['unique:users,email', 'nullable'],
            'password'=>'nullable'
        ]);

        if($valdidator->fails()){
            return response()->json($valdidator->errors());
        }

        $updated = User::where('id', $id)->d($request);

        if(!$updated){
            return response()->json(['messages' => 'Update Gagal']);
        }else{
            return response()->json([
                'messages' => 'Update Berhasil',
                'data' => $updated
            ]);
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
        $deleted = User::findOrFail($id)->delete();
        if(!$deleted){
            return response()->json(['messages' => 'Update Gagal']);
        }else{
            return response()->json([
                'messages' => 'Delete Berhasil',
                'data' => $deleted
            ]);
        }
    }
}

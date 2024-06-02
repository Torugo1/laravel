<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;

class userController extends Controller
{
    public function index() {
        $users = User::all();
        return view('welcome', ['users' => $users]);
    }

    public function store(Request $request) {
        User::create($request->all());
        return redirect()->route('user-index');
    }

    public function edit($id) {
        $userInformation = User::where('id', $id)->first();
        if(!empty($userInformation)) {
            return response()->json($userInformation);
        } else {
            return redirect()->route('user-index');
        }
    }

    public function update(Request $request, $id) {
        $data = [
            'nome' => $request->nome,
            'email' => $request->email,
            'cidade' => $request->cidade,
            'idade' => $request->idade,
        ];
        User::where('id', $id)->update($data);
        return redirect()->route('user-index');
    }

    public function destroy($id) {
        User::where('id', $id)->delete();
        return redirect()->route('user-index');
    }
}

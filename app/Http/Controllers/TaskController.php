<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Konstmal\Separator\Separator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Log;

class TaskController extends Controller
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
        Log::info($request->all());

        $val = [
            'number' => 'required',
            'array' => 'required',
            'email' => 'required',
            'secret' => 'required'
        ];

        $v = Validator::make($request->all(), $val);

        if ($v->fails()) {
            return response()->json($v->errors(), 400);
        }

        $user = User::where('email', $request->input('email'))->first();

        if (is_null($user)) {
            return response()->json(['User not found'], 400);
        }

        $number = $request->input('number');
        $array = $request->input('array');

        //Calculate and validate the secret (hash of all input fields and user token)
        $secret = sha1($user->token.$number.implode(',', $array).$user->email);

        if ($secret != $request->input('secret')) {
            return response()->json(['Access denied'], 403);
        }

        $result = Separator::separate($array, $number);

        $user->tasks()->create([
            'number' => $number,
            'input' => $array,
            'output' => $result,
        ]);

        return response()->json([$result], 201);
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
        //
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\User;

use DB;

Class UserController extends Controller {
    use ApiResponser;
    private $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function getUsers()
    {
        $users = User::all();
        return $this->sucessResponse()->json($users,200);

    }
    public function index()
    {
        $users = User::all();
        return $this->successResponse($users);

    }
    public function add(Request $request)
    {
        $rules = [
            'NAME' => 'required|max:20',
            'AGE' => 'required|max:20',
            'GENDER' => 'required|in:male,female',
            
        ];
        $this->validate($request,$rules);
        $user = User::create($request->all());
        /*$user = User::create(['username'=> 'User111',
                              'password'=> 'pass111',
                              'gender'=> 'Male']);*/

        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    public function show($userID)
    {
    $user = User::findOrFail($userID);
    return $this->successResponse($user);
    
    // old code 
    /*
    $user = User::where('userid', $id)->first();
    if($user){
    return $this->successResponse($user);
    }
    {
    return $this->errorResponse('User ID Does Not Exists', 
   Response::HTTP_NOT_FOUND);
    }
    */
    }
    /**
    * Update an existing author
    * @return Illuminate\Http\Response
    */
    public function update(Request $request,$userID)
    {
    $rules = [
    'NAME' => 'max:20',
    'AGE' => 'max:20',
    'GENDER' => 'in:male,female',
    ];
    $this->validate($request, $rules);
    $user = User::findOrFail($userID);
    
    $user->fill($request->all());
// if no changes happen
if ($user->isClean()) {
    return $this->errorResponse('At least one value must 
   change', Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    $user->save();
    return $this->successResponse($user);
    
    // old code
    /*
    $this->validate($request, $rules);
    //$user = User::findOrFail($id);
    $user = User::where('userid', $id)->first();
    if($user){
    $user->fill($request->all());
    // if no changes happen
    if ($user->isClean()) {
    return $this->errorResponse('At least one value must 
   change', Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    $user->save();
    return $this->successResponse($user);
    }
    {
    return $this->errorResponse('User ID Does Not Exists', 
   Response::HTTP_NOT_FOUND);
    }
    */
    }
    /**
    * Remove an existing user
    * @return Illuminate\Http\Response
    */
    public function delete($userID)
    {
    $user = User::findOrFail($userID);
    $user->delete();
    return $this->successResponse($user);
 // old code 
 /*
 $user = User::where('userid', $id)->first();
 if($user){
 $user->delete();
 return $this->successResponse($user);
 }
 {
 return $this->errorResponse('User ID Does Not Exists', 
Response::HTTP_NOT_FOUND);
 }
 */
 }
}    
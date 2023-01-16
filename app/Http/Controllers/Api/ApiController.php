<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;



/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Laravel OpenApi Demo Documentation",
 *      description="L5 Swagger OpenApi description",
 * )
 */
class ApiController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/getAll",
     *      tags={"Users"},
     *      description="Returns All User",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function getAll(){
        $user = User::all();
        return response()->json(["total_user" => count($user) , "users" => $user]);
    }

    /**
     * @OA\Get(
     *      path="/api/getById",
     *      tags={"Users"},
     *      description="Returns User with by Id",
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *      @OA\Schema (
     *          type="integer"
     *      )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function getById(Request $request){
        $user = User::find($request->id);
        if (isset($user)){
            return response()->json(["user" => $user]);
        }
        return ('Bu id\'ye sahip kullanici Yok');
    }

    /**
     * @OA\POST(
     *      path="/api/create",
     *      tags={"Users"},
     *      description="Returns User with by Id",
     *      @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=true,
     *      @OA\Schema (
     *          type="string"
     *      )
     *      ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         required=true,
     *      @OA\Schema (
     *          type="string"
     *      )
     *      ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         required=true,
     *      @OA\Schema (
     *          format = "password"
     *      )
     *      ),
     *     @OA\Parameter(
     *         name="password_confirmation",
     *         in="query",
     *         required=true,
     *      @OA\Schema (
     *          format = "password"
     *      )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function create(Request $request){
        $rules = Validator::make($request->all(),
            [
                'name' => 'required  | min:3 | regex:/^[a-zA-Z şŞıİçÇöÖüÜĞğ]+$/',
                'email' => 'required | email | unique:users,email',
                'password' => ['required' , 'min:6' , 'confirmed' , 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z şŞıİçÇöÖüÜĞğ])(?=.*[0-9])(?=.*[\d\x])(?=.*[.,;₺!$#%]).*$/'],
            ]);
        if ($rules->fails()) {
            return response()->json(["Errors"=>$rules->messages()]);
        }
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
        return ('User olusturuldu');
    }
    /**
     * @OA\PUT(
     *      path="/api/update",
     *      tags={"Users"},
     *      description="Returns User with by Id",
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *      @OA\Schema (
     *          type="integer"
     *      )
     *      ),
     *      @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=true,
     *      @OA\Schema (
     *          type="string"
     *      )
     *      ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         required=true,
     *      @OA\Schema (
     *          type="string"
     *      )
     *      ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         required=true,
     *      @OA\Schema (
     *          format = "password"
     *      )
     *      ),
     *     @OA\Parameter(
     *         name="password_confirmation",
     *         in="query",
     *         required=true,
     *      @OA\Schema (
     *          format = "password"
     *      )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function update(Request $request){
        $user = User::find($request->id);
        if(isset($user)){
            $rules = Validator::make($request->all(),
                [
                    'name' => 'required  | min:3 | regex:/^[a-zA-Z şŞıİçÇöÖüÜĞğ]+$/',
                    'email' => 'required | email | unique:users,email,'.$user->id,
                    'password' => ['required' , 'min:6' , 'confirmed' , 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z şŞıİçÇöÖüÜĞğ])(?=.*[0-9])(?=.*[\d\x])(?=.*[.,;₺!$#%]).*$/'],
                ]);
            if ($rules->fails()) {
                return response()->json(["Errors"=>$rules->messages()]);
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            return ('Update edildi');
        }
        return ('Bu id\'ye sahip kullanici yok ');
    }













    public function createtwo($name,$email,$password,$password_confirmation){
        $request = ['name'=>$name,'email'=>$email,'password'=>$password,'password_confirmation'=>$password_confirmation];
        $rules = Validator::make($request,
            [
                'name' => 'required  | min:3 | regex:/^[a-zA-Z şŞıİçÇöÖüÜĞğ]+$/',
                'email' => 'required | email | unique:users,email',
                'password' => ['required' , 'min:6' , 'confirmed' , 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z şŞıİçÇöÖüÜĞğ])(?=.*[0-9])(?=.*[\d\x])(?=.*[.,;₺!$#%+]).*$/'],
            ]);
        if ($rules->fails()) {
            return response()->json(["Errors"=>$rules->messages()]);
        }
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();
        return ('Kullanıcı oluşruruldu');
        /* $request =['name'=>$name,'email'=>$email,'password'=>$password,'password_confirmation'=>$replay_password];
         return route('register-post',$request);*/
    }
    public function updatetwo($id,$name,$email,$password,$password_confirmation){
        $user = User::find($id);
        if(isset($user)){
            $request = ['name'=>$name,'email'=>$email,'password'=>$password,'password_confirmation'=>$password_confirmation];
            $rules = Validator::make($request,
                [
                    'name' => 'required  | min:3 | regex:/^[a-zA-Z şŞıİçÇöÖüÜĞğ]+$/',
                    'email' => 'required | email | unique:users,email,'.$user->id,
                    'password' => ['required' , 'min:6' , 'confirmed' , 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z şŞıİçÇöÖüÜĞğ])(?=.*[0-9])(?=.*[\d\x])(?=.*[.,;₺!$#%]).*$/'],
                ]);
            if ($rules->fails()) {
                return response()->json(["Errors"=>$rules->messages()]);
            }
            $user->name = $name;
            $user->email = $email;
            $user->password = bcrypt($password);
            $user->save();
            return ('Update edildi');
        }
        return ('Bu id\'ye sahip kullanıcı yok ');
    }
}

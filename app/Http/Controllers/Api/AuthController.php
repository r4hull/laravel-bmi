<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;

class AuthController extends Controller
{
    public function register(Request $req){

      $data = json_decode(file_get_contents('php://input'), true);


      $data['password']=bcrypt($req->input('password'));

      $user=User::create($data);
      $accessToken=$user->createToken('authToken')->accessToken;
      return response(['user'=>$user,'access_token'=>$accessToken,'error'=>'0','message'=>"success"]);
    }

    //LOGIN API
    //
    //
    //
    //

    public function login(Request $req){

      $data = json_decode(file_get_contents('php://input'), true);

       $email=trim($data['mobnumber']);
       $first=trim($data['first']);
       $second=trim($data['second']);
       $third=trim($data['third']);
       $fourth=trim($data['fourth']);
       $fifth=trim($data['fifth']);
       $sixth=trim($data['sixth']);
       $totalValue=$first.$second.$third.$fourth.$fifth.$sixth;
       // $password=$data['otp'];
       $password= $totalValue;


       if(Auth::attempt(['mobnumber'=>$email,'password'=>$password])){
        $user=Auth::user();
        $responseArray=[];
        $responseArray['token']=$user->createToken("authToken")->accessToken;
        $responseArray['userId']= $user->id;
        $responseArray['name']= $user->name;
        $responseArray['email']= $user->email;
        $responseArray['message']= "Login Success";
        return response()->json($responseArray,200);
      }else if($data['mobnumber']=="" || $data['otp']==""){
       return response()->json(['required'=>"All input field is required"],501);
       }else{
        return response()->json(['error'=>"Unauthenticate"],203);
       }




}
}

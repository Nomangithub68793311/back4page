<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Jobs\PasswordRestJob;
use App\Mail\PasswordMail;



class PasswordReset extends Controller
{
    public function passReset(Request $request)
    {
        $input = $request->only(
            'email'
     );
    
   
                             

       $validator = Validator::make($input, [
           
           'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
          
           
       ]);

       if($validator->fails()){
           return response()->json(["error"=>'fails'],422);

       }
        $code=Str::random(6);
        // return  response()->json(["success"=> $ranpass]);
        try {
            DB::beginTransaction();
          $found=  Account::where('email', '=', $request->email)->first(); 

            //   return  response()->json(["success"=> $found]);

          if($found){
            $job=(new PasswordRestJob($found->email,$code))
            ->delay(Carbon::now()->addSeconds(5));
            dispatch( $job);
            DB::commit(); 
            return  response()->json([
                "success"=>"Code Sent To Your Email.Check Spam If not Found Inbox",
                "id"=>$found->id,
                "code"=>$code]);
          }

        return  response()->json(["success"=>"Email not found"],422);
 
            
         
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error"=>"process error!"],422);
    }

        // DB::table('Post')max('views');
    }




    public function passChange(Request $request)
    {
        $input = $request->only(
            'password'
     );
    
   
                             

       $validator = Validator::make($input, [
           
        'password' => 'required|min:8'          
           
       ]);

       if($validator->fails()){
           return response()->json(["error"=>'fails'],422);

       }

        try {
            DB::beginTransaction();
            $found=  Account::where('id', '=', $request->id)->first(); 
            //   return  response()->json(["success"=> $found]);
          if($found){

            $found->password = Hash::make($input['password']); 
            $found->save();
            // $job=(new PasswordRestJob($found->email,$code))
            // ->delay(Carbon::now()->addSeconds(5));
            // dispatch( $job);
            DB::commit(); 
            return  response()->json([
                "success"=>"Password Saved Successfully",
                ]);
          }

        return  response()->json(["success"=>"Email not found"],422);
 
            
         
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error"=>"process error!"],422);
    }
      

    }








}
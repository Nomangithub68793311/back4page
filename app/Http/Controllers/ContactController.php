<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ContactController extends Controller
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
        
        $input = $request->only(
            'reason','message','email'
            
      );   
  
        // return  response()->json(["success"=> $input]);

    

      $validator = Validator::make($input, [
        'reason' => 'required',
        'message' => 'required',
        'email' => 'required'
        

        
    ]);

    if($validator->fails()){
        return response()->json(["error"=>'fails']);

    }
    
    // $input['images']  = $request->file('file')->store('products');
    // $post = Post::create($input);
        // return  response()->json(["success"=> "fiza"]);

        try {
            DB::beginTransaction();
        
            
            $contact = Contact::create($input); 
            
            
            if (!$contact) {
                return response()->json(["error"=>"didnt work"],422);
            } 
            // $response = Http::post('http://127.0.0.1:8000/v1/event', [
            //     "email"=>$student->email
                
            // ]);
            DB::commit();   
            // $job=(new StudentEmailJob( $student->email,$student->password, $school->institution_name,$school->logo,))
            // ->delay(Carbon::now()->addSeconds(5));
            // dispatch( $job);
        return  response()->json(["success"=>"You Will be Contacted Soon"]);
        }
            catch (\Exception $e) {
            DB::rollback();  

            }
    

    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}

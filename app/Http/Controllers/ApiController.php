<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function search(Request $request)
    {

        $validator = Validator::make($request->all(),['type'=>'required','data'=>'required']);

        if($validator->fails())return response()->json(['error'=>$validator->errors()->all(),'status'=>false]);


        $type = $request->type;
        $data = $request->data;

        if($type != null){
            if($data !=null){
                if($type=='Number'){
                    $contacts  =  Contact::where('phone',$data)->get();
                  
                    if(count($contacts)>0){
                      return response()->json(['contacts'=>$contacts,'message'=>'you get data successfully','status'=>true]);
                    }else{
                      return response()->json(['contacts'=>[],'message'=>'sorry no data match this Phone','status'=>true]);
                    }
  
                }elseif($type=='Name'){
                  $contacts  =  Contact::where('name',$data)->get();
                  
                  if(count($contacts)>0){
                    return response()->json(['contacts'=>$contacts,'message'=>'you get data successfully','status'=>true]);
                  }else{
                    return response()->json(['contacts'=>[],'message'=>'sorry no data match this name','status'=>true]);
                  }

                }else{
                  return response()->json(['contacts'=>[],'message'=>' Please Enter  valid  Data ','status'=>true]);  
                }
            }
            return response()->json(['contacts'=>[],'message'=>' Please Enter Data of Type Seach ','status'=>true]);      
        }

        return response()->json(['contacts'=>[],'message'=>' Please chosse Type ','status'=>true]);
    }
}

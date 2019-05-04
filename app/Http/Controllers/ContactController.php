<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Validator;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



     

    public function index()
    {
        $contacts = Contact::all();
      
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string|email',
        ]);

        if ($validator->fails()) {
            return redirect('contacts/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $contact = new Contact([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'job_title' => $request->get('job_title')

        ]);
        $contact->save();
        return redirect('/contacts')->with('success', 'Contact saved!');
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
        $contact = Contact::find($id);
        return view('contacts.edit', compact('contact')); 
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string|email',
        ]);

        if ($validator->fails()) {
            return redirect('contacts/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }


        $contact = Contact::find($id);
        $contact->name =  $request->get('name');
        $contact->phone = $request->get('phone');
        $contact->email = $request->get('email');
        $contact->job_title = $request->get('job_title');


        $contact->save();

        return redirect('/contacts')->with('success', 'Contact updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();

        return redirect('/contacts')->with('success', 'Contact deleted!');
    }

    public function search(Request $request)
    {
        
        $type = $request->type;
        $data = $request->data;

        if($type != null){
            if($data !=null){
                if($type =='ID'){
                    $contacts  =  Contact::where('id',$data)->get();
                  
                    if(count($contacts)>0){
                      return response()->json(['contacts'=>$contacts,'message'=>'حصلت على البانات بنجاح']);
                    }else{
                      return response()->json(['contacts'=>[],'message'=>'لا توجد بيانات لهذا الرقم التعريفي']);
                    }
  
                }elseif($type=='Number'){
                    $contacts  =  Contact::where('phone',$data)->get();
                  
                    if(count($contacts)>0){
                      return response()->json(['contacts'=>$contacts,'message'=>'you get data successfully']);
                    }else{
                      return response()->json(['contacts'=>[],'message'=>'لا يوجد بيانات لهذا الرقم']);
                    }
  
                }elseif($type=='Name'){
                  $contacts  =  Contact::where('name',$data)->get();
                  
                  if(count($contacts)>0){
                    return response()->json(['contacts'=>$contacts,'message'=>'حصلت على البيانات بنجاح']);
                  }else{
                    return response()->json(['contacts'=>[],'message'=>'لا توجد بيانات لهذا الاسم']);
                  }

                }else{
                  return response()->json(['contacts'=>[],'message'=>' Please Enter  valid  Data ']);  
                }
            }
            return response()->json(['contacts'=>[],'message'=>' Please Enter Data of Type Seach ']);      
        }

        return response()->json(['contacts'=>[],'message'=>' Please chosse Type ']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers =Teacher::all();
        return view('create', compact('teachers'));
    }

    public function addTeacherForm(Request $request)
    {
        //perform form validation here
        $validator = Validator::make($request->all(),[
             'name' => 'required',
             'surname' => 'required',
             'speciality' => 'required',
             'rozhdenie' => 'required',
             'ogozi_dars' => 'required',
             'gender' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json(['msg'=> $validator->errors()->toArray()]);
        }else{
            try {
                $addTeacherForm = new Teachers;
                $addTeacherForm->name =$request->name;
                $addTeacherForm->surname =$request->surname;
                $addTeacherForm->speciality =$request->speciality;
                $addTeacherForm->rozhdenie =$request->rozhdenie;
                $addTeacherForm->ogozi_dars =$request->ogozi_dars;
                $addTeacherForm->gender =$request->gender;
                $addTeacherForm->save();
                return response()->json(['success' => true, 'msg' => 'teacher added successfully']);

            }catch (\Exception $e){
                return response()->json(['success' => false, 'msg' => $e->getMessage()]);
            }
        }
    }
 }

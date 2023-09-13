<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LocalStudents;
use App\ForeignStudents;
use App\AllStudents;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class crudController extends Controller
{
   public function addStudents(){
      return view('page.addStudent');
   }

   protected function validationRules($request, $old_student_number = null, $old_student_type = null){
      $rules = [
         'student_type' => 'required',
         'name' => [
            'required',
            'min:6',
            Rule::unique('local_students', 'name')
               ->where('mobile_number', $request->mobile_number)
               ->ignore($old_student_number, 'id_number'),
            Rule::unique('foreign_students', 'name')
               ->where('mobile_number', $request->mobile_number)
               ->ignore($old_student_number, 'id_number'),
         ],
         'id_number' => [
            'required',
            Rule::unique('local_students', 'id_number')
               ->where('id_number', $request->id_number)
               ->ignore($old_student_number, 'id_number'),
            Rule::unique('foreign_students', 'id_number')
               ->where('id_number', $request->id_number)
               ->ignore($old_student_number, 'id_number'),
      ],
         'age' => 'required|integer|numeric|between:0,99',
         'gender' => 'required|in:male,female',
         'city' => 'required|string|max:200',
         'mobile_number' => [
            'required', 'min:11', 'max:11', 'regex:#(09|\+639|\+63|0)[0-9]{9}#',
            Rule::unique('local_students', 'mobile_number')
               ->where('name', $request->name)
               ->ignore($old_student_number, 'id_number'),
            Rule::unique('foreign_students', 'mobile_number')
               ->where('name', $request->name)
               ->ignore($old_student_number, 'id_number'),
         ],
         'grades' => 'required|numeric|min:75|max:100',
         'email' => 'required|email|max:200'
      ];

      $customMessage = [
            'mobile_number.unique' => 'The Name and Mobile Number combination already exist',
            'name.unique' => 'The Name and Mobile Number combination already exist'
      ];

      $validator = Validator::make($request->all(), $rules, $customMessage);

      $data = [
            'student_type' => $request->student_type,
            'id_number' => $request->id_number,
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'city' => $request->city,
            'mobile_number' => $request->mobile_number,
            'grades' => $request->grades,
            'email' => $request->email,
      ];

   return [$validator, $data];
   }


   public function store(Request $request){
      [$validator, $data] = $this->validationRules($request);

      if ($validator->fails()) {
         return redirect()->back()->withErrors($validator)->withInput();
      }


      if ($data['student_type'] === 'local_student')
      {

      $student = LocalStudents::create($data);
      AllStudents::create(['local_student_id'=> $student->id, 'student_type'=>'local_student']);


      } else {

      $student = ForeignStudents::create($data);
      AllStudents::create(['foreign_student_id'=> $student->id, 'student_type'=>'foreign_student']);

      }



      return redirect()->route('home')->with('added', "Record added successfully");
   }



   public function listPage(){
      return view('page.tableDisplay');
   }

   public function tableLists(){
      $myArray=[];
      $allStudents = AllStudents::with(['localstudent', 'foreignstudent'])->get()->toArray();

      foreach($allStudents as $students){
      $myArray[]= $students['foreignstudent'] ?? $students['localstudent'];
      }

      return view('page.tableDisplay', compact('myArray'));
   }


   public function deleteRow($id_number){
      $localStudent = LocalStudents::where('id_number', $id_number)->first();
      $foreignStudent = ForeignStudents::where('id_number', $id_number)->first();

      if (!$localStudent && !$foreignStudent) {
         return redirect()->route('home')->with('error', 'Record not found.');
      }


      if ($localStudent) {
         $localStudent->delete();
      }

      if ($foreignStudent) {
         $foreignStudent->delete();
      }


      return redirect()->route('home')->with('delete', 'Record deleted successfully.');
   }

   public function editRow($id_number){
      $allStudents = new AllStudents;
      $sT = $allStudents->allStudents();
      $editStudent="";

      foreach ($sT as $edit) {

         if ($id_number == $edit['id_number']) {
             $editStudent = $edit;

         }
      }
      return view('page.updateStudent', compact('editStudent'));
   }

   public function update(Request $request, $old_student_number, $old_student_type){
      [$validator, $data] = $this->validationRules($request, $old_student_number, $old_student_type);

      if ($validator->fails()) {
         return redirect()->back()->withErrors($validator)->withInput();
      }

      if($request->student_type != $old_student_type) {
         $check = ($old_student_type == 'local_student');
         $check ? LocalStudents::where('id_number', $old_student_number)->delete() : ForeignStudents::where('id_number', $old_student_number)->delete();
         $request->student_type == 'local_student' ?  $student = LocalStudents::create($data) : $student = ForeignStudents::create($data);
         $allStudentsData = [
            $student['student_type'] == 'local_student' ? 'local_student_id' : 'foreign_student_id' => $student->id,
            'student_type' => $student->student_type
         ];
         AllStudents::create($allStudentsData);
      } else {

         $foreignStudent = ForeignStudents::where('id_number', $old_student_number)->first();
         $localStudent = LocalStudents::where('id_number', $old_student_number)->first();
         $check = ($old_student_type == 'local_student');
         $check ? $localStudent->update($data) : $foreignStudent->update($data);

      }
      return redirect()->route('home')->with('updated', 'Updated successfully.');
   }


   public function search(Request $request){

    if($request->student_type == null){
    $allStudents = AllStudents::with(['localstudent', 'foreignstudent'])->get();

   } else {
      $allStudents = AllStudents::with(['localstudent', 'foreignstudent'])->where('student_type', $request->student_type)->get();

   }
   $myArray=[];
   foreach ($allStudents as $students) {
      // Debugging: Dump the $students variable to inspect its contents


      // Add the related data to $myArray
      if ($students->foreignstudent) {
         $myArray[] = $students->foreignstudent;
      }

      if ($students->localstudent) {
         $myArray[] = $students->localstudent;
      }
   }

    return view('page.tableDisplay', compact('myArray'));

   }
}

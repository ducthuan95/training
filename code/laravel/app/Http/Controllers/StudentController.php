<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function show(){
        $data['list'] = Student::paginate(10);;
        return view('students.list', $data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $students;
    public function __construct(Student $student)
    {
        $this->students = $student;
    }

    public function show(){
        $data['list'] = $this->students->getAllStudent(10);
        return view('students.list', $data);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use Notifiable;

    protected $fillable = [
        'code', 'name', 'age', 'email', 'gender', 'address'
    ];


    public function getAllStudent($per = 10){
        return Student::paginate($per);
    }

    public function getById($id){
        return Student::find($id);
    }

    public function deleteById($id){
        return Student::destroy($id);
    }

    public function createStudent(Request $request){
        return Student::create($request->all());
    }
    
}

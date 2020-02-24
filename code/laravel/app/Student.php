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
        return $this->orderBy('id', 'DESC')->paginate(10);
    }

    public function getStudentById($id){
        return $this->find($id);
    }

    public function deleteStudentById($id){
        return $this->destroy($id);
    }

    public function createStudent(Request $request){
        return $this->create($request->all());
    }

    public function updateStudentById($id, Request $request){
        return $this->where('id', $id)->update($request->all());
    }

}

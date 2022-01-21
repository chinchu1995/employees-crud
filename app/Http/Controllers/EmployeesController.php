<?php

namespace App\Http\Controllers;

use Mail;
use Str;
use App\Models\Employees;
use App\Models\Designations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    //Function to load employees list page with data
    public function index(){

        $employees  = Employees::latest()->get();
        return view('employees.index',compact('employees'));

    }

    //Function to load create page with data
    public function create(){

        $designations = Designations::all();
        return view('employees.create',compact('designations'));

    }

    //function to load edit page with data
    public function edit($id){

        $employee       = Employees::find($id);
        $designations   = Designations::all();

        if(empty($employee)){
            return abort(404);
        }

        return view('employees.edit',compact('employee','designations'));

    }

    //Function to store data
    public function store(Request $request){

        $request->validate([
            'name'         => 'required|min:3',
            'email'        => 'required|unique:employees',
            'designation'  => 'required'
        ]);

        $employees             = new Employees;
        $employees->name       = $request->input('name');
        $employees->email      = $request->input('email');
        $employees->password   = Str::random(8);

        if ($request->hasFile('photo')) {

            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            ]);

            $photoName             = uniqid(time()).'.'.$request->photo->extension();
            $photo                 = $request->photo->move(public_path('uploads'),$photoName);
            $employees->photo      = 'uploads/'.$photoName;

        }

        $designations     = Designations::find($request->input('designation'));

        $designations->employees()->save($employees);

        Mail::send('emails.account-creation', ['employee' => $employees], function ($m) use ($employees) {
            $m->from('employeescrm@gmail.com','Employee CRM');
            $m->to($employees->email, $employees->name)->subject('Account signup');
        });

        return redirect()->route('employees.create')->with('status', 'Data inserted Successfully!');

    }

    //Function to update data
    public function update(Request $request,$id){

        $request->validate([
            'name'         => 'required|min:3',
            'email'        => 'required|unique:employees,email,'.$id,
            'designation'  => 'required'
        ]);

        $employees             = Employees::find($id);
        $employees->name       = $request->input('name');
        $employees->email      = $request->input('email');

        if ($request->hasFile('photo')) {

            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            ]);

            unlink($employees->photo);

            $photoName             = uniqid(time()).'.'.$request->photo->extension();
            $photo                 = $request->photo->move(public_path('uploads'),$photoName);
            $employees->photo      = 'uploads/'.$photoName;

        }

        $designations     = Designations::find($request->input('designation'));

        $designations->employees()->save($employees);

        return redirect()->back()->with('status', 'Data updated Successfully!');

    }

    //Function to delete data
    public function delete($id){

        $employee   = Employees::find($id);

        if(empty($employee)){
            return abort(404);
        }

        if(!empty($employee->photo)){
            unlink($employee->photo);
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('status', 'Data deleted Successfully!');

    }
}

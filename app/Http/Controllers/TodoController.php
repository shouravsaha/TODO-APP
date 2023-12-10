<?php

namespace App\Http\Controllers;
use League\Config\Exception\ValidationException;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    //
    public function index(){
        $todos = Todo::all();
        return view('index')->with('todos', $todos);
    }

    public function create(){
        return view('create');
    }

    public function store(){
        try {
            $this->validate(request(), [
                'name' => ['required'],
                'description' => ['required']
            ]);
        } catch (ValidationException $e) {
        }


        $data = request()->all();


        $todo = new Todo();
        //On the left is the field name in DB and on the right is field name in Form/view
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->save();

        session()->flash('success', 'Todo created succesfully');

        return redirect('/');
    }

    public function edit(){
        return view('edit');
    }

    public function update(){
        // return view('index');
    }

    public function delete(){
        //return view('index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Todo;
 
use Illuminate\Support\Facades\Validator;

class DynamicAddRemoveFieldController extends Controller
{
    public function index() 
    {
        return view("add-remove-multiple-input-fields");
    }
    public function store(Request $request)
    {
        $request->validate([
            'moreFields.*.title' => 'required',
            'moreFields.*.matricule' => 'required',
        ]);
     
        foreach ($request->moreFields as $key => $value) {
            Todo::create([
                'title' => $value['title'],
                'matricule' => $value['matricule'],
            ]);
        }
     
        return back()->with('success', 'Todos Has Been Created Successfully.');
    }
}

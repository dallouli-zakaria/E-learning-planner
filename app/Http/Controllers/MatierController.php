<?php

namespace App\Http\Controllers;

use App\Models\Matier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Throwable;

class MatierController extends Controller
{
    //
    // Show all Matiers
    public function index() {
        $data = Matier::all();
        //var_dump($data);
        //die();
        return view('matiers.index', [
            'matiers' => $data
        ]);
    }

    //Show single Matier
    public function show(Matier $matier) {
        return view('Matiers.show', [
            'matier' => $matier
        ]);
    }

    // Show Create Form
    public function create() {
        return view('Matiers.create');
    }

    // Store Matier Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required'
        ]);

        Matier::create($formFields);

        return redirect('/')->with('message', 'Matier created successfully!');
    }

    // Show Edit Form
    public function edit(Request $request) {
        $matier = Matier::find($request->id);

        $data = Matier::all();
        return view('Matiers.edit', ['matier' => $matier]);
    }

    // Update Matier Data
    public function update(Request $request) {

        $matier = Matier::find($request->id);
        // Make sure logged in user is owner
        if(auth()->user()->role !="Admin") {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
        ]);

        $matier->update($formFields);

        return back()->with('message', 'Matier updated successfully!');
    }

    // Delete Matier
    public function destroy(Request $request) {

        $matier = Matier::find($request->id);
        try {

            $matier->delete();
        } catch (Throwable $e) {
            report($e);
            return redirect('/')->with('message', 'Error could not delete!');
        }
        return redirect('/')->with('message', 'Matier deleted successfully');
    }
}

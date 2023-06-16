<?php

namespace App\Http\Controllers;

use App\Models\Matier;
use App\Models\Session;
use App\Models\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SessionController extends Controller
{
    // Show all sessions
    public function index() {
        $data = Session::with('prof','matier')->get();
        //var_dump($data);
        //die();
        return view('sessions.index', [
            'sessions' => $data
        ]);
    }

    //Show single Session
    public function show(Request $request) {
        $session = Session::with('matier','prof','students')->find($request->id);
        return view('Sessions.show', [
            'val' => $session
        ]);
    }

    // Show Create Form
    public function create() {
        $matiers = Matier::all();
        return view('Sessions.create',['matiers'=>$matiers]);
    }

    // Store Session Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'matier_id' => 'required',
            'room' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['img'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Session::create($formFields);

        return redirect('/')->with('message', 'Session created successfully!');
    }

    // Show Edit Form
    public function edit(Request $request) {
        $session = Session::with('matier')->find($request->id);
        $matiers = Matier::all();
        return view('Sessions.edit', ['session' => $session,'matiers'=>$matiers]);
    }

    // Etudiant subscribe to session
    public function subscribe(Request $request, Session $session) {
        //$session_user = new SessionUser();
        SessionUser::create(['user_id'=>auth()->user()->id,'session_id'=>$request->id]);

        $session = Session::with('matier','prof','students')->find($request->id);
        return redirect("/sessions/".$request->id)->with('val', $session);
    }

    // Update Session Data
    public function update(Request $request) {
        $session = Session::with('prof')->find($request->id);
        // Make sure logged in user is owner
        if($session->prof->id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'matier_id' => 'required',
            'room' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['img'] = $request->file('logo')->store('logos', 'public');
        }

        $session->update($formFields);

        return back()->with('message', 'Session updated successfully!');
    }

    // Delete Session
    public function destroy(Session $Session) {
        // Make sure logged in user is owner
        if($Session->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        if($Session->logo && Storage::disk('public')->exists($Session->logo)) {
            Storage::disk('public')->delete($Session->logo);
        }
        $Session->delete();
        return redirect('/')->with('message', 'Session deleted successfully');
    }
}

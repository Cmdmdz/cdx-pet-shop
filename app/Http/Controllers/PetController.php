<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pets;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pets::all();

        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'breed' => 'required',
        ]);

        Pets::create($request->all());

        return redirect()->route('pets.index')
            ->with('success', 'Pet created successfully.');
    }

    public function show($id)
    {
        $pet = Pets::find($id);

        return view('pets.show', compact('pet'));
    }

    public function edit($id)
    {
        $pet = Pets::find($id);

        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'breed' => 'required',
        ]);

        $pet = Pets::find($id);
        $pet->update($request->all());

        return redirect()->route('pets.index')
            ->with('success', 'Pet updated successfully.');
    }

    public function destroy($id)
    {
        Pets::find($id)->delete();

        return redirect()->route('pets.index')
            ->with('success', 'Pet deleted successfully.');
    }
}

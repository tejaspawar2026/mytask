<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StudentController extends Controller
{
    protected $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function index()
    {
        $students = $this->student->all();
        return view('pages.index', compact('students'));
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date|before:' . Carbon::now()->subYears(18)->toDateString(),
            'email' => 'required|email|unique:students,email',
            'mobile_no' => 'required|numeric|digits_between:10,15',
        ]);

        $this->student->create($validatedData);

        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

    public function show(string $id)
    {
        $student = $this->student->findOrFail($id);
        return view('pages.show', compact('student'));
    }

    public function edit(string $id)
    {
        $student = $this->student->findOrFail($id);
        return view('pages.edit', compact('student'));
    }

    public function update(Request $request, string $id)
    {
        $student = $this->student->findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date|before:' . Carbon::now()->subYears(18)->toDateString(),
            'email' => 'required|email|unique:students,email,' . $student->id,
            'mobile_no' => 'required|numeric|digits_between:10,15',
        ]);
        $student->update($validatedData);
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy(string $id)
    {
        $student = $this->student->findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // ✅ Create student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string|unique:students,nim',
            'nama' => 'required|string|max:150',
            'email' => 'required|email|unique:students,email',
            'no_hp' => 'required|string|max:20',
            'program_studi' => 'required|string|max:100',
            'semester' => 'required|integer|min:1|max:8',
            'ipk' => 'required|numeric|min:0|max:4',
            'status' => 'required|in:aktif,cuti,lulus,dropout',
        ]);

        $student = Student::create($validated);

        return response()->json([
            'message' => 'Data student berhasil ditambahkan',
            'data' => $student
        ], 201);
    }

    // ✅ Get all students
    public function index()
    {
        return response()->json(Student::all());
    }

    // ✅ Get one student
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    // ✅ Update student
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'nim' => 'sometimes|string|unique:students,nim,' . $student->id,
            'nama' => 'sometimes|string|max:150',
            'email' => 'sometimes|email|unique:students,email,' . $student->id,
            'no_hp' => 'sometimes|string|max:20',
            'program_studi' => 'sometimes|string|max:100',
            'semester' => 'sometimes|integer|min:1|max:8',
            'ipk' => 'sometimes|numeric|min:0|max:4',
            'status' => 'sometimes|in:aktif,cuti,lulus,dropout',
        ]);

        $student->update($validated);

        return response()->json([
            'message' => 'Data student berhasil diperbarui',
            'data' => $student
        ]);
    }

    // ✅ Delete student
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json([
            'message' => 'Data student berhasil dihapus'
        ]);
    }
}

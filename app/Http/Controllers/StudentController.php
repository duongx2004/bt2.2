<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        // tìm kiếm
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // sắp xếp
        if ($request->filled('sort')) {
            $query->orderBy('name', $request->sort);
        } else {
            $query->orderBy('id', 'desc');
        }

        $students = $query->paginate(5)->appends($request->all());

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'major' => 'required|max:255',
            'email' => 'required|email|unique:students,email'
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Thêm sinh viên thành công!');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|max:255',
            'major' => 'required|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Đã xóa sinh viên!');
    }
}
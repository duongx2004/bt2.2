<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with('student', 'course')->get();
        $students = Student::all();
        $courses = Course::all();

        return view('enrollments.index', compact('enrollments', 'students', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id'  => 'required|exists:courses,id',
        ]);

        // kiểm tra trùng
        $exists = Enrollment::where('student_id', $request->student_id)
            ->where('course_id', $request->course_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Sinh viên đã đăng ký môn này!');
        }

        // tính tổng tín chỉ hiện tại
        $currentCredits = Enrollment::where('student_id', $request->student_id)
            ->join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->sum('courses.credits');

        $course = Course::findOrFail($request->course_id);

        // vượt quá 18 tín chỉ
        if ($currentCredits + $course->credits > 18) {
            return back()->with('error', 'Vượt quá 18 tín chỉ!');
        }

        // lưu
        Enrollment::create([
            'student_id' => $request->student_id,
            'course_id' => $request->course_id
        ]);

        return back()->with('success', 'Đăng ký thành công!');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return back()->with('success', 'Đã hủy đăng ký!');
    }
}
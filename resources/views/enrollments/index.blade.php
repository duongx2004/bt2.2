@extends('layouts.app')

@section('content')

<h3>Đăng ký môn học</h3>

{{-- FORM --}}
<form method="POST" action="{{ route('enrollments.store') }}" class="row mb-4">
    @csrf

    <div class="col-md-4">
        <select name="student_id" class="form-select">
            <option value="">-- Chọn sinh viên --</option>
            @foreach($students as $s)
                <option value="{{ $s->id }}">{{ $s->name }}</option>
            @endforeach
        </select>
        @error('student_id') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <select name="course_id" class="form-select">
            <option value="">-- Chọn môn --</option>
            @foreach($courses as $c)
                <option value="{{ $c->id }}">
                    {{ $c->name }} ({{ $c->credits }} TC)
                </option>
            @endforeach
        </select>
        @error('course_id') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary">Đăng ký</button>
    </div>
</form>

{{-- ALERT --}}
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- TABLE --}}
<table class="table table-bordered">
    <tr>
        <th>Sinh viên</th>
        <th>Môn học</th>
        <th>Tín chỉ</th>
        <th>Tổng tín chỉ</th>
        <th>Action</th>
    </tr>

    @foreach($enrollments as $e)
    @php
        $total = \App\Models\Enrollment::where('student_id', $e->student->id)
            ->join('courses', 'enrollments.course_id','=','courses.id')
            ->sum('courses.credits');
    @endphp

    <tr>
        <td>{{ $e->student->name }}</td>
        <td>{{ $e->course->name }}</td>
        <td>{{ $e->course->credits }}</td>
        <td>{{ $total }}</td>

        <td>
            <form action="{{ route('enrollments.destroy', $e) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm"
                    onclick="return confirm('Hủy môn này?')">
                    Hủy
                </button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

@endsection
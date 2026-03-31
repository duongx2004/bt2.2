@extends('layouts.app')

@section('content')

<h3>Sửa sinh viên</h3>

<form method="POST" action="{{ route('students.update', $student) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Tên</label>
        <input type="text" name="name" class="form-control" value="{{ $student->name }}">
        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Ngành</label>
        <input type="text" name="major" class="form-control" value="{{ $student->major }}">
        @error('major') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $student->email }}">
        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-success">Cập nhật</button>
</form>

@endsection
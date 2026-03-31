@extends('layouts.app')

@section('content')

<h3>Thêm sinh viên</h3>

<form method="POST" action="{{ route('students.store') }}">
    @csrf

    <div class="mb-3">
        <label>Tên</label>
        <input type="text" name="name" class="form-control">
        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Ngành</label>
        <input type="text" name="major" class="form-control">
        @error('major') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-primary">Lưu</button>
</form>

@endsection
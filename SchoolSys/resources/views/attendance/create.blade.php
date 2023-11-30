@extends('layouts.app')

@section('content')
    <h1>Create Attendance Record</h1>
    <form action="{{ route('attendance.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="class_id">Select a Class:</label>
            <select name="classs_id" id="classs_id" class="form-control">
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="attendance_date">Attendance Date:</label>
            <input type="date" name="attendance_date" id="attendance_date" class="form-control">
        </div>
        <div class="form-group">
            <label>Students:</label>
            @foreach ($students as $student)
                <div class="form-check">
                    <input type="checkbox" name="students[]" value="{{ $student->id }}" class="form-check-input">
                    <label class="form-check-label">{{ $student->name }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Submit Attendance</button>
    </form>
@endsection
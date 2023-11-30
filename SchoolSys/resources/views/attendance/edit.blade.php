@extends('layouts.app')

@section('content')
    <h1>Edit Attendance Record</h1>
    <form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="class_id">Class:</label>
            <input type="text" value="{{ $attendance->class->name }}" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="attendance_date">Attendance Date:</label>
            <input type="date" name="attendance_date" id="attendance_date" class="form-control" value="{{ $attendance->attendance_date }}">
        </div>
        <div class="form-group">
            <label>Students:</label>
            @foreach ($attendance->class->students as $student)
                <div class="form-check">
                    <input type="checkbox" name="students[]" value="{{ $student->id }}" class="form-check-input"
                        {{ in_array($student->id, $selectedStudents) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $student->name }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Update Attendance</button>
    </form>
@endsection

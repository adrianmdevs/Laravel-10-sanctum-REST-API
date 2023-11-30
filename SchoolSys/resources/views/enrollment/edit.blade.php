@extends('layouts.app')

@section('content')
    <h1>Edit Enrollment</h1>
    <form action="{{ route('enrollments.store', $student->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="class_id">Select a Class:</label>
            <select name="class_id" id="class_id" class="form-control">
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enroll Student</button>
    </form>
@endsection
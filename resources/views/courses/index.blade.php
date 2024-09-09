@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Courses</h1>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">Create Course</a>
        <ul class="list-group mt-3">
            @foreach ($courses as $course)
                <li class="list-group-item">
                    <a href="{{ route('courses.show', $course) }}">{{ $course->title }}</a>
                    @if (auth()->user()->role == 'instructor' && $course->instructor_id == auth()->id())
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm float-end">Edit</a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST" class="float-end me-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endsection

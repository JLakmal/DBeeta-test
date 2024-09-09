@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container">
        <h1>{{ $course->title }}</h1>
        <p>{{ $course->description }}</p>

        @if (auth()->user()->role == 'student')
            <form action="{{ route('enrollments.store', $course) }}" method="POST" id="enroll-form">
                @csrf
                <button type="submit" class="btn btn-success">Enroll</button>
            </form>
        @endif

        <h2>Lessons</h2>
        <ul class="list-group mt-3">
            @foreach ($course->lessons as $lesson)
                <li class="list-group-item">
                    <h3>{{ $lesson->title }}</h3>
                    <p>{{ $lesson->content }}</p>
                    @if (auth()->user()->role == 'student')
                        <form action="{{ route('progress.update', ['progress' => $lesson->id]) }}" method="POST" class="form-check float-end">
                            @csrf
                            @method('PATCH')
                            <input type="checkbox" class="form-check-input" onchange="markAsCompleted(this)" data-lesson-id="{{ $lesson->id }}" {{ $lesson->progress()->where('student_id', auth()->id())->first()->is_completed ? 'checked' : '' }}>
                            <label class="form-check-label">Completed</label>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        function markAsCompleted(checkbox) {
            let lessonId = checkbox.dataset.lessonId;
            let form = checkbox.closest('form');
            let url = form.action;
            let isCompleted = checkbox.checked;
            fetch(url, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ is_completed: isCompleted })
            });
        }
    </script>
@endsection

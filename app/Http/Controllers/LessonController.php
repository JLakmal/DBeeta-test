<?php

namespace App\Http\Controllers; 

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $course->lessons()->create($request->only(['title', 'content']));
        return redirect()->route('courses.show', $course);
    }

    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $lesson->update($request->only(['title', 'content']));
        return redirect()->route('courses.show', $lesson->course);
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('courses.show', $lesson->course);
    }
}

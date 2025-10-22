<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseLecture;
use App\Models\CourseSection;
use App\Models\InfoBox;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendDashboardController extends Controller
{
    public function home()
    {

        $all_sliders = Slider::all();
        $all_info = InfoBox::all();

        $all_categories = Category::withCount('course')->inRandomOrder()->limit(6)->get();
        $categories = Category::all();
        $course_category = Category::with('course', 'course.user', 'course.course_goal')->get();

        return view('frontend.index', compact('all_sliders', 'all_info', 'all_categories', 'categories', 'course_category'));
    }

    public function view($slug)
    {

        $course = Course::where('course_name_slug', $slug)->with('category', 'subcategory', 'user')->first();
        $total_lecture = CourseLecture::where('course_id', $course->id)->count();
        $course_content = CourseSection::where('course_id', $course->id)->with('lecture')->get();

        // Get the currently authenticated user's ID
        $userId = Auth::id();

        // Fetch similar courses but exclude those already ordered by the student
        $similarCourses = Course::where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)->get();

        $all_category = Category::orderBy('name', 'asc')->get();

        //more course instructor

        $more_course_instructor = Course::where('instructor_id', $course->instructor_id)->where('id', '!=', $course->id)->with('user')->get();

        $total_lecture = CourseLecture::where('course_id', $course->id)->count();


        $total_minutes = CourseLecture::where('course_id', $course->id)->sum('video_duration');

        $hours = floor($total_minutes / 60);
        $minutes = floor($total_minutes % 60);
        $seconds = round(($total_minutes - floor($total_minutes)) * 60);

        $total_lecture_duration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);


        return view('frontend.pages.course-details.index', compact('course', 'total_lecture', 'course_content', 'similarCourses', 'all_category', 'more_course_instructor', 'total_minutes', 'total_lecture_duration'));
    }

    public function allCourses()
    {
        // Get all active courses
        $courses = Course::where('status', 1)
            ->with('category', 'user')
            ->paginate(12);

        $categories = Category::all();
        $searchTerm = 'All Courses';

        return view('frontend.pages.search.index', compact('courses', 'searchTerm', 'categories'));
    }

    public function categoryCorses($slug)
    {
        // Find category or subcategory by slug
        $category = Category::where('slug', $slug)->first();
        $subcategory = \App\Models\SubCategory::where('slug', $slug)->first();

        if ($category) {
            // Get courses by category
            $courses = Course::where('status', 1)
                ->where('category_id', $category->id)
                ->with('category', 'subcategory', 'user')
                ->paginate(12);
            $searchTerm = $category->name;
        } elseif ($subcategory) {
            // Get courses by subcategory
            $courses = Course::where('status', 1)
                ->where('subcategory_id', $subcategory->id)
                ->with('category', 'subcategory', 'user')
                ->paginate(12);
            $searchTerm = $subcategory->name;
        } else {
            // If not found, redirect to all courses
            return redirect()->route('all.courses');
        }

        $categories = Category::all();

        return view('frontend.pages.search.index', compact('courses', 'searchTerm', 'categories'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        if (empty($searchTerm)) {
            return redirect()->route('frontend.home');
        }

        // Search courses by name, title, description, category, or subcategory
        $courses = Course::where('status', 1)
            ->where(function($query) use ($searchTerm) {
                $query->where('course_name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('course_title', 'like', '%' . $searchTerm . '%')
                      ->orWhere('description', 'like', '%' . $searchTerm . '%')
                      ->orWhereHas('category', function($q) use ($searchTerm) {
                          $q->where('name', 'like', '%' . $searchTerm . '%');
                      })
                      ->orWhereHas('subcategory', function($q) use ($searchTerm) {
                          $q->where('name', 'like', '%' . $searchTerm . '%');
                      });
            })
            ->with('category', 'subcategory', 'user')
            ->paginate(12);

        $categories = Category::all();

        return view('frontend.pages.search.index', compact('courses', 'searchTerm', 'categories'));
    }
}

<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    public function login(){
        return view('backend.instructor.login.index');

    }

    public function register(){
        return view('backend.instructor.register.index');
    }

    public function dashboard()
    {
        $instructorId = Auth::id();

        // Get instructor's courses
        $totalCourses = Course::where('instructor_id', $instructorId)->count();
        $activeCourses = Course::where('instructor_id', $instructorId)->where('status', 1)->count();
        $pendingCourses = Course::where('instructor_id', $instructorId)->where('status', 0)->count();

        // Get total students enrolled in instructor's courses
        $totalStudents = Order::whereHas('course', function($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->distinct('user_id')->count('user_id');

        // Get total revenue from instructor's courses
        $totalRevenue = Order::whereHas('course', function($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->sum('price');

        // Get recent enrollments
        $recentEnrollments = Order::with(['user', 'course'])
            ->whereHas('course', function($query) use ($instructorId) {
                $query->where('instructor_id', $instructorId);
            })
            ->latest()
            ->limit(10)
            ->get();

        // Get instructor's popular courses
        $popularCourses = Course::where('instructor_id', $instructorId)
            ->withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->limit(5)
            ->get();

        // Monthly revenue (last 6 months)
        $monthlyRevenue = Order::whereHas('course', function($query) use ($instructorId) {
                $query->where('instructor_id', $instructorId);
            })
            ->selectRaw('MONTH(created_at) as month, SUM(price) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return view('backend.instructor.dashboard.index', compact(
            'totalCourses',
            'activeCourses',
            'pendingCourses',
            'totalStudents',
            'totalRevenue',
            'recentEnrollments',
            'popularCourses',
            'monthlyRevenue'
        ));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/instructor/login');
    }


}

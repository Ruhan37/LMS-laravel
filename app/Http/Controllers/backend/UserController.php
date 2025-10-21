<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard(){
        $userId = Auth::id();

        // Get user's enrolled courses count (distinct courses)
        $enrolledCoursesCount = Order::where('user_id', $userId)
            ->distinct()
            ->count('course_id');

        // Get user's enrolled courses (latest 3 for header) - eager load only necessary fields
        $enrolledCourses = Order::with(['course:id,course_name,course_image,course_name_slug'])
            ->where('user_id', $userId)
            ->latest()
            ->limit(3)
            ->get();

        // Get wishlist courses count
        $wishlistCount = \App\Models\Wishlist::where('user_id', $userId)->count();

        // Get total purchase amount
        $totalPurchaseAmount = Order::where('user_id', $userId)->sum('price');

        // Get user's notifications (unread count and latest 5)
        $unreadNotifications = Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->count();

        $notifications = Notification::where('user_id', $userId)
            ->latest()
            ->limit(5)
            ->get();

        return view('backend.user.index', compact(
            'enrolledCoursesCount',
            'enrolledCourses',
            'wishlistCount',
            'totalPurchaseAmount',
            'unreadNotifications',
            'notifications'
        ));
    }

    public function myCourses()
    {
        $userId = Auth::id();

        // Get all enrolled courses for the user
        $enrolledCourses = Order::with(['course.category', 'course.user'])
            ->where('user_id', $userId)
            ->latest()
            ->get()
            ->unique('course_id');

        return view('backend.user.my-courses', compact('enrolledCourses'));
    }

    public function messages()
    {
        // Placeholder for messages functionality
        return view('backend.user.messages');
    }

    public function purchaseHistory()
    {
        $userId = Auth::id();

        // Get all orders/purchases for the user
        $orders = Order::with(['course'])
            ->where('user_id', $userId)
            ->latest()
            ->get();

        $totalSpent = $orders->sum('price');

        return view('backend.user.purchase-history', compact('orders', 'totalSpent'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

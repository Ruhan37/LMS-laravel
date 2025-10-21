<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function login()
    {

        return view('backend.admin.login.index');
    }

    public function dashboard()
    {
        // Total statistics
        $totalCourses = Course::count();
        $totalStudents = User::where('role', 'user')->count();
        $totalInstructors = User::where('role', 'instructor')->where('status', '1')->count();

        // Calculate total revenue from orders (sum of price column)
        $totalRevenue = Order::sum('price');

        // Monthly statistics
        $monthlyRevenue = Order::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('price');

        $monthlyOrders = Order::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        $pendingCourses = Course::where('status', 0)->count();

        // Top categories with course count
        $topCategories = Category::withCount('course')
            ->orderBy('course_count', 'desc')
            ->limit(5)
            ->get();

        // Recent orders
        $recentOrders = Order::with(['user', 'course', 'payment'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Sales chart data (last 12 months)
        $salesChartLabels = [];
        $salesChartData = [];
        $ordersChartData = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $salesChartLabels[] = $date->format('M');

            $monthlySales = Order::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('price');

            $monthlyOrderCount = Order::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();

            $salesChartData[] = $monthlySales;
            $ordersChartData[] = $monthlyOrderCount;
        }

        // Category chart data
        $categoryChartLabels = $topCategories->pluck('name')->toArray();
        $categoryChartData = $topCategories->pluck('course_count')->toArray();

        return view('backend.admin.dashboard.index', compact(
            'totalCourses',
            'totalStudents',
            'totalInstructors',
            'totalRevenue',
            'monthlyRevenue',
            'monthlyOrders',
            'pendingCourses',
            'topCategories',
            'recentOrders',
            'salesChartLabels',
            'salesChartData',
            'ordersChartData',
            'categoryChartLabels',
            'categoryChartData'
        ));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}

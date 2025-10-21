# Notification System Implementation

## Overview
Implemented a complete real-time notification system for admin users when instructors create new courses, plus fixed the dark mode toggle functionality.

## Features Implemented

### 1. Database Structure
- **Table**: `notifications`
- **Columns**:
  - `id` (bigint, primary key)
  - `type` (string) - notification type (e.g., 'course_created')
  - `user_id` (foreign key to users table)
  - `title` (text) - notification title
  - `message` (text) - detailed message
  - `link` (nullable string) - URL to redirect when clicked
  - `is_read` (boolean, default false)
  - `timestamps`

### 2. Notification Model
- **File**: `app/Models/Notification.php`
- **Features**:
  - Fillable fields for mass assignment
  - `user()` relationship to User model
  - `scopeUnread()` query scope for fetching unread notifications
  - Automatic timestamp casting

### 3. Notification Creation
- **Trigger**: When instructor creates a new course
- **File**: `app/Http/Controllers/backend/CourseController.php`
- **Logic**:
  - After course is saved, queries all admin users
  - Creates notification for each admin with course details
  - Includes instructor name, course name, and link to course list

### 4. Notification Display
- **Location**: Admin header (top navigation bar)
- **File**: `resources/views/backend/section/header.blade.php`
- **Features**:
  - Bell icon with unread count badge
  - Dropdown showing last 10 notifications
  - Unread notifications highlighted with blue background
  - "New" badge on unread items
  - Human-readable timestamps (e.g., "5 minutes ago")
  - "Mark All as Read" button
  - Empty state message when no notifications

### 5. Notification Controller
- **File**: `app/Http/Controllers/backend/NotificationController.php`
- **Methods**:
  - `markAsRead($id)` - Mark single notification as read
  - `markAllAsRead()` - Mark all user's notifications as read
- **Security**: Ensures users can only access their own notifications

### 6. Routes
- **Namespace**: `admin.*`
- **Routes**:
  - `POST /admin/notifications/{id}/read` → `admin.notifications.read`
  - `POST /admin/notifications/mark-all-read` → `admin.notifications.markAllRead`

### 7. JavaScript Functionality
- **File**: `resources/views/layouts/backend.blade.php`
- **Features**:
  - **Notification Click**: AJAX request to mark as read, then redirect to link
  - **Mark All Read**: AJAX request to mark all as read, then reload page
  - **Dark Mode Toggle**:
    - Toggles `dark-theme` class on `<html>` element
    - Changes icon from moon to sun
    - Saves preference in localStorage
    - Loads saved preference on page load

## How It Works

### Notification Flow
1. Instructor creates a course via `/instructor/course/create`
2. `CourseController@store()` saves the course
3. System queries all users with `role = 'admin'`
4. Creates notification record for each admin:
   ```
   Type: course_created
   Title: New Course Submitted
   Message: [Instructor Name] has submitted a new course: [Course Name]
   Link: /admin/course
   ```
5. Admin sees unread count badge in header
6. Admin clicks bell icon to see notification list
7. Admin clicks notification → marks as read → redirects to course list
8. Admin can click "Mark All as Read" to clear all notifications

### Dark Mode Flow
1. User clicks dark mode icon in header
2. JavaScript toggles `dark-theme` class on `<html>`
3. Icon changes (moon ↔ sun)
4. Preference saved to localStorage
5. On next page load, saved preference is applied automatically

## Files Modified/Created

### Created Files
1. `database/migrations/2025_10_21_171908_create_notifications_table.php`
2. `app/Models/Notification.php`
3. `app/Http/Controllers/backend/NotificationController.php`
4. `NOTIFICATION_SYSTEM_IMPLEMENTATION.md` (this file)

### Modified Files
1. `app/Http/Controllers/backend/CourseController.php` - Added notification creation
2. `resources/views/backend/section/header.blade.php` - Added notification dropdown
3. `resources/views/layouts/backend.blade.php` - Added JavaScript for notifications and dark mode
4. `routes/web.php` - Added notification routes

## Testing Instructions

### Test Notification System
1. Login as admin: `admin@example.com` / `password`
2. Verify header shows bell icon with no notifications
3. Logout and login as instructor: `instructor@example.com` / `password`
4. Navigate to `/instructor/course/create`
5. Create a new course with all required fields
6. Logout and login as admin again
7. Verify bell icon shows unread count (1)
8. Click bell icon to see notification
9. Verify notification shows: "New Course Submitted" with instructor name and course name
10. Click notification → should mark as read and redirect to course list
11. Verify unread count decreases

### Test Dark Mode
1. Login as admin or instructor
2. Click moon icon in header
3. Verify page switches to dark theme
4. Verify icon changes to sun
5. Click sun icon to switch back to light theme
6. Refresh page → verify theme preference persists
7. Open browser DevTools → Application → Local Storage → verify `theme` key exists

## Database Migration
Migration already run. To verify:
```bash
php artisan migrate:status
```

Should show `2025_10_21_171908_create_notifications_table` as `Ran`.

## Security Features
- Notifications filtered by `user_id` (users only see their own)
- CSRF token required for all POST requests
- Authorization checks in controller methods

## Future Enhancements
- Add notification types for other events (course approved, order placed, etc.)
- Add real-time notifications using Laravel Echo + Pusher
- Add notification preferences (email notifications, etc.)
- Add notification history page
- Add delete notification functionality
- Add notification sound effects

## Notes
- Notifications are currently only for admins when instructors create courses
- System uses jQuery for AJAX (already included in backend theme)
- Dark mode styling provided by Rocker theme CSS
- Notification dropdown uses Bootstrap 5 dropdown component

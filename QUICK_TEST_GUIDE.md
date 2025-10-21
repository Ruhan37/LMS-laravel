# YouTubeLMS - Quick Testing Guide

## 🚀 Quick Start

Your application is running at: **http://127.0.0.1:8000**

---

## 🔑 Login Credentials

### Admin Access
```
URL: http://127.0.0.1:8000/admin/login
Email: admin@example.com
Password: password
```

### Instructor Access
```
URL: http://127.0.0.1:8000/instructor/login
Email: instructor@example.com
Password: password
```

### Student/User Access
```
URL: http://127.0.0.1:8000/login
Email: user@example.com
Password: password
```

---

## ✅ 5-Minute Test Checklist

### Test 1: Homepage (30 seconds)
1. Open http://127.0.0.1:8000
2. Check if page loads without errors
3. Verify navigation menu appears
4. Check browser console (F12) for errors

### Test 2: Admin Dashboard (1 minute)
1. Go to http://127.0.0.1:8000/admin/login
2. Login with admin credentials
3. Verify dashboard displays
4. Check if sidebar menu works
5. Try toggling dark/light theme

### Test 3: Create Category (1 minute)
1. From admin dashboard, click "Category"
2. Click "Add New Category"
3. Fill in category name (e.g., "Web Development")
4. Upload an image
5. Click Save
6. Verify category appears in list

### Test 4: Instructor Dashboard (1 minute)
1. Logout from admin
2. Go to http://127.0.0.1:8000/instructor/login
3. Login with instructor credentials
4. Verify dashboard displays
5. Check if "Manage Courses" link appears

### Test 5: Create Course (1.5 minutes)
1. From instructor dashboard, click "Manage Courses"
2. Click "Add New Course"
3. Fill in course details:
   - Course Name: "Laravel Mastery"
   - Category: Select from dropdown
   - Price: 49.99
   - Description: Sample description
4. Upload course image
5. Click Save

### Test 6: Student Registration (30 seconds)
1. Logout from instructor
2. Go to http://127.0.0.1:8000/register
3. Register new student account OR login with user@example.com
4. Verify dashboard displays
5. Check if enrolled courses section appears

---

## 🎯 Key Features to Test

### Admin Panel
- ✅ Category Management
- ✅ Subcategory Management
- ✅ Instructor Approval
- ✅ Course Management
- ✅ Order Management
- ✅ Slider Management
- ✅ Settings (SMTP, Stripe, Google)

### Instructor Panel
- ✅ Course Creation
- ✅ Section Management
- ✅ Lecture Upload
- ✅ Coupon Creation
- ✅ Profile Settings

### Student/User Panel
- ✅ Course Browsing
- ✅ Add to Wishlist
- ✅ Add to Cart
- ✅ Checkout
- ✅ Watch Lectures
- ✅ Track Progress

---

## 🐛 Common Issues & Solutions

### Issue: "SQLSTATE[HY000] [2002] Connection refused"
**Solution:** Make sure XAMPP MySQL is running on port 4306

### Issue: "Class 'App\Models\Google' not found"
**Solution:** Already fixed - Database migrated

### Issue: 404 errors for assets
**Solution:** Run `npm run build` to compile assets

### Issue: "419 Page Expired" on form submission
**Solution:** Clear cache: `php artisan cache:clear`

### Issue: Can't login
**Solution:** Make sure you've run `php artisan db:seed`

---

## 📊 Test Results Template

Copy and fill this out as you test:

```
Date: _____________
Tested By: _____________

Frontend
- [ ] Homepage loads
- [ ] Course details page works
- [ ] Navigation functional
- [ ] Images load correctly

Admin Dashboard
- [ ] Login successful
- [ ] Dashboard displays stats
- [ ] Category CRUD works
- [ ] Subcategory CRUD works
- [ ] Instructor management works

Instructor Dashboard
- [ ] Login successful
- [ ] Dashboard displays
- [ ] Course creation works
- [ ] Section creation works
- [ ] Lecture upload works

Student Dashboard
- [ ] Login/Register works
- [ ] Dashboard displays
- [ ] Can browse courses
- [ ] Wishlist works
- [ ] Cart works
- [ ] Checkout works

Issues Found:
___________________________________________
___________________________________________
___________________________________________
```

---

## 🔧 Development Commands

### Clear All Caches
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
php artisan route:clear
```

### Rebuild Assets
```bash
npm run build
# or for development with hot reload
npm run dev
```

### Reset Database (WARNING: Deletes all data)
```bash
php artisan migrate:fresh --seed
```

### Check Routes
```bash
php artisan route:list
```

### View Logs
```bash
tail -f storage/logs/laravel.log
```

---

## 📱 Responsive Testing

Test these URLs on different screen sizes:

1. **Mobile (375px):**
   - Homepage
   - Course details
   - Login pages
   - Dashboards

2. **Tablet (768px):**
   - All admin pages
   - Course creation form
   - Dashboard grids

3. **Desktop (1920px):**
   - Full layout
   - Sidebar navigation
   - Data tables

---

## 🎨 Theme Features

### Frontend (Aduca)
- Bootstrap 5 responsive design
- Line Awesome icons
- Owl Carousel for sliders
- Plyr video player
- Isotope grid filtering

### Backend (Rocker)
- Bootstrap 5 admin theme
- Dark/Light mode toggle
- Chart.js for analytics
- DataTables for listings
- MetisMenu sidebar
- Perfect Scrollbar

---

## 📞 Need Help?

**Check Laravel Logs:**
```bash
tail -50 storage/logs/laravel.log
```

**Check Browser Console:**
Press F12 → Console tab

**Check Network Tab:**
Press F12 → Network tab → Reload page

**Database Issues:**
- Check connection: `php artisan migrate:status`
- Check tables: `php artisan db:show`

---

## ✨ Success Criteria

Your integration is successful if:
- ✅ All three login types work (Admin, Instructor, Student)
- ✅ Dashboards display without errors
- ✅ You can create a category as Admin
- ✅ You can create a course as Instructor
- ✅ You can browse courses as Student
- ✅ No 404 errors in browser console
- ✅ No PHP errors in Laravel log
- ✅ Pages are responsive on mobile

---

**Happy Testing! 🚀**

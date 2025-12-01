# Social Auth Testing Guide

## Quick Start

### Prerequisites
1. Laravel dev server running on `http://localhost:8000`
2. Google OAuth credentials configured in `.env`
3. Database migrations up to date

### Start the Server
```bash
cd c:\LARAVEL12\appdesa
php artisan serve
```

The app will be available at: **http://localhost:8000**

---

## Test Scenario 1: New User via Google OAuth

### Steps
1. Open browser to `http://localhost:8000/login`
2. Click **"Login with Google"** button
3. You'll be redirected to Google consent screen
4. Click **"Allow"** to give permission
5. You should be redirected to the **Register Form**

### Expected Results
- ✅ Email field is **pre-filled** with your Google email
- ✅ Email field is **READ-ONLY** (cannot edit)
- ✅ Nama Lengkap field is **pre-filled** with your Google name
- ✅ Password fields are **HIDDEN**
- ✅ Blue info alert shows: "Login via Google: Lengkapi data NIK dan alamat untuk menyelesaikan pendaftaran."
- ✅ All other fields (NIK, address, etc.) are empty and required

### Complete Registration
1. Fill in **NIK**: Use a 16-digit number (e.g., `1234567890123456`)
2. Fill in **Nama Lengkap**: If not already filled
3. Fill in **Tempat Lahir**: (e.g., "Jakarta")
4. Select **Tanggal Lahir**: Pick any valid date
5. Select **Jenis Kelamin**: "Laki-laki" or "Perempuan"
6. Fill in **Alamat**: (e.g., "Jalan Merdeka No. 1")
7. Fill in **RT**: (e.g., "01")
8. Fill in **RW**: (e.g., "02")
9. Fill in **Desa**: (same as system default)
10. Fill in other address fields as prompted
11. Click **"Daftar"** button

### Expected Result After Form Submission
- ✅ **NO login form** shown
- ✅ Directly redirected to **Dashboard**
- ✅ Success message: "Registrasi berhasil! Selamat datang di Dashboard Desa."
- ✅ User info shows **Google avatar**
- ✅ Profile indicates login method was social auth

---

## Test Scenario 2: Returning User via Google OAuth

### Prerequisites
- Already completed Test Scenario 1 with a Google account

### Steps
1. Go to `http://localhost:8000/login`
2. Click **"Login with Google"**
3. Approve permission

### Expected Result
- ✅ **NO register form** shown
- ✅ Directly redirected to **Dashboard**
- ✅ Already logged in as the registered user
- ✅ Happens instantly (no form to fill)

---

## Test Scenario 3: Normal Registration (Non-Social Auth)

### Steps
1. Go to `http://localhost:8000/register`
2. You should see the **normal registration form**

### Expected Results
- ✅ Email field is **NOT pre-filled**
- ✅ Email field is **EDITABLE**
- ✅ **Password fields are VISIBLE** (not hidden)
- ✅ **NO blue social auth alert**
- ✅ **NO hidden fields** submitted

### Complete Registration
1. Fill in all fields including password
2. Click **"Daftar"**

### Expected Result
- ✅ Redirected to **Login page** (not dashboard)
- ✅ Success message: "Registrasi berhasil! Silakan login menggunakan NIK dan password Anda."
- ✅ Must manually login with NIK + password

---

## Test Scenario 4: Error Handling - Duplicate NIK

### Steps
1. Use the same Google account from Test Scenario 1
2. Don't accept permission (stay on login page)
3. Try normal registration with the same NIK you used before

### Expected Result
- ✅ Form shows error: **"NIK sudah terdaftar"**
- ✅ Form data is preserved
- ✅ User can edit and retry

---

## Test Scenario 5: Error Handling - Duplicate Email

### Steps
1. Use normal registration
2. Enter an email that's already registered in the system

### Expected Result
- ✅ Form shows error: **"Email sudah terdaftar"**
- ✅ Suggests: Use social auth if that email has a Google account

---

## Test Scenario 6: Error Handling - Invalid NIK Format

### Steps
1. Try social auth registration
2. Enter NIK with less than 16 digits (e.g., `123456789012345`)
3. Try entering non-numeric characters

### Expected Results
- ✅ Error: **"NIK harus tepat 16 digit"**
- ✅ Error: **"NIK harus berupa angka"**
- ✅ Form data preserved for retry

---

## Database Verification

After successful social auth registration, verify the user was created:

```bash
# Using Laravel Tinker
cd c:\LARAVEL12\appdesa
php artisan tinker

# In Tinker shell:
>>> $user = App\Models\User::orderBy('id', 'desc')->first();
>>> $user->email;           // Should show your Google email
>>> $user->provider;        // Should be "google"
>>> $user->provider_id;     // Should be your Google ID
>>> $user->avatar;          // Should have Google avatar URL
>>> $user->email_verified_at; // Should have a timestamp
>>> $user->is_verified;     // May be false (separate from email_verified_at)
```

---

## Browser Console Debugging

If something goes wrong, check the browser console:

### F12 → Console tab
- Look for JavaScript errors
- Check Network tab for failed requests
- Look for 404 or 500 errors

### F12 → Network tab
1. Check the `/auth/google/callback` request
   - Should be `302 Redirect` (not 404)
   - Should redirect to `/register`
2. Check the `/register` POST request
   - Should be `302 Redirect` (if successful)
   - Should redirect to `/dashboard`

---

## Server Logs

Check Laravel logs if users see error pages:

```bash
cd c:\LARAVEL12\appdesa
Get-Content storage/logs/laravel.log -Tail 50
```

Look for:
- `Social auth error:` → OAuth issue
- `SQLSTATE` → Database error
- `Call to undefined method` → Code error

---

## Common Issues & Fixes

### Issue: Stuck on Google Consent Screen
**Solution:**
- Check browser allows popups from Google
- Check internet connection
- Try incognito/private browser mode

### Issue: "404 Not Found" at Callback
**Solution:**
- Check route `/auth/{provider}/callback` is NOT inside guest middleware
- Run `php artisan route:clear`
- Restart Laravel server

### Issue: Email Field Not Read-Only
**Solution:**
- Check session data is passed from callback
- Look at browser console to see if `session('social_email')` is set
- Check register form has `readonly` attribute

### Issue: Password Fields Still Showing
**Solution:**
- Session data not passed: check callback method
- Form not checking condition: verify `@if (session('social_email'))` logic
- Clear browser cache (Ctrl+Shift+Delete)

### Issue: "Email already registered" After Social Auth
**Solution:**
- User already registered with that email via normal registration
- Advise user to either:
  - Use different email
  - Contact admin to link accounts
  - Delete previous account first

### Issue: Failed to Create User Error
**Solution:**
- Check all required fields are filled
- Check NIK is not already in users or penduduks table
- Check database connection is working
- View Laravel logs for specific error

---

## Testing Checklist

- [ ] New user social auth registration works end-to-end
- [ ] Email is pre-filled and read-only
- [ ] Password fields are hidden
- [ ] Form shows social auth info alert
- [ ] After form submission, auto-login works
- [ ] User lands on dashboard (not login page)
- [ ] Returning user with same Google account → instant login
- [ ] Normal registration still works unchanged
- [ ] Duplicate NIK error shows correctly
- [ ] Duplicate email error shows correctly
- [ ] Invalid NIK format errors show correctly
- [ ] Database shows correct provider fields
- [ ] User can see their Google avatar
- [ ] Session data is not leaked anywhere

---

## Support Resources

- Laravel Socialite: `config/services.php`
- OAuth Callback: `app/Http/Controllers/AuthController.php` (line 312)
- Register Form: `resources/views/auth/register.blade.php`
- Register Method: `app/Http/Controllers/AuthController.php` (line 64)
- User Model: `app/Models/User.php`
- Full Implementation Doc: `SOCIAL_AUTH_REGISTRATION_COMPLETE.md`

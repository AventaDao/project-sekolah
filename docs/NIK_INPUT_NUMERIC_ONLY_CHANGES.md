╔════════════════════════════════════════════════════════════════════════════╗
║        NIK INPUT VALIDATION - NUMERIC ONLY (ANGKA SAJA)                    ║
║                         PERUBAHAN LENGKAP                                  ║
╚════════════════════════════════════════════════════════════════════════════╝

## RINGKASAN PERUBAHAN

Saya telah mengubah field NIK di semua form untuk hanya menerima ANGKA (tidak boleh huruf atau karakter special).

Total file yang dimodifikasi: 4 file
Total perubahan: 6 lokasi berbeda

═════════════════════════════════════════════════════════════════════════════

## PERUBAHAN DETAIL

### 1️⃣ LOGIN FORM
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

📁 File: resources/views/auth/login.blade.php (Line 28-30)

**SEBELUM:**
```html
<input type="text" class="form-control" name="nik" placeholder="Masukkan NIK 16 digit"
    value="{{ session('registered_nik') }}" autocomplete="off" maxlength="16" required>
```

**SESUDAH:**
```html
<input type="number" class="form-control" name="nik" placeholder="Masukkan NIK 16 digit"
    value="{{ session('registered_nik') }}" autocomplete="off" maxlength="16" min="0" inputmode="numeric" required>
```

**PERUBAHAN:**
- ✅ `type="text"` → `type="number"` (hanya terima angka)
- ✅ Tambah `min="0"` (tidak boleh negatif)
- ✅ Tambah `inputmode="numeric"` (keyboard di mobile langsung numeric)

─────────────────────────────────────────────────────────────────────────────

### 2️⃣ REGISTER FORM
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

📁 File: resources/views/auth/register.blade.php (Line 31-33)

**SEBELUM:**
```html
<input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" 
       value="{{ old('nik') }}" maxlength="16" required placeholder="16 digit">
```

**SESUDAH:**
```html
<input type="number" name="nik" class="form-control @error('nik') is-invalid @enderror" 
       value="{{ old('nik') }}" maxlength="16" min="0" inputmode="numeric" required placeholder="16 digit">
```

**PERUBAHAN:**
- ✅ `type="text"` → `type="number"` (hanya terima angka)
- ✅ Tambah `min="0"` (tidak boleh negatif)
- ✅ Tambah `inputmode="numeric"` (keyboard di mobile langsung numeric)

─────────────────────────────────────────────────────────────────────────────

### 3️⃣ LOGIN CONTROLLER - VALIDATION
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

📁 File: app/Http/Controllers/AuthController.php - Method: login() (Line 28-31)

**SEBELUM:**
```php
$request->validate([
    'nik' => 'required|string|size:16',
    'password' => 'required|min:6',
], [
    'nik.required' => 'NIK harus diisi',
    'nik.size' => 'NIK harus 16 digit',
    'password.required' => 'Password harus diisi',
    'password.min' => 'Password minimal 6 karakter',
]);
```

**SESUDAH:**
```php
$request->validate([
    'nik' => 'required|numeric|digits:16',
    'password' => 'required|min:6',
], [
    'nik.required' => 'NIK harus diisi',
    'nik.numeric' => 'NIK harus berupa angka (tidak boleh ada huruf atau karakter)',
    'nik.digits' => 'NIK harus tepat 16 digit',
    'password.required' => 'Password harus diisi',
    'password.min' => 'Password minimal 6 karakter',
]);
```

**PERUBAHAN:**
- ✅ Validation: `string|size:16` → `numeric|digits:16`
  * `numeric` = hanya boleh angka
  * `digits:16` = tepat 16 digit
- ✅ Error message: `size` → `numeric` + `digits`
  * `nik.numeric` = pesan jika ada huruf/karakter
  * `nik.digits` = pesan jika tidak 16 digit

─────────────────────────────────────────────────────────────────────────────

### 4️⃣ REGISTER CONTROLLER - VALIDATION (NIK RULE)
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

📁 File: app/Http/Controllers/AuthController.php - Method: register() (Line 65)

**SEBELUM:**
```php
'nik' => 'required|string|size:16|unique:users,nik|unique:penduduks,nik',
```

**SESUDAH:**
```php
'nik' => 'required|numeric|digits:16|unique:users,nik|unique:penduduks,nik',
```

**PERUBAHAN:**
- ✅ Validation: `string|size:16` → `numeric|digits:16`
  * Sama seperti login validation

─────────────────────────────────────────────────────────────────────────────

### 5️⃣ REGISTER CONTROLLER - ERROR MESSAGES
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

📁 File: app/Http/Controllers/AuthController.php - Method: register() (Error messages)

**SEBELUM:**
```php
'nik.required' => 'NIK harus diisi',
'nik.size' => 'NIK harus 16 digit',
'nik.unique' => 'NIK sudah terdaftar',
```

**SESUDAH:**
```php
'nik.required' => 'NIK harus diisi',
'nik.numeric' => 'NIK harus berupa angka (tidak boleh ada huruf atau karakter)',
'nik.digits' => 'NIK harus tepat 16 digit',
'nik.unique' => 'NIK sudah terdaftar',
```

**PERUBAHAN:**
- ✅ Error message: `size` → `numeric` + `digits`

═════════════════════════════════════════════════════════════════════════════

## CARA KERJA SEKARANG

### FRONTEND (HTML Input)
```
User mengetik di NIK field:
❌ "12345a" → Browser reject, tidak bisa input huruf 'a'
❌ "12345!@#" → Browser reject, tidak bisa input karakter special
✅ "1234567890123456" → Accepted (16 angka)
✅ "123456" → Accepted (kurang dari 16, tapi bisa submit untuk backend validate)
```

### BACKEND (Server Validation)
```
User submit form:
❌ NIK "abc123" → Reject: "NIK harus berupa angka"
❌ NIK "12345" (5 digit) → Reject: "NIK harus tepat 16 digit"
✅ NIK "1234567890123456" → Accept & continue
```

═════════════════════════════════════════════════════════════════════════════

## RINGKASAN FITUR

✅ FRONTEND VALIDATION (HTML)
   - Input hanya menerima angka (browser level)
   - Mobile keyboard langsung numerik
   - Tidak bisa copy-paste text/huruf
   - Instant feedback saat user mengetik

✅ BACKEND VALIDATION (PHP)
   - Double-check di server untuk security
   - Pesan error descriptive
   - Prevent bypassing browser validation (jika user edit HTML)
   - Consistent validation di login & register

✅ USER EXPERIENCE
   - Clear error messages dalam bahasa Indonesia
   - Field tidak terima huruf/karakter sejak awal
   - 16 digit harus tepat (tidak boleh kurang/lebih)

═════════════════════════════════════════════════════════════════════════════

## TESTING CHECKLIST

- [ ] Buka login form, coba ketik huruf di NIK → Tidak bisa input huruf
- [ ] Coba paste text dengan huruf ke NIK field → Tidak bisa
- [ ] Input 16 angka di login → Accepted
- [ ] Input 15 angka di login → Submit → Error "harus tepat 16 digit"
- [ ] Buka register form, coba ketik huruf di NIK → Tidak bisa input huruf
- [ ] Input 16 angka di register → Accepted
- [ ] Input NIK dengan karakter special "123!@#$%^&*" → Tidak bisa input

═════════════════════════════════════════════════════════════════════════════

## FILE YANG DIUBAH

1. ✅ resources/views/auth/login.blade.php
2. ✅ resources/views/auth/register.blade.php
3. ✅ app/Http/Controllers/AuthController.php (login validation)
4. ✅ app/Http/Controllers/AuthController.php (register validation)

═════════════════════════════════════════════════════════════════════════════

Semua perubahan sudah selesai! NIK field sekarang hanya menerima ANGKA saja. ✅

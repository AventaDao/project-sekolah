# Fitur Crop Avatar - Dokumentasi

## Perubahan yang Dilakukan

### 1. **Memperbaiki Foto Profil yang Lonjong**
   - **File:** `resources/views/auth/edit-profile.blade.php` dan `resources/views/myprofile.blade.php`
   - **Solusi:** Menambahkan CSS `object-fit: cover` dan `object-position: center` untuk memastikan foto selalu berbentuk persegi (square) dan tidak terdistorsi
   - **CSS Rule:**
     ```css
     #avatarPreview {
         width: 150px !important;
         height: 150px !important;
         object-fit: cover !important;
         object-position: center !important;
     }
     ```

### 2. **Menambahkan Fitur Crop Avatar**
   - **Library:** Cropper.js v1.5.13 dari CDN
   - **Fitur:**
     - User dapat memilih file foto
     - Tombol "Crop & Sesuaikan" muncul setelah file dipilih
     - Modal popup untuk melakukan crop
     - Preview realtime saat melakukan crop
     - Aspect ratio 1:1 (persegi)
     - User bisa menggeser, resize, dan rotate

### 3. **Tata Letak Tombol**
   - **Urutan tombol (dari atas ke bawah):**
     1. Choose File (input file)
     2. Crop & Sesuaikan (tombol blue/info)
     3. Batalkan (tombol secondary outline)

### 4. **File yang Dimodifikasi**
   
   **a) `resources/views/auth/edit-profile.blade.php`**
   - Tambah CSS untuk fix foto lonjong
   - Tambah tombol "Crop & Sesuaikan"
   - Tambah modal crop
   - Tambah library Cropper.js
   - Tambah logic JavaScript untuk crop

   **b) `resources/views/myprofile.blade.php`**
   - Tambah CSS untuk fix foto lonjong
   - Memastikan avatar di profile view juga tidak lonjong

   **c) `app/Http/Controllers/AuthController.php`**
   - Update method `updateProfile()` untuk handle avatar dengan benar
   - Validasi tetap sama

### 5. **Fitur JavaScript**
   - Deteksi file dipilih
   - Tampil tombol crop ketika file dipilih
   - Inisialisasi Cropper.js dengan setting square
   - Konversi canvas crop ke blob
   - Update file input dengan hasil crop
   - Reset semua state saat tombol batalkan diklik

### 6. **User Flow**
   ```
   1. User klik Choose File
   2. Pilih foto dari komputer
   3. Tombol "Crop & Sesuaikan" muncul
   4. Klik tombol tersebut
   5. Modal popup dengan editor crop
   6. Drag/resize crop box sesuai keinginan
   7. Klik "Simpan Crop"
   8. Preview foto terupdate di form
   9. Klik "Simpan Perubahan" untuk save ke database
   ```

## Testing

### Test Case 1: Upload dan Crop
- [ ] Upload foto landscape
- [ ] Verifikasi modal crop muncul
- [ ] Crop ke bagian wajah
- [ ] Verifikasi preview terupdate
- [ ] Submit form
- [ ] Verifikasi foto di profile tidak lonjong

### Test Case 2: Reset Foto
- [ ] Upload foto
- [ ] Klik tombol Batalkan
- [ ] Verifikasi foto kembali ke default
- [ ] Verifikasi tombol crop hilang

### Test Case 3: Edit Foto Lagi
- [ ] Upload foto pertama + crop
- [ ] Edit profile lagi
- [ ] Upload foto kedua + crop
- [ ] Verifikasi foto lama terhapus
- [ ] Verifikasi foto baru tersimpan

## Dependencies
- Cropper.js v1.5.13 (CDN)
- Bootstrap Modal (sudah ada di project)

## Browser Compatibility
- Chrome/Edge: ✅ Full support
- Firefox: ✅ Full support
- Safari: ✅ Full support
- IE11: ❌ Not supported (DataTransfer API)

## Notes
- File di-store dengan format: `avatars/{user_id}_{timestamp}.{extension}`
- Max file size tetap 2MB (validasi server)
- Format yang didukung: JPEG, PNG, JPG, GIF
- Crop dilakukan di client-side (lebih cepat, hemat server resource)

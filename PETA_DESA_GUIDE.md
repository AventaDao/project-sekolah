# Panduan Peta Lokasi Desa

## Overview
Fitur peta lokasi desa telah ditambahkan ke halaman welcome (landing page). Peta ini menggunakan Google Maps API dan dapat diperbesar, diperkecil, dan digeser secara interaktif.

## Lokasi Sementara
Saat ini, peta menampilkan **Monas (Monumen Nasional), Jakarta** sebagai lokasi placeholder:
- **Koordinat**: -6.1753, 106.8249
- **Zoom Level**: 15

## Cara Mengupdate Lokasi Desa

### Metode 1: Menggunakan Console Browser
1. Buka halaman welcome di browser
2. Buka Developer Tools (F12)
3. Buka tab Console
4. Jalankan perintah berikut:

```javascript
updateMapLocation(lat, lng, address, mapLink)
```

**Contoh:**
```javascript
updateMapLocation(-6.5211, 110.4175, "Jl. Panura No. 1, Kalurahan Kaliurang, Kecamatan Candi, Kabupaten Sleman, Yogyakarta", "https://maps.google.com/?q=-6.5211,110.4175")
```

### Metode 2: Dari Google Maps Link

Untuk mendapatkan koordinat dari Google Maps:

1. Buka Google Maps (https://maps.google.com/)
2. Cari lokasi desa Anda
3. Klik kanan pada lokasi
4. Pilih koordinat untuk menyalin
5. Gunakan format: `lat,lng`

**Contoh link Google Maps:**
```
https://www.google.com/maps/place/-6.5211,110.4175/
```

Dari URL ini, ambil bagian `-6.5211,110.4175` untuk mendapatkan koordinat.

### Metode 3: Hardcode di File (Cara Tetap)

Edit file `resources/views/welcome.blade.php` pada bagian script:

Cari baris ini:
```javascript
const monasLocation = {
    lat: -6.1753,
    lng: 106.8249
};
```

Ganti dengan koordinat desa Anda. Kemudian update juga bagian info desa:
```javascript
const infoWindow = new google.maps.InfoWindow({
    content: `
        <div style="padding: 15px; font-family: Arial, sans-serif;">
            <h3 style="margin: 0 0 10px; color: #2c3e50; font-size: 16px;">Kantor Desa</h3>
            <p style="margin: 5px 0; color: #6c757d; font-size: 13px;">
                <strong>Alamat:</strong> Jl. Anda, Nama Desa, Kabupaten, Provinsi
            </p>
            ...
        </div>
    `
});
```

## Fitur Peta

✅ **Zoom In/Out** - Gunakan scroll mouse atau tombol zoom
✅ **Drag/Pan** - Klik dan drag untuk menggeser peta
✅ **Fullscreen** - Tombol fullscreen di sudut kanan atas
✅ **Street View** - Lihat tampilan jalan dari lokasi
✅ **Info Window** - Klik marker untuk melihat informasi lengkap
✅ **Multiple Map Types** - Ganti antara Roadmap, Satellite, Terrain

## Setting Google Maps API Key

Peta ini menggunakan placeholder key. Untuk production, Anda perlu:

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau gunakan yang ada
3. Enable Maps JavaScript API
4. Generate API Key
5. Edit file `resources/views/welcome.blade.php`

Ganti baris ini:
```javascript
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDummyKeyForNow&libraries=places"></script>
```

Dengan:
```javascript
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_ACTUAL_API_KEY&libraries=places"></script>
```

## Contoh Implementasi

### Dari Console Browser
```javascript
// Update ke Yogyakarta
updateMapLocation(-6.5211, 110.4175, "Jl. Panura No. 1, Kalurahan Kaliurang, Kecamatan Candi, Kabupaten Sleman, Yogyakarta", "https://maps.google.com/?q=-6.5211,110.4175")
```

### Dari Link Google Maps
Jika Anda memiliki link seperti:
```
https://www.google.com/maps/place/Desa+Contoh/@-6.5211,110.4175,15z
```

Extract koordinat: `-6.5211,110.4175` dan gunakan di console:
```javascript
updateMapLocation(-6.5211, 110.4175, "Alamat Desa Contoh", "https://www.google.com/maps/place/Desa+Contoh/@-6.5211,110.4175,15z")
```

## Struktur HTML Peta

Peta ditempatkan di section "Lokasi Desa" dengan:
- **ID Section**: `#lokasi` (dapat diakses via navbar)
- **ID Map**: `#map` (elemen container peta)
- **ID Marker**: Dinamis (diupdate saat lokasi berubah)

## Contact Info Card

Bagian info desa menampilkan:
- ✏️ Alamat Kantor Desa (dynamic, bisa diupdate)
- 📞 Telepon
- 📧 Email
- ⏰ Jam Operasional

Untuk update informasi ini, edit langsung di `welcome.blade.php` atau buat setting configuration di database di masa depan.

## Responsive Design

Peta responsif untuk semua ukuran layar:
- **Desktop**: Peta 500px height, info card di samping
- **Tablet**: Peta 400px height
- **Mobile**: Peta 350px height, info card di atas peta

## Troubleshooting

**Peta tidak muncul?**
- Cek console browser untuk error
- Pastikan Google Maps API key valid
- Cek internet connection

**Marker tidak muncul?**
- Refresh halaman
- Cek koordinat latitude/longitude

**Info window tidak muncul saat klik marker?**
- Zoom out sedikit dan klik marker lagi
- Refresh halaman

## Next Steps

Anda dapat mengembangkan fitur ini dengan:
1. Menyimpan koordinat di database
2. Membuat admin panel untuk update lokasi
3. Menambahkan multiple markers untuk landmark penting
4. Integrating dengan Geolocation API untuk "nearby" search
5. Menambahkan routing untuk petunjuk arah ke kantor desa

---

**Siap untuk mengupdate lokasi desa? Berikan link Google Maps kepada developer untuk melakukan hardcode, atau gunakan console browser sesuai panduan di atas!**

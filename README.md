# Reklame Arjuna - E-Commerce Platform

Platform e-commerce modern untuk produk reklame dan custom printing dengan tema minimalis dan mewah.

## Fitur Utama

### Frontend
- **Home**: Halaman utama dengan deskripsi toko dan produk unggulan
- **About**: Profil toko dengan layout elegan
- **Produk**: Katalog produk dengan 6 kategori:
  - Stempel
  - Plat Kendaraan Motor
  - Plat Kendaraan Mobil
  - Pin Nama
  - Reklame Akrilik
  - Pin Logo
- **Custom Produk**: Semua produk dapat dicustom (teks, ukuran, warna, upload logo)
- **Cart & Checkout**: Sistem keranjang dan checkout yang user-friendly
- **Profile**: Halaman akun user dengan riwayat pesanan
- **Authentication**: Login/Register yang aman

### Backend/Admin
- **Dashboard**: Statistik ringkas (total order, omzet, user, produk aktif)
- **CRUD Produk**: Kelola produk dengan gambar dan custom options
- **CRUD Kategori**: Kelola kategori produk
- **Manajemen Order**: Lihat, update status order (pending, paid, process, shipped, done, canceled)
- **Admin Authentication**: Login admin yang aman

### Pembayaran
- **Midtrans Integration**: Gateway pembayaran terpercaya
- **Multiple Payment Methods**: Transfer bank, e-wallet, kartu kredit, gerai retail
- **Webhook Handler**: Update otomatis status pembayaran

## Teknologi

- **Backend**: Laravel 11, PHP 8.x
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: MySQL (XAMPP)
- **Payment**: Midtrans Snap
- **Authentication**: Laravel Breeze

## Persyaratan Sistem

- PHP 8.2+
- MySQL 5.7+ atau 8.0+
- Composer
- XAMPP (untuk development lokal)
- Node.js (opsional, untuk build assets)

## Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd reklame-arjuna
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Database

#### Menggunakan XAMPP:
1. Start Apache dan MySQL dari XAMPP Control Panel
2. Buat database baru melalui phpMyAdmin:
   - Database name: `reklame_arjuna`
3. Import file SQL jika ada, atau lanjut ke step berikutnya

### 4. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Konfigurasi .env
Edit file `.env` dan sesuaikan konfigurasi berikut:

```env
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reklame_arjuna
DB_USERNAME=root
DB_PASSWORD=

# Midtrans (Sandbox untuk development)
MIDTRANS_SERVER_KEY=SB-Mid-server-YOUR_SERVER_KEY
MIDTRANS_CLIENT_KEY=SB-Mid-client-YOUR_CLIENT_KEY
MIDTRANS_IS_PRODUCTION=false
```

### 6. Run Migration & Seeder
```bash
php artisan migrate
php artisan db:seed
```

### 7. Storage Link
```bash
php artisan storage:link
```

### 8. Start Development Server
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Akun Default

### Admin
- **Email**: admin@reklamearjuna.com
- **Password**: admin123

### User (buat melalui register atau seeder)

## Struktur Folder

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Frontend/     # Controllers untuk frontend
│   │   └── Backend/      # Controllers untuk admin
│   ├── Models/           # Eloquent Models
│   ├── Services/         # Business Logic (MidtransService)
│   └── Middleware/       # Custom Middleware
├── database/
│   ├── migrations/       # Database migrations
│   └── seeders/          # Sample data
├── resources/views/
│   ├── frontend/         # Blade views untuk frontend
│   └── backend/          # Blade views untuk admin
├── routes/
│   ├── frontend.php      # Public routes
│   ├── backend.php       # Admin routes
│   └── payments.php      # Payment webhook routes
└── storage/app/public/   # File uploads
```

## Kategori Produk

1. **Stempel**: Berbagai jenis stempel untuk kantor dan bisnis
2. **Plat Kendaraan Motor**: Plat nomor custom untuk motor
3. **Plat Kendaraan Mobil**: Plat nomor premium untuk mobil
4. **Pin Nama**: Pin identitas untuk karyawan
5. **Reklame Akrilik**: Reklame berkualitas untuk promosi
6. **Pin Logo**: Pin branding untuk merchandise

## Custom Options

Setiap produk dapat memiliki custom options:
- **custom_text**: Teks yang akan dicetak
- **custom_size**: Ukuran custom
- **custom_color**: Pilihan warna
- **upload_logo**: Upload file logo (untuk produk tertentu)

## Payment Gateway Setup

### Midtrans Sandbox
1. Daftar akun Midtrans di [https://dashboard.sandbox.midtrans.com](https://dashboard.sandbox.midtrans.com)
2. Dapatkan Server Key dan Client Key dari dashboard
3. Masukkan ke .env file

### Webhook Setup
- URL Webhook: `http://your-domain.com/payments/midtrans/callback`
- Pastikan URL dapat diakses dari luar (gunakan ngrok untuk development)

## Testing Pembayaran

1. Buat order melalui frontend
2. Klik "Bayar Sekarang" untuk membuka Snap popup
3. Gunakan kartu kredit testing:
   - Nomor: `4811111111111114`
   - CVV: `123`
   - Expired: `MM/YY` (masukkan tanggal masa depan)

## Deployment

### Production Checklist
1. Set `APP_ENV=production` di .env
2. Set `MIDTRANS_IS_PRODUCTION=true`
3. Gunakan production keys dari Midtrans
4. Setup SSL certificate
5. Optimize database: `php artisan config:cache`
6. Clear cache: `php artisan cache:clear`

## Troubleshooting

### Common Issues

1. **Database Connection Failed**
   - Pastikan MySQL XAMPP berjalan
   - Check database name, username, password di .env

2. **Storage Link Issues**
   - Run `php artisan storage:link`
   - Pastikan folder `storage/app/public` writable

3. **Midtrans Error**
   - Check Server Key dan Client Key
   - Pastikan environment variables benar
   - Verifikasi webhook URL accessible

4. **Permission Issues**
   ```bash
   chmod -R 755 storage
   chmod -R 755 bootstrap/cache
   ```

## Contributing

1. Fork repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

Untuk support atau pertanyaan:
- Email: info@reklamearjuna.com
- Phone: +62 812-3456-7890

---

**Reklame Arjuna** - Solusi Terpercaya untuk Kebutuhan Reklame Anda

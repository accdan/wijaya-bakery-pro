# Panduan Keamanan Wijaya Bakery

## 🚨 **PENGATURAN DARURAT - HARUS DILAKUKAN SEBELUM DEPLOYMENT**

### 1. **Konfigurasi Environment (.env)**
```bash
# Jangan pernah upload .env ke repository!
APP_ENV=production
APP_DEBUG=false  # HARAMAT masuk production
APP_KEY=base64:janganPakeYangAsal
APP_URL=https://yourdomain.com
```

### 2. **Generate Application Key**
```bash
php artisan key:generate --show
# Copy hasilnya ke APP_KEY di .env
```

### 3. **Database Security**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_USERNAME=secure_username  # Bukan root!
DB_PASSWORD=strong_password_min_16_chars
```

## 🔒 **KEAMANAN UTAMA YANG WAJIB DIIMPLEMENTASIKAN**

### **A. Server & Hosting**
1. **Web Server (Apache/Nginx)**
   ```bash
   # Apache - Pastikan di .htaccess
   Options -Indexes
   <Files ".env*">
       Order allow,deny
       Deny from all
   </Files>

   # Sembunyikan Laravel info
   ServerSignature Off
   ServerTokens Prod
   ```

2. **SSL Certificate**
   - WAJIB gunakan HTTPS
   - Implementasi HSTS Header
   - Force redirect HTTP ke HTTPS

3. **Server Hardening**
   - Update sistem & packages secara berkala
   - Disable unnecessary services
   - Configure firewall (UFW/firewalld)
   - Setup fail2ban untuk brute force protection

### **B. Laravel Security**
1. **Environment Configuration**
   ```bash
   # config/app.php
   'debug' => env('APP_DEBUG', false),  # Default false

   # config/sanctum.php
   'guard' => ['web'],  # Konfigurasi authentication

   # config/session.php
   'secure' => env('SESSION_SECURE_COOKIE', true),  # HTTPS only
   'http_only' => true,  # Prevent XSS
   'same_site' => 'lax'
   ```

2. **Rate Limiting**
   ```php
   // Routes/web.php atau api.php
   Route::middleware(['throttle:60,1'])->group(function () {
       // Protected routes
   });
   ```

3. **CSRF Protection**
   - Semua form sudah menggunakan `@csrf`
   - API endpoints pakai Sanctum token

4. **Input Validation**
   ```php
   // Controller validation
   $validated = $request->validate([
       'name' => 'required|string|max:255',
       'email' => 'required|email:rfc,dns|unique:users',
       'password' => 'required|min:8|confirmed',
   ]);
   ```

### **C. Database Security**
1. **Database Credentials**
   - Dedicated database user
   - Restricted permissions (SELECT, INSERT, UPDATE, DELETE only)
   - Strong password policy

2. **SQL Injection Protection**
   ```php
   // Gunakan Eloquent/Query Builder
   User::where('email', $request->email)->first();

   // ATAU Prepared Statements
   DB::select('SELECT * FROM users WHERE id = ?', [$id]);
   ```

3. **Data Encryption**
   ```php
   // Untuk data sensitif
   'password' => Hash::make($password),
   'phone' => encrypt($phone), // Jika perlu
   ```

### **D. File Upload Security**
1. **Secure Upload Directory**
   ```bash
   # Pastikan storage dan uploads tidak executable
   chmod 755 storage
   chmod 644 storage/logs/*
   ```

2. **File Validation**
   ```php
   $request->validate([
       'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
       'document' => 'file|mimes:pdf,doc,docx|max:5120'
   ]);
   ```

3. **Secure File Storage**
   ```php
   // Gunakan Laravel's Storage facade
   Storage::putFile('public/uploads', $request->file('image'));
   ```

### **E. Authentication & Authorization**
1. **Strong Password Policy**
   ```php
   Password::min(8)
           ->letters()
           ->mixedCase()
           ->numbers()
           ->symbols()
           ->uncompromised();
   ```

2. **Session Security**
   ```env
   SESSION_LIFETIME=480  # 8 jam
   SESSION_ENCRYPT=true
   SESSION_SECURE_COOKIE=true
   ```

3. **Middleware Protection**
   ```php
   // route middleware
   Route::middleware(['auth', 'verified'])->group(function () {
       Route::get('/dashboard', [DashboardController::class, 'index']);
   });
   ```

### **F. API Security (Sanctum)**
1. **Token Authentication**
   ```php
   // Issue token
   $user->createToken('API Token')->plainTextToken;

   // API Route protection
   Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
       return $request->user();
   });
   ```

2. **Rate Limiting API**
   ```php
   Route::middleware(['throttle:api'])->group(function () {
       // API routes
   });
   ```

### **G. Frontend Security**
1. **XSS Protection**
   ```blade
   {{-- Laravel auto-escape --}}
   <div>{{ $userInput }}</div>

   {{-- Jika butuh raw HTML --}}
   {!! clean($userHtml) !!}
   ```

2. **CSP (Content Security Policy)**
   ```php
   // Middleware atau .htaccess
   Header set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline'"
   ```

## ⚠️ **PERINGATAN BERBAHAYA**

### ❌ **JANGAN PERNAH:**
- Upload file `.env` ke GitHub/GitLab
- Commit APP_KEY atau database credentials
- Set `APP_DEBUG=true` di production
- Gunakan root account untuk database
- Expose sensitive data di logs
- Bypass validation layer

### ✅ **HARUS PERIKSA REGULAR:**
```bash
# Update dependencies
composer update
npm update

# Check vulnerable packages
composer audit
npm audit

# Backup database & files
php artisan backup:run

# Monitor logs
tail -f storage/logs/laravel.log
```

## 🛡️ **SECURITY HEADERS (RECOMMENDED)**

Tambahkan ke web server configuration:

```apache
# Apache .htaccess
<IfModule mod_headers.c>
    # Remove server information
    Header always unset "X-Powered-By"
    Header unset "X-Powered-By"

    # Security headers
    Header always set X-Frame-Options DENY
    Header always set X-Content-Type-Options nosniff
    Header always set Referrer-Policy strict-origin-when-cross-origin
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"

    # CORS if needed
    Header set Access-Control-Allow-Origin "https://yourdomain.com"
    Header set Access-Control-Allow-Methods "GET, POST, PUT, DELETE"
    Header set Access-Control-Allow-Headers "Content-Type, Authorization"
</IfModule>
```

## 📋 **CEKLIST DEPLOYMENT SECURITY**

[ ] Environment variables configured correctly
[ ] APP_DEBUG=false in production
[ ] Strong APP_KEY generated
[ ] Database user with limited permissions
[ ] SSL certificate installed
[ ] Security headers configured
[ ] File permissions set correctly (755/644)
[ ] .env file secure (not in public access)
[ ] Backup system configured
[ ] Monitoring/logging enabled
[ ] Rate limiting active
[ ] Input validation everywhere
[ ] CSRF protection enabled
[ ] XSS prevention active

## 🚨 **EMERGENCY SECURITY CHECKS**

Jika curiga terjadi breach, segera lakukan:

```bash
# Cek file permissions
find . -type f -perm 777
find . -name "*.env*"

# Cek log untuk suspicious activity
grep -r "error\|failed\|denied" storage/logs/

# Cek running processes
ps aux | grep php

# Force password reset for all users
php artisan tinker
User::all()->each(fn($u) => $u->update(['password' => Hash::make(Str::random(16))]));
```

## 📞 **CONTACT EMERGENCY**

Jika terjadi security incident:
1. **Immediate:** Disconnect server from internet
2. **Log all activity:** Don't delete logs
3. **Contact:** security@wijayabakery.com
4. **Report:** Follow local cyber security regulations

---

**PENTING:** Security adalah proses kontinyu, bukan one-time setup. Lakukan audit regular dan selalu update sistem Anda!

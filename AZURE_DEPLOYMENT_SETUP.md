# Azure App Service Configuration untuk Upload File

Untuk memastikan upload file berfungsi optimal di Azure, ikuti langkah-langkah berikut:

## 1. Azure App Service Settings

Di Azure Portal, pergi ke **Configuration** dan tambahkan/update:

### **Application Settings**

```
UPLOAD_MAX_FILE_SIZE         = 10485760        (10MB in bytes)
UPLOAD_TIMEOUT               = 120              (seconds)
UPLOAD_MAX_RETRIES           = 3
UPLOAD_LOGGING_ENABLED       = true
WEBSITE_MEMORY_LIMIT_MB      = 512              (minimum untuk upload)
```

### **PHP Configuration**

Jika bisa custom php.ini, update:

```ini
max_execution_time    = 300
upload_max_filesize   = 20M
post_max_size         = 20M
memory_limit          = 256M
default_socket_timeout = 300
```

### **Untuk App Service Plan B2 ke atas** (recommended)

- Lebih besar memory allocation
- Faster CPU untuk processing
- Better timeout handling

---

## 2. Test Checklist

Sebelum production, pastikan:

### **Local Testing** (php artisan serve)

- [ ] Upload certificate dengan file < 5MB
- [ ] Upload certificate dengan file > 5MB
- [ ] Upload project dengan berbagai format (jpg, png, webp)
- [ ] Check Cloudinary dashboard untuk file terapload
- [ ] Check logs: `storage/logs/laravel.log`

### **Azure Testing** (setelah deploy)

- [ ] Upload via admin panel
- [ ] Check Azure Application Insights untuk logs
- [ ] Monitor performance metrics
- [ ] Test dengan beberapa concurrent uploads
- [ ] Verify file dapat diakses via HTTPS

---

## 3. Monitoring Setup

### **Enable Application Insights**

1. Azure Portal > App Service > Application Insights
2. Enable monitoring
3. Set up alerts untuk:
   - Request failures > 5%
   - Response time > 2 seconds
   - Exception count > 0

### **View Logs**

```bash
# Real-time logs
az webapp log tail --resource-group <rg> --name <app-name>

# Download logs
az webapp log download --resource-group <rg> --name <app-name>

# Query in Application Insights
appTraces
| where message contains "upload" or message contains "cloudinary"
| order by timestamp desc
```

---

## 4. Performance Optimization Tips

### **Jika upload slow:**

1. Upgrade App Service Plan ke Premium
2. Enable "Always On"
3. Scale up memory ke 512MB+
4. Use CDN untuk Cloudinary URLs

### **Jika upload timeout:**

1. Check network connectivity
2. Reduce file size limit
3. Increase PHP timeout di web.config (IIS)
4. Monitor Cloudinary API status

### **Jika server error:**

1. Check Application Insights error logs
2. Verify Cloudinary credentials
3. Check file permission di `/tmp` equivalent
4. Monitor server resources

---

## 5. Production Checklist

- [ ] CLOUDINARY_URL correct di production `.env`
- [ ] Upload folder permissions correct
- [ ] Logs writable di `storage/logs`
- [ ] Application Insights enabled
- [ ] Error notifications configured
- [ ] Backup of Cloudinary account
- [ ] Rate limiting untuk uploads jika needed
- [ ] Security headers configured
- [ ] HTTPS enforced
- [ ] CORS configured jika needed

---

## 6. Troubleshooting Commands

```bash
# Test Cloudinary connection
php artisan tinker
> Cloudinary::api()->ping()

# Check current PHP settings
> phpinfo()

# Test upload locally
php artisan make:test UploadTest

# Monitor queue (jika pakai queue)
php artisan queue:work --timeout=300

# Check storage permissions
> file_exists(storage_path('logs')) && is_writable(storage_path('logs'))
```

---

## 7. Environment Variables

**Production `.env`:**

```env
# Cloudinary
CLOUDINARY_URL=cloudinary://key:secret@cloud

# Upload settings
UPLOAD_MAX_FILE_SIZE=10485760
UPLOAD_TIMEOUT=120
UPLOAD_MAX_RETRIES=3
UPLOAD_LOGGING_ENABLED=true

# Azure settings
AZURE_USE_STORAGE_FALLBACK=false
```

---

## 8. Emergency Fallback

Jika Cloudinary down, bisa gunakan Azure Storage fallback:

```env
AZURE_USE_STORAGE_FALLBACK=true
```

(Fitur ini bisa ditambahkan nanti jika needed)

---

**Document Version:** 1.0
**Last Updated:** 2026-06-17
**Tested On:** Laravel 12 + Azure App Service

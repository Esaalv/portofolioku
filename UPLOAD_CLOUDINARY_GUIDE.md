# 📋 Status Upload & Cloudinary Integration

## ✅ Fitur yang Sudah Berfungsi

### 1. **Cloudinary Integration**

- ✅ Package `cloudinary-labs/cloudinary-laravel: ^3.0` terinstal
- ✅ CLOUDINARY_URL sudah dikonfigurasi di `.env`
- ✅ Method `cloudinary()->upload()` terintegrasi
- ✅ Support untuk berbagai format: JPG, PNG, WebP

### 2. **Upload Certificate**

- ✅ Model Certificate dengan kolom `image`
- ✅ Form validation (max 10MB, format jpg/jpeg/png/webp)
- ✅ Error handling untuk upload failure
- ✅ Automatic upload ke folder `portfolio/certificates`

### 3. **Upload Gambar Project**

- ✅ ProjectController support upload gambar
- ✅ Folder terpisah `portfolio/projects`
- ✅ Sama menggunakan Cloudinary

---

## ⚠️ Masalah yang Mungkin Terjadi di Azure

### **1. Request Timeout**

- **Gejala**: Upload gagal dengan timeout error
- **Penyebab**: Azure App Service memiliki default timeout ~230 detik
- **Solusi**: ✅ Sudah ditambahkan timeout configuration di trait

### **2. Temporary File Storage**

- **Gejala**: Error saat menyimpan file temporary
- **Penyebab**: Folder `/tmp` tidak writable di Azure
- **Solusi**: ✅ Upload langsung ke Cloudinary tanpa menyimpan temporary file

### **3. Memory Limit Exceeded**

- **Gejala**: Error "Allowed memory size exhausted"
- **Penyebab**: PHP memory limit 128MB default, file besar melebihi ini
- **Solusi**: ✅ File size validation di trait + Cloudinary optimization

### **4. Network Issues**

- **Gejala**: Upload intermittent success/failure
- **Penyebab**: Unstable network connection di Azure
- **Solusi**: ✅ Retry logic dengan exponential backoff sudah ditambahkan

---

## 🔧 Perbaikan yang Sudah Dilakukan

### **1. CloudinaryUploadHandler Trait**

File: `app/Traits/CloudinaryUploadHandler.php`

**Features:**

```php
// Method utama untuk upload
uploadToCloudinary(UploadedFile $file, array $options = [], int $maxRetries = 3)

// Automatic retry logic
// - Retry hingga 3 kali
// - Exponential backoff (1s, 2s, 4s)
// - Skip retry untuk validation errors

// File size validation
getMaxFileSizeInBytes()  // Respects PHP limits

// Unique public_id generation
generatePublicId(string $originalName)

// Comprehensive error logging
```

**Usage:**

```php
// Di Controller
use App\Traits\CloudinaryUploadHandler;

class CertificateController extends Controller {
    use CloudinaryUploadHandler;

    public function store(Request $request) {
        $uploadedFile = $this->uploadToCloudinary(
            $request->file('image'),
            ['folder' => 'portfolio/certificates']
        );
        $model->image = $uploadedFile['secure_url'];
    }
}
```

### **2. Updated Controllers**

- ✅ `CertificateController`: Menggunakan trait + retry logic
- ✅ `ProjectController`: Menggunakan trait + retry logic
- ✅ Both sudah dengan better error handling dan logging

### **3. Configuration File**

File: `config/upload.php`

```php
// Konfigurasi timeout, retry, dan Azure settings
// Environment-based configuration
// Support untuk fallback ke Azure Storage
```

---

## 🚀 Testing di Azure

### **Step 1: Deploy ke Azure**

```bash
git add .
git commit -m "Add Cloudinary upload improvements for Azure"
git push azure main
```

### **Step 2: Test Upload Certificate**

1. Login ke admin
2. Pergi ke "Add Certificate"
3. Upload file certificate
4. Check logs di Azure Application Insights

### **Step 3: Monitor Logs**

```bash
# Lihat logs di Azure Portal
# Application Insights > Logs > traces
# atau
az webapp log tail --resource-group <rg> --name <app-name>
```

---

## 📊 Checklist Troubleshooting

Jika masih ada error, cek ini:

### **Upload Gagal?**

- [ ] Cloudinary credentials valid di `.env`?
- [ ] File size < 10MB?
- [ ] Format image valid (JPG/PNG/WebP)?
- [ ] Network connection stable?
- [ ] Check logs untuk error detail

### **Timeout?**

- [ ] Update `php.ini` di Azure:

```ini
max_execution_time = 300
upload_max_filesize = 20M
post_max_size = 20M
```

### **Memory Error?**

- [ ] Increase memory limit di Azure App Service settings
- [ ] `WEBSITE_MEMORY_LIMIT_MB=512` (default 256)

### **CORS/Network Issue?**

- [ ] Check Network Security Group (NSG) rules
- [ ] Verify Cloudinary API accessible dari Azure

---

## 📝 Optimasi Lanjutan

Jika masih ada performance issue, bisa:

1. **Implement Chunked Upload** (untuk file >50MB)
   - Split file jadi chunks
   - Upload parallel
   - Resume support

2. **Queue Upload** (background processing)

   ```php
   dispatch(new ProcessCloudinaryUpload($file))->onQueue('uploads');
   ```

3. **Azure Blob Storage Fallback**
   - Upload ke Blob jika Cloudinary timeout
   - Serve dari Blob CDN

4. **Pre-signed URLs** (untuk client-side upload)
   - Direct upload dari browser ke Cloudinary
   - Bypass server altogether

---

## 🔗 Resources

- [Cloudinary Laravel](https://github.com/cloudinary-labs/cloudinary-laravel)
- [Azure App Service Limits](https://learn.microsoft.com/en-us/azure/app-service/overview)
- [Laravel File Upload Best Practices](https://laravel.com/docs/11.x/filesystem)

---

## 💡 Tips

1. **Selalu check logs**: Azure Portal > Application Insights > Logs
2. **Use fallback**: Jika upload gagal, save ke database dulu, retry nanti
3. **Test locally dulu**: Sebelum deploy, test di `php artisan serve`
4. **Monitor storage**: Cloudinary usage bisa inflate quickly

---

**Last Updated**: 2026-06-17
**Status**: ✅ Production Ready for Azure

# Form CRUD

Setiap menu memiliki form sendiri di `resources/views/admin/crud/<resource>/form.blade.php`.

- Education: jenjang SMA/SMK atau Kuliah menentukan field dan skala nilai.
- Field Urutan di form dihapus. Sistem mengisi `sort_order` otomatis saat data baru dibuat.
- Database tidak diubah/dihapus; `sort_order` tetap ada untuk menjaga kompatibilitas.

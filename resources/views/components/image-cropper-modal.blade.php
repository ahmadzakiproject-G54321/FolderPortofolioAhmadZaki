<!-- Modal Cropper Universal untuk Admin -->
<div id="imageCropperModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/80 backdrop-blur-sm p-3 sm:p-4 hidden transition-opacity duration-200" aria-hidden="true" role="dialog">
    <div class="relative w-full max-w-2xl overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl flex flex-col max-h-[94vh] animate-in fade-in zoom-in-95 duration-200">
        <!-- Modal Header -->
        <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3 sm:px-6 sm:py-4 bg-slate-50">
            <div>
                <h3 id="cropperModalTitle" class="text-sm sm:text-base font-bold text-slate-900 flex items-center gap-2">
                    <svg class="h-4 w-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5"/></svg>
                    <span>Sesuaikan &amp; Crop Gambar</span>
                </h3>
                <p id="cropperModalSubtitle" class="text-[11px] sm:text-xs text-slate-500 mt-0.5">Atur posisi, perbesar, atau putar gambar agar pas dan proporsional.</p>
            </div>
            <button type="button" id="btnCancelCropperX" class="rounded-lg p-1.5 text-slate-400 hover:bg-slate-200 hover:text-slate-700 transition" aria-label="Tutup">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Body (Cropper Viewport) -->
        <div class="p-3 sm:p-5 flex-1 overflow-y-auto">
            <!-- Cropper Canvas Container -->
            <div class="relative w-full h-[45vh] min-h-[260px] max-h-[420px] rounded-xl overflow-hidden bg-slate-950 flex items-center justify-center border border-slate-200 shadow-inner">
                <img id="cropperImageElement" src="" alt="Area Crop" class="max-h-full max-w-full block" />
            </div>

            <!-- Toolbar & Aspect Ratio Selector -->
            <div class="mt-3 flex flex-wrap items-center justify-between gap-2 border-t border-slate-100 pt-3">
                <!-- Ratio Buttons -->
                <div id="cropRatioButtons" class="flex items-center gap-1.5 flex-wrap">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mr-1">Rasio:</span>
                    <button type="button" data-ratio="1" class="crop-ratio-btn rounded-lg border border-slate-200 bg-white px-2.5 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-100 transition">
                        1:1 (Persegi)
                    </button>
                    <button type="button" data-ratio="1.77777777778" class="crop-ratio-btn rounded-lg border border-slate-200 bg-white px-2.5 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-100 transition">
                        16:9 (Lebar)
                    </button>
                    <button type="button" data-ratio="1.6" class="crop-ratio-btn rounded-lg border border-slate-200 bg-white px-2.5 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-100 transition">
                        16:10
                    </button>
                    <button type="button" data-ratio="1.33333333333" class="crop-ratio-btn rounded-lg border border-slate-200 bg-white px-2.5 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-100 transition">
                        4:3
                    </button>
                    <button type="button" data-ratio="free" class="crop-ratio-btn rounded-lg border border-slate-200 bg-white px-2.5 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-100 transition">
                        Bebas
                    </button>
                </div>

                <!-- Action Tools (Zoom & Rotate) -->
                <div class="flex items-center gap-1">
                    <button type="button" id="btnCropZoomIn" class="rounded-lg border border-slate-200 bg-white p-1.5 text-slate-600 hover:bg-slate-100 transition" title="Perbesar (Zoom In)">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    </button>
                    <button type="button" id="btnCropZoomOut" class="rounded-lg border border-slate-200 bg-white p-1.5 text-slate-600 hover:bg-slate-100 transition" title="Perkecil (Zoom Out)">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15"/></svg>
                    </button>
                    <button type="button" id="btnCropRotateLeft" class="rounded-lg border border-slate-200 bg-white p-1.5 text-slate-600 hover:bg-slate-100 transition" title="Putar 90° Kiri">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"/></svg>
                    </button>
                    <button type="button" id="btnCropRotateRight" class="rounded-lg border border-slate-200 bg-white p-1.5 text-slate-600 hover:bg-slate-100 transition" title="Putar 90° Kanan">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 15l6-6m0 0l-6-6m6 6H9a6 6 0 000 12h3"/></svg>
                    </button>
                    <button type="button" id="btnCropReset" class="rounded-lg border border-slate-200 bg-white p-1.5 text-slate-600 hover:bg-slate-100 transition" title="Reset Posisi">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Footer Actions -->
        <div class="flex flex-col-reverse sm:flex-row items-center justify-between gap-2.5 border-t border-slate-200 bg-slate-50 px-4 py-3 sm:px-6">
            <button type="button" id="btnCropUseOriginal" class="w-full sm:w-auto text-xs font-semibold text-slate-600 hover:text-slate-900 py-1.5 px-3 rounded-lg hover:bg-slate-200 transition">
                Gunakan Gambar Asli (Tanpa Crop)
            </button>
            <div class="flex items-center gap-2 w-full sm:w-auto">
                <button type="button" id="btnCancelCropper" class="flex-1 sm:flex-none rounded-xl border border-slate-300 bg-white px-4 py-2 text-xs sm:text-sm font-semibold text-slate-700 hover:bg-slate-100 transition">
                    Batal
                </button>
                <button type="button" id="btnApplyCrop" class="flex-1 sm:flex-none inline-flex items-center justify-center gap-1.5 rounded-xl bg-blue-600 px-5 py-2 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-blue-700 transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                    <span>Terapkan Hasil Crop</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        let cropperInstance = null;
        let activeTargetInput = null;
        let activePreviewElement = null;
        let originalSelectedFile = null;
        let isProcessingCrop = false;

        const modal = document.getElementById('imageCropperModal');
        const cropperImg = document.getElementById('cropperImageElement');
        const modalTitle = document.getElementById('cropperModalTitle');
        const modalSubtitle = document.getElementById('cropperModalSubtitle');
        const ratioButtons = document.querySelectorAll('.crop-ratio-btn');

        function setActiveRatioButton(ratioValue) {
            ratioButtons.forEach(btn => {
                const btnRatio = btn.getAttribute('data-ratio');
                const isMatch = (btnRatio === 'free' && isNaN(ratioValue)) || 
                                (Math.abs(parseFloat(btnRatio) - parseFloat(ratioValue)) < 0.05);
                if (isMatch) {
                    btn.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
                    btn.classList.remove('bg-white', 'text-slate-700', 'border-slate-200');
                } else {
                    btn.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                    btn.classList.add('bg-white', 'text-slate-700', 'border-slate-200');
                }
            });
        }

        window.openImageCropper = function (options) {
            if (!options || !options.file) return;

            activeTargetInput = options.targetInput || null;
            activePreviewElement = options.previewElement || null;
            originalSelectedFile = options.file;

            if (modalTitle) modalTitle.querySelector('span').textContent = options.title || 'Sesuaikan & Crop Gambar';
            if (modalSubtitle) modalSubtitle.textContent = options.subtitle || 'Atur posisi dan rasio gambar agar pas.';

            const initialRatio = options.defaultRatio !== undefined ? options.defaultRatio : 1;
            setActiveRatioButton(initialRatio);

            const reader = new FileReader();
            reader.onload = function (e) {
                if (cropperInstance) {
                    cropperInstance.destroy();
                    cropperInstance = null;
                }

                cropperImg.src = e.target.result;

                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');

                setTimeout(() => {
                    cropperInstance = new Cropper(cropperImg, {
                        aspectRatio: initialRatio,
                        viewMode: 1,
                        dragMode: 'move',
                        autoCropArea: 0.95,
                        restore: false,
                        guides: true,
                        center: true,
                        highlight: true,
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        toggleDragModeOnDblclick: false,
                        responsive: true,
                        ready: function () {
                            setActiveRatioButton(initialRatio);
                        }
                    });
                }, 100);
            };
            reader.readAsDataURL(options.file);
        };

        window.closeImageCropper = function () {
            if (cropperInstance) {
                cropperInstance.destroy();
                cropperInstance = null;
            }
            if (modal) {
                modal.classList.add('hidden');
            }
            document.body.classList.remove('overflow-hidden');
            activeTargetInput = null;
            activePreviewElement = null;
            originalSelectedFile = null;
        };

        // Ratio button click
        ratioButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                if (!cropperInstance) return;
                const ratioAttr = this.getAttribute('data-ratio');
                const ratio = ratioAttr === 'free' ? NaN : parseFloat(ratioAttr);
                cropperInstance.setAspectRatio(ratio);
                setActiveRatioButton(ratio);
            });
        });

        // Zoom & Rotate controls
        document.getElementById('btnCropZoomIn')?.addEventListener('click', () => cropperInstance?.zoom(0.1));
        document.getElementById('btnCropZoomOut')?.addEventListener('click', () => cropperInstance?.zoom(-0.1));
        document.getElementById('btnCropRotateLeft')?.addEventListener('click', () => cropperInstance?.rotate(-90));
        document.getElementById('btnCropRotateRight')?.addEventListener('click', () => cropperInstance?.rotate(90));
        document.getElementById('btnCropReset')?.addEventListener('click', () => cropperInstance?.reset());

        // Cancel buttons
        const handleCancel = () => {
            if (activeTargetInput && !isProcessingCrop) {
                // Jangan reset jika sudah ada file sebelumnya
            }
            closeImageCropper();
        };

        document.getElementById('btnCancelCropper')?.addEventListener('click', handleCancel);
        document.getElementById('btnCancelCropperX')?.addEventListener('click', handleCancel);

        // Fungsi pembaruan visual preview seketika
        function updatePreview(sourceUrl, fileInfo) {
            let preview = activePreviewElement;
            if (!preview && activeTargetInput) {
                // Cari preview terdekat atau berdasarkan ID
                preview = document.getElementById((activeTargetInput.id || activeTargetInput.name) + 'Preview') ||
                          activeTargetInput.closest('div')?.querySelector('img:not(#cropperImageElement)') ||
                          activeTargetInput.parentElement?.querySelector('img');
            }

            if (preview) {
                preview.src = sourceUrl;
                preview.classList.remove('opacity-40', 'hidden');
                const parentHidden = preview.closest('.hidden');
                if (parentHidden) parentHidden.classList.remove('hidden');
            } else if (activeTargetInput && activeTargetInput.parentElement) {
                // Tampilkan info preview card dinamis jika input tidak memiliki <img> preview bawaan
                let dynamicCard = activeTargetInput.parentElement.querySelector('.crop-dynamic-preview');
                if (!dynamicCard) {
                    dynamicCard = document.createElement('div');
                    dynamicCard.className = 'crop-dynamic-preview mt-2.5 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50/70 p-2.5';
                    activeTargetInput.parentElement.appendChild(dynamicCard);
                }
                dynamicCard.innerHTML = `
                    <img src="${sourceUrl}" class="h-14 w-20 shrink-0 rounded-lg object-cover border border-emerald-200 shadow-xs" alt="Pratinjau Hasil Crop">
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-1.5 text-xs font-semibold text-emerald-800">
                            <svg class="h-4 w-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                            <span>Crop Siap Disimpan</span>
                        </div>
                        <p class="truncate text-[11px] text-emerald-700 mt-0.5">${fileInfo || 'Foto telah disesuaikan'}</p>
                    </div>
                `;
            }
        }

        // Gunakan Gambar Asli (Tanpa Crop)
        document.getElementById('btnCropUseOriginal')?.addEventListener('click', function () {
            if (originalSelectedFile) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    updatePreview(e.target.result, `${originalSelectedFile.name} (Gambar Asli)`);
                };
                reader.readAsDataURL(originalSelectedFile);
            }
            closeImageCropper();
        });

        // Terapkan Hasil Crop
        document.getElementById('btnApplyCrop')?.addEventListener('click', function () {
            if (!cropperInstance || !activeTargetInput) return;

            const isIconOrFavicon = activeTargetInput.name === 'favicon' || 
                                   activeTargetInput.name === 'admin_favicon' ||
                                   activeTargetInput.id === 'faviconInput' || 
                                   activeTargetInput.id === 'adminFaviconInput';

            const isProfile = activeTargetInput.name === 'profile_photo' || 
                             activeTargetInput.id === 'profilePhotoInput';

            let targetWidth = 1200;
            let targetHeight = 1200;

            if (isIconOrFavicon) {
                targetWidth = 512;
                targetHeight = 512;
            } else if (isProfile) {
                targetWidth = 800;
                targetHeight = 800;
            }

            const canvas = cropperInstance.getCroppedCanvas({
                width: targetWidth,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });

            if (!canvas) {
                closeImageCropper();
                return;
            }

            isProcessingCrop = true;

            const mimeType = (originalSelectedFile && originalSelectedFile.type === 'image/png') ? 'image/png' : 'image/jpeg';
            const quality = mimeType === 'image/jpeg' ? 0.92 : undefined;

            canvas.toBlob(function (blob) {
                if (blob && activeTargetInput) {
                    const ext = mimeType === 'image/png' ? 'png' : 'jpg';
                    const baseName = (originalSelectedFile ? originalSelectedFile.name.replace(/\.[^/.]+$/, '') : 'cropped_image');
                    const newFileName = `${baseName}_cropped.${ext}`;

                    try {
                        const croppedFile = new File([blob], newFileName, {
                            type: mimeType,
                            lastModified: Date.now()
                        });

                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(croppedFile);
                        activeTargetInput.files = dataTransfer.files;

                        const previewUrl = URL.createObjectURL(blob);
                        const sizeKb = Math.round(blob.size / 1024);
                        updatePreview(previewUrl, `${newFileName} (${sizeKb} KB)`);
                    } catch (e) {
                        const previewUrl = canvas.toDataURL(mimeType, quality);
                        updatePreview(previewUrl, newFileName);
                    }
                }

                isProcessingCrop = false;
                closeImageCropper();
            }, mimeType, quality);
        });

        // Close on escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                closeImageCropper();
            }
        });

        // ============================================================
        // Auto-Attacher untuk Semua Input Gambar di Admin Panel
        // ============================================================
        window.attachImageCropper = function (inputSelector, previewSelector, config) {
            const input = typeof inputSelector === 'string' ? document.querySelector(inputSelector) : inputSelector;
            const preview = typeof previewSelector === 'string' ? document.querySelector(previewSelector) : previewSelector;

            if (!input || input.dataset.cropperBound) return;
            input.dataset.cropperBound = 'true';

            input.addEventListener('change', function (e) {
                if (isProcessingCrop) return;
                const file = this.files && this.files[0];
                if (!file || !file.type.startsWith('image/')) return;

                openImageCropper({
                    file: file,
                    targetInput: input,
                    previewElement: preview,
                    title: config?.title || 'Sesuaikan & Crop Gambar',
                    subtitle: config?.subtitle || 'Atur posisi dan area crop sebelum disimpan.',
                    defaultRatio: config?.defaultRatio !== undefined ? config.defaultRatio : 1
                });
            });
        };

        // Jalankan auto-attacher saat DOM siap
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Foto Profil
            const profileInput = document.querySelector('#profilePhotoInput, input[name="profile_photo"]');
            if (profileInput) {
                attachImageCropper(profileInput, '#profilePhotoPreview', {
                    title: 'Sesuaikan & Crop Foto Profil',
                    subtitle: 'Gunakan rasio 1:1 persegi agar avatar foto profil tampil rapi & simetris.',
                    defaultRatio: 1
                });
            }

            // 2. Favicon Frontend
            const faviconInput = document.querySelector('#faviconInput, input[name="favicon"]');
            if (faviconInput) {
                attachImageCropper(faviconInput, '#faviconPreview', {
                    title: 'Sesuaikan & Crop Icon Tab Website',
                    subtitle: 'Rasio 1:1 persegi sangat disarankan untuk icon browser pengunjung.',
                    defaultRatio: 1
                });
            }

            // 3. Admin Favicon
            const adminFaviconInput = document.querySelector('#adminFaviconInput, input[name="admin_favicon"]');
            if (adminFaviconInput) {
                attachImageCropper(adminFaviconInput, '#adminFaviconPreview', {
                    title: 'Sesuaikan & Crop Icon Tab Admin',
                    subtitle: 'Rasio 1:1 persegi untuk logo icon portal login dan dashboard admin.',
                    defaultRatio: 1
                });
            }

            // 4. Logo Website
            const logoInput = document.querySelector('#logoInput, input[name="logo"]');
            if (logoInput) {
                attachImageCropper(logoInput, '#logoPreview', {
                    title: 'Sesuaikan & Crop Logo Website',
                    subtitle: 'Pilih rasio bebas atau lebar sesuai format logo Anda.',
                    defaultRatio: NaN // Bebas
                });
            }

            // 5. CRUD Project Thumbnail
            const projectThumbnailInput = document.querySelector('input[name="thumbnail"]');
            if (projectThumbnailInput) {
                attachImageCropper(projectThumbnailInput, null, {
                    title: 'Sesuaikan & Crop Thumbnail Proyek',
                    subtitle: 'Rasio 16:10 atau 16:9 direkomendasikan untuk kartu portofolio.',
                    defaultRatio: 1.6
                });
            }

            // 6. CRUD Certificate Image
            const certImageInput = document.querySelector('input[name="certificate_image"]');
            if (certImageInput) {
                attachImageCropper(certImageInput, null, {
                    title: 'Sesuaikan & Crop Gambar Sertifikat',
                    subtitle: 'Pilih area sertifikat agar tampil jelas dan tidak terpotong.',
                    defaultRatio: 1.33333333333
                });
            }

            // 7. Input dengan atribut data-crop eksplisit
            document.querySelectorAll('input[type="file"][data-crop]').forEach(input => {
                const ratioAttr = input.getAttribute('data-crop');
                let ratio = 1;
                if (ratioAttr === '16:9') ratio = 16 / 9;
                else if (ratioAttr === '16:10') ratio = 16 / 10;
                else if (ratioAttr === '4:3') ratio = 4 / 3;
                else if (ratioAttr === 'free') ratio = NaN;

                const previewTarget = input.getAttribute('data-preview');
                attachImageCropper(input, previewTarget, {
                    title: input.getAttribute('data-crop-title') || 'Sesuaikan & Crop Gambar',
                    defaultRatio: ratio
                });
            });

            // 8. Seluruh input file gambar lainnya pada form multipart
            document.querySelectorAll('form[enctype*="multipart"] input[type="file"]').forEach(input => {
                if (!input.dataset.cropperBound) {
                    attachImageCropper(input, null, {
                        title: 'Sesuaikan & Crop Gambar',
                        subtitle: 'Atur posisi dan rasio gambar sesuai keinginan Anda.',
                        defaultRatio: NaN
                    });
                }
            });
        });
    })();
</script>

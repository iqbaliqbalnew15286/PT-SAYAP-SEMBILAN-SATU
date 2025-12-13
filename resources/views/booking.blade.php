<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Janji Temu - Tower Management</title>

    {{-- Bootstrap 5 CSS CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome (untuk Ikon) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Google Font: Poppins (Jika ingin font lebih modern) --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    {{-- Custom styles (diubah ke Bootstrap) --}}
    <style>
        /* -------------------------------------
            COLOR THEME: TOWER (AMBER & DARK BLUE)
        ---------------------------------------*/
        :root {
            --primary: #FFC300;
            /* Kuning Emas */
            --primary-dark: #FFAA00;
            --dark-accent: #2C3E50;
            /* Teks Utama / Dark Accent */
            --bg-light: #F8F9FB;
            /* Latar Belakang Terang */
            --text-muted: #7F8C8D;
            --whatsapp-green: #25D366;
        }

        body {
            background-color: var(--bg-light);
            color: var(--dark-accent);
            font-family: 'Poppins', sans-serif;
        }

        .section-padding {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        /* Stepper Navigation (Modernized) */
        .step-nav-item {
            position: relative;
            padding: 10px 15px;
            font-weight: 600;
            cursor: default;
            /* Non-clickable navigation */
            transition: all 0.3s ease;
            color: var(--text-muted);
            flex-grow: 1;
            text-align: center;
        }

        .step-nav-item::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: #e9ecef;
            transition: background-color 0.3s;
        }

        /* Navigasi Aktif */
        .step-nav-item.active {
            color: var(--dark-accent);
        }

        .step-nav-item.active::before {
            background-color: var(--primary);
        }

        /* Card Layanan & Produk (Modernized) */
        .select-label {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid #dee2e6;
            border-radius: 0.75rem;
            min-height: 100%;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);
        }

        .select-label:hover {
            border-color: #ced4da;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
        }

        .select-label.selected {
            border-color: var(--primary);
            background-color: #FFFDF5;
            /* Sedikit latar belakang kuning */
            box-shadow: 0 4px 15px rgba(255, 195, 0, 0.2);
        }

        /* Indicator Styling */
        .checked-indicator {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #A0AEC0;
            background-color: white;
            transition: all 0.3s ease;
        }

        .select-label.selected .checked-indicator {
            border-color: var(--primary);
            background-color: var(--primary);
        }

        .select-label.selected .checked-indicator i {
            opacity: 1 !important;
            color: var(--dark-accent);
            font-size: 0.8rem;
        }

        /* Time Slots */
        .time-slot {
            font-size: 1.1rem;
            font-weight: 600;
            border: 1px solid #dee2e6;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .time-slot:hover {
            background-color: #f1f1f1;
        }

        .time-slot.selected {
            border: 2px solid var(--primary);
            background-color: var(--primary);
            color: var(--dark-accent);
            box-shadow: 0 4px 8px rgba(255, 195, 0, 0.2);
        }

        /* Time Slots Disabled (PERBAIKAN CSS) */
        .time-slot.disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background-color: #f1f1f1;
            border-color: #e9ecef;
            box-shadow: none;
            color: #7F8C8D;
        }

        /* Custom Button & Form Focus */
        .btn-primary-custom {
            background-color: var(--primary);
            border-color: var(--primary);
            color: var(--dark-accent);
            font-weight: 700;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: var(--dark-accent);
        }

        .btn-whatsapp {
            background-color: var(--whatsapp-green);
            border-color: var(--whatsapp-green);
        }
        .btn-whatsapp:hover {
            background-color: #20b057;
            border-color: #20b057;
        }

        .form-control:focus {
            border-color: var(--primary-dark);
            box-shadow: 0 0 0 0.25rem rgba(255, 195, 0, 0.25);
        }
    </style>
</head>

<body>

    {{-- HEADER/TOMBOL KEMBALI --}}
    <div class="bg-white py-3 border-bottom sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            {{-- Menggunakan route('home') --}}
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Halaman Utama
            </a>
            <h5 class="mb-0 fw-bold text-dark-accent">Booking Konsultasi</h5>
            <div></div> {{-- Spacer --}}
        </div>
    </div>

    {{-- Hero Section Booking --}}
    <section class="section-padding py-5 bg-light text-center border-bottom border-4 border-primary">
        <div class="container">
            <h1 class="display-5 fw-bold text-dark-accent mb-2">Buat Janji Temu Konsultasi</h1>
            <p class="lead text-secondary mx-auto" style="max-width: 600px;">
                Tiga langkah mudah untuk memesan sesi konsultasi Anda. Semua konfirmasi akan dikirim via WhatsApp.
            </p>
        </div>
    </section>

    {{-- Booking Form Container --}}
    <section class="section-padding bg-white">
        <div class="container" style="max-width: 850px;">

            {{-- STEPPER NAVIGATION (Visual) --}}
            <div class="d-flex mb-5 border-bottom">
                <div id="step-1-nav" class="step-nav-item active">
                    <i class="fas fa-box me-2 d-none d-sm-inline"></i> Pilih Produk & Jasa
                </div>
                <div id="step-2-nav" class="step-nav-item">
                    <i class="fas fa-calendar-alt me-2 d-none d-sm-inline"></i> Pilih Jadwal
                </div>
                <div id="step-3-nav" class="step-nav-item">
                    <i class="fas fa-user-check me-2 d-none d-sm-inline"></i> Data Diri & Kirim
                </div>
            </div>

            <form id="booking-form" onsubmit="return false;">
                {{-- NOTE: Asumsi $products dan $services berisi data dari Controller --}}

                {{-- STEP 1: PILIH PRODUK & LAYANAN --}}
                <div id="step-1" class="step-content">
                    <h2 class="h4 fw-bold text-dark-accent mb-4">1. Pilih Produk dan Jasa yang Anda Minati</h2>

                    {{-- PRODUK --}}
                    <h3 class="h5 fw-bold text-dark-accent border-bottom pb-2 mt-4 mb-3">Produk Tower Management</h3>
                    <div class="row g-4">
                        @forelse ($products as $product)
                            <div class="col-md-6">
                                <label class="p-4 bg-white select-label d-block position-relative">
                                    <input type="checkbox" name="selected_items" value="Produk: {{ $product->name }}"
                                        data-price_raw="{{ $product->price }}"
                                        class="position-absolute opacity-0 select-checkbox">

                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="p-3 rounded-3 d-flex align-items-center justify-content-center"
                                                style="background-color: rgba(44, 62, 80, 0.05);">
                                                {{-- Ikon Produk (Contoh: Gedung) --}}
                                                <i class="fa-solid fa-building fa-lg text-dark-accent"></i>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 min-w-0">
                                            <span class="fw-bold text-dark-accent d-block">{{ $product->name }}</span>
                                            <p class="text-secondary small mt-1 mb-2">
                                                {{ Str::limit($product->description, 60) }}</p>
                                            <span class="badge bg-secondary rounded-pill small">Produk</span>
                                        </div>

                                        <div class="ms-3 flex-shrink-0">
                                            <div class="checked-indicator rounded-circle">
                                                <i class="fas fa-check opacity-0"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="h6 fw-bolder text-primary mt-2 d-block text-end">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </label>
                            </div>
                        @empty
                            {{-- Jika tidak ada produk --}}
                        @endforelse
                    </div>

                    {{-- LAYANAN / JASA --}}
                    <h3 class="h5 fw-bold text-dark-accent border-bottom pb-2 mt-5 mb-3">Jasa Konsultasi & Layanan</h3>
                    <div class="row g-4">
                        {{-- Perulangan Data Layanan dari Controller --}}
                        @forelse ($services as $service)
                            <div class="col-md-6">
                                <label class="p-4 bg-white select-label d-block position-relative">
                                    <input type="checkbox" name="selected_items" value="Jasa: {{ $service->name }}"
                                        data-price_raw="{{ $service->price }}"
                                        class="position-absolute opacity-0 select-checkbox">

                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="p-3 rounded-3 d-flex align-items-center justify-content-center"
                                                style="background-color: rgba(255, 195, 0, 0.2);">
                                                {{-- Ikon Layanan (Contoh: Hard Hat) --}}
                                                <i class="fa-solid fa-hard-hat fa-lg text-primary"></i>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 min-w-0">
                                            <span class="fw-bold text-dark-accent d-block">{{ $service->name }}</span>
                                            <p class="text-secondary small mt-1 mb-2">
                                                {{ Str::limit($service->description, 60) }}</p>
                                            <span class="badge bg-info text-dark rounded-pill small">Layanan</span>
                                        </div>

                                        <div class="ms-3 flex-shrink-0">
                                            <div class="checked-indicator rounded-circle">
                                                <i class="fas fa-check opacity-0"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="h6 fw-bolder text-primary mt-2 d-block text-end">
                                        Rp{{ number_format($service->price, 0, ',', '.') }}
                                    </span>
                                </label>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-warning text-center" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i> Belum ada layanan/produk yang dapat
                                    dibooking saat ini.
                                </div>
                            </div>
                        @endforelse
                    </div>

                    {{-- Total & Next Button --}}
                    <div class="mt-5 d-flex justify-content-between align-items-center p-4 rounded-3 border bg-light">
                        <p class="h5 fw-bold text-dark-accent mb-0">Total Estimasi: <span id="total-price"
                                class="text-primary">Rp 0</span></p>
                        <button type="button" onclick="nextStep(2)" class="btn btn-lg btn-primary-custom shadow-lg"
                            disabled id="next-step-1">
                            Lanjut ke Jadwal <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                {{-- STEP 2: PILIH JADWAL --}}
                <div id="step-2" class="step-content d-none">
                    <h2 class="h4 fw-bold text-dark-accent mb-4">2. Pilih Tanggal dan Waktu Konsultasi</h2>
                    <p class="text-secondary mb-4">Pilih tanggal dan slot waktu yang tersedia untuk janji temu Anda.
                        Jadwal buka: 09:00 - 18:00 WIB.</p>

                    {{-- Pilihan Tanggal --}}
                    <div class="mb-4">
                        <label for="booking_date" class="form-label fw-bold">Tanggal Janji Temu</label>
                        <input type="date" id="booking_date" name="booking_date" class="form-control"
                            min="{{ date('Y-m-d') }}" required style="max-width: 300px;">
                    </div>

                    {{-- Pilihan Waktu (Simulasi) --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Slot Waktu Tersedia</label>
                        <div class="alert alert-info small py-2" id="time-slot-info">
                            <i class="fas fa-info-circle me-1"></i> Pilih tanggal di atas untuk mengaktifkan slot waktu.
                        </div>
                        <div class="row g-3" id="time-slots-container">
                            @php
                                $timeSlots = ['09:00', '10:30', '12:00', '13:30', '15:00', '16:30', '18:00'];
                            @endphp

                            @foreach ($timeSlots as $slot)
                                <div class="col-4 col-sm-3 col-md-2">
                                    <div class="time-slot p-3 rounded-3 border text-center disabled"
                                        data-time="{{ $slot }}">
                                        {{ $slot }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" id="booking_time" name="booking_time" required>
                    </div>

                    <div class="mt-5 d-flex justify-content-between">
                        <button type="button" onclick="prevStep(1)" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Pemilihan Item
                        </button>
                        <button type="button" onclick="nextStep(3)" class="btn btn-lg btn-primary-custom shadow-lg"
                            disabled id="next-step-2">
                            Lanjut ke Data Diri <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                {{-- STEP 3: DATA DIRI & KONFIRMASI --}}
                <div id="step-3" class="step-content d-none">
                    <h2 class="h4 fw-bold text-dark-accent mb-4">3. Data Diri & Finalisasi</h2>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold">Nama Lengkap Anda</label>
                            <input type="text" id="name" name="name" class="form-control form-control-lg"
                                placeholder="Nama lengkap sesuai KTP/identitas" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-bold">Alamat Email Aktif</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg"
                                placeholder="contoh@email.com" required>
                            <div class="form-text">Untuk komunikasi tambahan dan arsip Anda.</div>
                        </div>
                        <div class="col-12">
                            <label for="notes" class="form-label fw-bold">Catatan Tambahan (Opsional)</label>
                            <textarea id="notes" name="notes" class="form-control" rows="3"
                                placeholder="Contoh: Saya membutuhkan konsultasi spesifik tentang desain pondasi tipe A."></textarea>
                        </div>
                    </div>

                    {{-- Summary Box --}}
                    <div class="bg-light p-4 rounded-3 border border-primary border-opacity-50 mb-4 shadow-sm">
                        <h3 class="h5 fw-bold text-dark-accent mb-3"><i
                                class="fas fa-check-circle text-primary me-2"></i> Konfirmasi Booking</h3>
                        <div class="small text-secondary mb-2">
                            <p class="mb-1">Item Dipilih: <span id="summary-items"
                                    class="fw-bold text-dark-accent"></span></p>
                            <p class="mb-1">Tanggal: <span id="summary-date"
                                    class="fw-bold text-dark-accent"></span></p>
                            <p class="mb-1">Waktu: <span id="summary-time" class="fw-bold text-dark-accent"></span>
                            </p>
                        </div>
                        <p class="h5 fw-bolder mt-3 pt-3 border-top border-secondary border-opacity-25 mb-0">Total
                            Estimasi: <span id="summary-price" class="text-primary"></span></p>
                    </div>

                    <div class="mt-5 d-flex justify-content-between">
                        <button type="button" onclick="prevStep(2)" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Koreksi Jadwal
                        </button>

                        {{-- Tombol Final ke WhatsApp --}}
                        <button type="submit" onclick="redirectToWhatsApp()"
                            class="btn btn-lg btn-success btn-whatsapp shadow-xl text-white">
                            <i class="fa-brands fa-whatsapp me-2"></i> Kirim Konfirmasi via WhatsApp
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    {{-- Bootstrap 5 JS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // --- STATE MANAGEMENT ---
        let currentStep = 1;
        const steps = document.querySelectorAll('.step-content');
        const navItems = document.querySelectorAll('.step-nav-item');

        // Ganti dengan nomor WhatsApp penerima yang sesungguhnya (Contoh dari config di file awal)
        const whatsappNumber = '6289502669582'; // Ganti ini dengan nomor WA Tower Management

        // --- STEP NAVIGATION LOGIC ---
        function updateStepDisplay() {
            steps.forEach((step, index) => {
                step.classList.toggle('d-none', index + 1 !== currentStep);
            });

            navItems.forEach((nav, index) => {
                nav.classList.remove('active');
                if (index + 1 === currentStep) {
                    nav.classList.add('active');
                }
            });

            if (currentStep === 3) {
                updateSummary();
            }
        }

        function nextStep(step) {
            if (validateStep(step - 1)) {
                currentStep = step;
                updateStepDisplay();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            } else {
                alert('Mohon lengkapi semua pilihan di langkah ini.');
            }
        }

        function prevStep(step) {
            currentStep = step;
            updateStepDisplay();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // --- VALIDATION & BUTTON TOGGLE ---

        // Step 1: Services & Products Validation
        const selectCheckboxes = document.querySelectorAll('.select-checkbox');
        const nextStep1Btn = document.getElementById('next-step-1');
        const totalPriceSpan = document.getElementById('total-price');
        const selectLabels = document.querySelectorAll('.select-label');

        selectLabels.forEach(label => {
            const checkbox = label.querySelector('.select-checkbox');
            const indicator = label.querySelector('.checked-indicator');

            if (checkbox) {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        label.classList.add('selected');
                        if (indicator) {
                            indicator.querySelector('i').classList.remove('opacity-0');
                        }
                    } else {
                        label.classList.remove('selected');
                        if (indicator) {
                            indicator.querySelector('i').classList.add('opacity-0');
                        }
                    }
                    updateSelectValidation();
                });
            }
        });

        function updateSelectValidation() {
            let isAnyChecked = Array.from(selectCheckboxes).some(cb => cb.checked);
            nextStep1Btn.disabled = !isAnyChecked;
            calculateTotal();
        }

        function calculateTotal() {
            let total = 0;
            selectCheckboxes.forEach(cb => {
                if (cb.checked) {
                    const price = cb.dataset.price_raw;
                    total += parseInt(price);
                }
            });
            totalPriceSpan.textContent = 'Rp ' + total.toLocaleString('id-ID');
            return total;
        }

        updateSelectValidation(); // Inisialisasi awal

        // --- Step 2: Time Slot & Date Validation (PERBAIKAN FUNGSI WAKTU) ---
        const timeSlots = document.querySelectorAll('.time-slot');
        const bookingDateInput = document.getElementById('booking_date');
        const bookingTimeInput = document.getElementById('booking_time');
        const nextStep2Btn = document.getElementById('next-step-2');
        const timeSlotInfo = document.getElementById('time-slot-info');


        // Event Listener untuk memilih slot waktu
        timeSlots.forEach(slot => {
            slot.addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    // 1. Hapus status 'selected' dari semua slot
                    timeSlots.forEach(s => s.classList.remove('selected'));

                    // 2. Tambahkan status 'selected' ke slot yang diklik
                    this.classList.add('selected');

                    // 3. Simpan nilai waktu ke hidden input
                    bookingTimeInput.value = this.dataset.time;

                    // 4. Periksa validasi
                    checkStep2Validation();
                }
            });
        });

        // Fungsi untuk mengaktifkan/menonaktifkan slot waktu berdasarkan pilihan tanggal
        function toggleTimeSlotAvailability() {
            const isDateSelected = bookingDateInput.value;

            if (isDateSelected) {
                // Tanggal dipilih: Aktifkan slot waktu dan sembunyikan info
                timeSlotInfo.classList.add('d-none');
                timeSlots.forEach(slot => {
                    slot.classList.remove('disabled');
                    slot.removeAttribute('title');
                });
            } else {
                // Tanggal belum dipilih: Nonaktifkan slot waktu dan tampilkan info
                timeSlotInfo.classList.remove('d-none');
                timeSlots.forEach(slot => {
                    slot.classList.add('disabled');
                    slot.classList.remove('selected');
                    slot.setAttribute('title', 'Pilih tanggal terlebih dahulu');
                });
                bookingTimeInput.value = ''; // Reset waktu
            }

            checkStep2Validation();
        }

        // Event Listener untuk input Tanggal
        bookingDateInput.addEventListener('change', function() {
            toggleTimeSlotAvailability();
        });


        function checkStep2Validation() {
            const isDateSelected = bookingDateInput.value;
            const isTimeSelected = bookingTimeInput.value;

            // Tombol aktif jika Tanggal dan Waktu sudah terisi
            nextStep2Btn.disabled = !(isDateSelected && isTimeSelected);
        }

        // Main Validation untuk Step Navigation
        function validateStep(stepIndex) {
            if (stepIndex === 1) {
                return Array.from(selectCheckboxes).some(cb => cb.checked);
            }
            if (stepIndex === 2) {
                return bookingDateInput.value && bookingTimeInput.value;
            }
            return true;
        }

        // --- SUMMARY & WHATSAPP REDIRECT ---

        function updateSummary() {
            const form = document.getElementById('booking-form');
            const formData = new FormData(form);

            // 1. Items
            let selectedItems = [];
            let total = 0;
            document.querySelectorAll('input[name="selected_items"]:checked').forEach(cb => {
                selectedItems.push(cb.value);
                const price = cb.dataset.price_raw;
                total += parseInt(price);
            });

            document.getElementById('summary-items').textContent = selectedItems.join('; ');

            // 2. Date
            const dateRaw = formData.get('booking_date');
            const formattedDate = dateRaw ? new Date(dateRaw + 'T00:00:00').toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }) : '';

            document.getElementById('summary-date').textContent = formattedDate;
            document.getElementById('summary-time').textContent = formData.get('booking_time');

            // 3. Price
            const formattedPrice = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('summary-price').textContent = formattedPrice;
        }

        function redirectToWhatsApp() {
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const notesInput = document.getElementById('notes');

            if (!nameInput.value || !emailInput.value) {
                alert('Mohon lengkapi Nama Lengkap dan Alamat Email sebelum mengirim.');
                nameInput.focus();
                return false;
            }

            // Ambil Data Final
            const name = nameInput.value;
            const email = emailInput.value;
            const notes = notesInput.value || '(Tidak ada catatan)';
            const date = document.getElementById('summary-date').textContent;
            const time = document.getElementById('summary-time').textContent;
            const itemsString = document.getElementById('summary-items').textContent;
            const totalPrice = document.getElementById('summary-price').textContent;

            // Susun Pesan WhatsApp
            const message =
                `*Konfirmasi Booking Tower Management*\n\n--- DETAIL BOOKING ---\n\n*Item Dipilih:* ${itemsString}\n*Total Estimasi:* ${totalPrice}\n\n*Tanggal Janji Temu:* ${date}\n*Waktu:* ${time}\n\n--- DATA PELANGGAN ---\n\n*Nama:* ${name}\n*Email:* ${email}\n*Catatan:* ${notes}\n\nMohon konfirmasi booking ini. Terima kasih!`;

            const encodedMessage = encodeURIComponent(message);
            const whatsappLink = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;

            window.open(whatsappLink, '_blank');

            return false;
        }

        // Inisialisasi
        updateStepDisplay();
        toggleTimeSlotAvailability(); // Panggil saat awal untuk menonaktifkan slot waktu
    </script>

</body>

</html>

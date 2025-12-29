@extends('layouts.app')

@section('title', 'Hubungi Kami - PT. Rizqallah Boer Makmur')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <section class="min-h-screen bg-[#F8F9FB] pt-32 pb-20 px-4">
        <div class="max-w-6xl mx-auto">

            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-extrabold text-[#2C3E50] mb-4 tracking-tight" data-aos="fade-down">
                    Hubungi Kami
                </h2>
                <div class="w-20 h-1.5 bg-[#FFC300] mx-auto rounded-full mb-6"></div>
                <p class="text-[#7F8C8D] max-w-2xl mx-auto text-lg leading-relaxed" data-aos="fade-down" data-aos-delay="100">
                    Tim kami siap membantu Anda dengan pertanyaan mengenai proyek, layanan, atau kemitraan bisnis.
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden" data-aos="fade-up"
                data-aos-delay="200">
                <div class="grid grid-cols-1 lg:grid-cols-3 divide-y lg:divide-y-0 lg:divide-x divide-gray-100">

                    <div class="p-8 md:p-12">
                        <h3 class="text-xl font-bold text-[#2C3E50] mb-8 pb-3 border-b-2 border-gray-50 flex items-center">
                            <span class="w-8 h-1 bg-[#FFC300] mr-3 rounded-full"></span>
                            Kontak Utama
                        </h3>

                        <div class="space-y-8">
                            <div class="flex items-start gap-4 group">
                                <div class="text-3xl text-[#FFC300] transition-transform group-hover:scale-110">
                                    <i class="bi bi-headset"></i>
                                </div>
                                <div>
                                    <a href="tel:+6221XXXXXXX"
                                        class="text-lg font-semibold text-[#2C3E50] hover:text-[#FFC300] transition-colors">
                                        +62 813 9488 4596
                                    </a>
                                    <p class="text-sm text-[#7F8C8D] mt-1">Dwi Yudho M</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 group">
                                <div class="text-3xl text-[#FFC300] transition-transform group-hover:scale-110">
                                    <i class="bi bi-briefcase"></i>
                                </div>
                                <div>
                                    <a href="https://wa.me/6281234567890" target="_blank"
                                        class="text-lg font-semibold text-[#2C3E50] hover:text-[#FFC300] transition-colors">
                                        +61 821 2123 3261
                                    </a>
                                    <p class="text-sm text-[#7F8C8D] mt-1">Arif Endi</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 group">
                                <div class="text-3xl text-[#FFC300] transition-transform group-hover:scale-110">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div>
                                    <span class="text-base font-medium text-[#2C3E50] leading-relaxed">
                                        Menara Palma Lantai 12
                                        Jl. HR. Rasuna Said Kav. 6 Blok X-2
                                        Jakarta Selatan 12950F
                                    </span>
                                    <p class="text-sm text-[#7F8C8D] mt-1">Kantor Pusat</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 md:p-12 bg-gray-50/50">
                        <h3 class="text-xl font-bold text-[#2C3E50] mb-6 pb-3 border-b-2 border-gray-100 flex items-center">
                            <span class="w-8 h-1 bg-[#FFC300] mr-3 rounded-full"></span>
                            Lokasi Kami
                        </h3>
                        <p class="text-sm text-[#7F8C8D] mb-6 italic">Kunjungi kantor pusat kami. Mohon buat janji temu
                            terlebih dahulu.</p>

                        <div class="rounded-2xl overflow-hidden shadow-inner border border-gray-200 h-64 lg:h-72">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.347017420738!2d106.8308452!3d-6.2268615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3f1da7a4369%3A0x2421b19a6801489c!2sMenara%20Palma!5e0!3m2!1sid!2sid!4v1733750000000"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                    </div>

                    <div class="p-8 md:p-12">
                        <h3 class="text-xl font-bold text-[#2C3E50] mb-8 pb-3 border-b-2 border-gray-50 flex items-center">
                            <span class="w-8 h-1 bg-[#FFC300] mr-3 rounded-full"></span>
                            Digital & Media
                        </h3>

                        <div class="mb-10">
                            <h4 class="text-xs uppercase tracking-widest font-bold text-[#7F8C8D] mb-4">Email Resmi</h4>
                            <div class="space-y-4">
                                <a href="mailto:info@towermanagement.com"
                                    class="flex items-center gap-3 text-[#2C3E50] font-semibold hover:text-[#FFC300] transition group">
                                    <i class="bi bi-envelope-at-fill text-xl text-[#FFC300]"></i>
                                    marketing@rbmak.co.id

                                </a>
                                <a href="mailto:careers@towermanagement.com"
                                    class="flex items-center gap-3 text-[#2C3E50] font-semibold hover:text-[#FFC300] transition group">
                                    <i class="bi bi-person-workspace text-xl text-[#FFC300]"></i>
                                    project@rbmak.co.id
                                </a>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-xs uppercase tracking-widest font-bold text-[#7F8C8D] mb-4">Ikuti Kami</h4>
                            <div class="flex flex-wrap gap-3">
                                <a href="#"
                                    class="w-11 h-11 flex items-center justify-center bg-gray-100 rounded-xl text-[#2C3E50] hover:bg-[#FFC300] hover:text-white transition-all transform hover:-translate-y-1 shadow-sm">
                                    <i class="bi bi-linkedin text-lg"></i>
                                </a>
                                <a href="#"
                                    class="w-11 h-11 flex items-center justify-center bg-gray-100 rounded-xl text-[#2C3E50] hover:bg-[#FFC300] hover:text-white transition-all transform hover:-translate-y-1 shadow-sm">
                                    <i class="bi bi-twitter-x text-lg"></i>
                                </a>
                                <a href="#"
                                    class="w-11 h-11 flex items-center justify-center bg-gray-100 rounded-xl text-[#2C3E50] hover:bg-[#FFC300] hover:text-white transition-all transform hover:-translate-y-1 shadow-sm">
                                    <i class="bi bi-youtube text-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app')

@section('title', 'Kontak Kami')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #0f0f0f;
        color: #eaeaea;
    }

    .contact-section {
        padding-top: 130px;
        padding-bottom: 80px;
    }

    .contact-box {
        background: #131313;
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 16px;
        padding: 35px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.45);
        transition: .3s ease;
    }

    .contact-box:hover {
        box-shadow: 0 10px 35px rgba(255,176,0,0.12);
        transform: translateY(-3px);
    }

    .section-title {
        color: #fff;
        font-weight: 700;
        font-size: 2rem;
        text-align: center;
        margin-bottom: 20px;
    }

    .gold-line {
        width: 80px;
        height: 3px;
        background: #ffb400;
        margin: 0 auto 40px;
        border-radius: 4px;
    }

    .column-header {
        font-weight: 700;
        color: #ffb400;
        font-size: 1.15rem;
        margin-bottom: 15px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 22px;
    }

    .contact-item i {
        font-size: 1.8rem;
        color: #ffb400;
    }

    .contact-item .number {
        font-size: 1.1rem;
        font-weight: 600;
        color: #fff;
        text-decoration: none;
        transition:.2s ease;
    }

    .contact-item .number:hover {
        color: #ffb400;
    }

    .label {
        font-size: .85rem;
        color: #bfbfbf;
    }

    .review-text {
        color: #cfcfcf;
        font-size: .9rem;
        line-height: 1.55;
    }

    .review-title {
        font-weight: 600;
        color: #fff;
        display: inline-block;
        margin-bottom: 4px;
    }

    .social-icons a {
        width: 45px;
        height: 45px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1.2rem;
        margin-right: 10px;
        margin-bottom: 10px;
        background: #1a1a1a;
        color: #ffb400;
        border: 1px solid rgba(255,255,255,0.1);
        transition: .3s;
    }

    .social-icons a:hover {
        transform: translateY(-4px);
        background: #ffb400;
        color: #0f0f0f;
        box-shadow: 0 0 15px rgba(255,176,0,0.4);
    }

    .email-contact {
        color: #fff;
        font-weight: 500;
        text-decoration: none;
        font-size: 1rem;
        display: flex;
        align-items: center;
        margin-top: 6px;
    }

    .email-contact i {
        font-size: 1.25rem;
        margin-right: 8px;
        color: #ffb400;
    }

    .email-contact:hover {
        color: #ffb400;
    }
</style>
@endpush

@section('content')

<section class="contact-section">
    <div class="container">

        <h2 class="section-title">Hubungi Kami</h2>
        <div class="gold-line"></div>

        <div class="contact-box">
            <div class="row">

                {{-- LEFT: Contact --}}
                <div class="col-md-4 mb-4">
                    <h3 class="column-header">Reservasi & Informasi :</h3>

                    <div class="contact-item">
                        <i class="bi bi-telephone-inbound-fill"></i>
                        <div>
                            <a href="https://wa.me/6282221290755" class="number" target="_blank">+62 822 2129 0755</a>
                            <div class="label">Admin Pusat Gito Gati</div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="bi bi-telephone-inbound-fill"></i>
                        <div>
                            <a href="https://wa.me/6282328029682" class="number" target="_blank">+62 823 2802 9682</a>
                            <div class="label">Admin Condongcatur</div>
                        </div>
                    </div>
                </div>

                {{-- MIDDLE: Review --}}
                <div class="col-md-4 mb-4">
                    <h3 class="column-header">Review Google :</h3>

                    <div class="mb-3">
                        <span class="review-title">Pusat Gito Gati</span>
                        <p class="review-text">
                            Jl. Gito Gati, Gondang Legi, Sleman, Yogyakarta
                        </p>
                    </div>

                    <div>
                        <span class="review-title">Cabang Condongcatur</span>
                        <p class="review-text">
                            Jalan Persatuan, Dero, Condongcatur, Sleman, Yogyakarta
                        </p>
                    </div>
                </div>

                {{-- RIGHT: Social + Email --}}
                <div class="col-md-4">
                    <h3 class="column-header">Ikuti Kami :</h3>

                    <div class="social-icons mb-3">
                        <a href="https://www.facebook.com/share/16wfNkG27Q/?mibextid=wwXIfr" target="_blank"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="https://www.instagram.com/byfrs22/?igsh=ZzBpa2hzNnlsdWh5" target="_blank"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                        <a href="https://www.tiktok.com/@byfrs22?_r=1&_t=ZS-914h5dBTJjj" target="_blank"><i class="bi bi-tiktok"></i></a>
                    </div>

                    <h3 class="column-header">Email :</h3>
                    <a href="mailto:bidanvitacare@gmail.com" class="email-contact">
                        <i class="bi bi-envelope"></i> bidanvitacare@gmail.com
                    </a>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection

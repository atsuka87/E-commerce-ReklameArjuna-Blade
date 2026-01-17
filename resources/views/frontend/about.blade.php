@extends('frontend.layouts.app')

@section('title', 'About')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-gray-900 to-gray-700 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Tentang <span class="text-yellow-400">Reklame Arjuna</span>
            </h1>
            <p class="text-xl text-gray-300">
                Mitra Terpercaya untuk Solusi Reklame dan Custom Printing
            </p>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">
                    Lebih dari 10 Tahun Pengalaman
                </h2>
                <p class="text-gray-600 mb-6">
                    Reklame Arjuna didirikan pada tahun 2002 dengan visi menjadi penyedia solusi reklame 
                    terkemuka di Indonesia. Selama lebih dari 20 tahun, kami telah melayani ribuan klien 
                    dari berbagai industri, mulai dari UMKM hingga perusahaan besar.
                </p>
                <p class="text-gray-600 mb-6">
                    Kami memahami bahwa setiap bisnis memiliki kebutuhan unik dalam hal branding dan promosi. 
                    Oleh karena itu, kami menawarkan berbagai produk yang dapat disesuaikan dengan kebutuhan spesifik Anda.
                </p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center p-4 bg-yellow-50 rounded-lg">
                        <div class="text-3xl font-bold text-yellow-600 mb-2">10+</div>
                        <div class="text-gray-600">Tahun Pengalaman</div>
                    </div>
                    <div class="text-center p-4 bg-yellow-50 rounded-lg">
                        <div class="text-3xl font-bold text-yellow-600 mb-2">5000+</div>
                        <div class="text-gray-600">Pelanggan Puas</div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-100 rounded-lg p-8">
                <img src="{{ asset('images/about-logo.jpg') }}" alt="Logo Reklame Arjuna" class="rounded-lg shadow-lg w-full h-64 object-cover">
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Nilai-Nilai Kami
            </h2>
            <p class="text-lg text-gray-600">
                Prinsip yang memandu setiap pekerjaan kami
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Kualitas Terjamin</h3>
                <p class="text-gray-600">Setiap produk melalui quality control ketat untuk memastikan hasil terbaik</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Tepat Waktu</h3>
                <p class="text-gray-600">Komitmen pada deadline untuk memastikan proyek Anda selesai sesuai jadwal</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Pelayanan Prima</h3>
                <p class="text-gray-600">Tim profesional siap membantu dan memberikan solusi terbaik untuk Anda</p>
            </div>
            
            <div class="text-center">
                <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Harga Kompetitif</h3>
                <p class="text-gray-600">Menawarkan harga terbaik tanpa mengorbankan kualitas produk</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Siap Memulai Proyek Anda?
        </h2>
        <p class="text-xl text-gray-300 mb-8">
            Hubungi kami hari ini untuk konsultasi gratis dan dapatkan penawaran terbaik
        </p>
        <div class="space-x-4">
            <a href="{{ route('products.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold py-3 px-8 rounded-lg">
                Lihat Produk
            </a>
            <a href="tel:+6281234567890" class="bg-white hover:bg-gray-100 text-gray-900 font-bold py-3 px-8 rounded-lg">
                Hubungi Kami
            </a>
        </div>
    </div>
</section>
@endsection

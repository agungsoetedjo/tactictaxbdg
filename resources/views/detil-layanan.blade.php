@extends('landing-partials.main')

@section('contents')
<main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url({{ asset('assets/img/img-header-tactictax.jpg') }});">
        <div class="container position-relative">
            <h1>{{ $kategori->nama }} </h1>
            <p>{!! $kategori->deskripsi !!} </p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="/#layanan">Beranda</a></li>
                    <li>Layanan</li>
                    <li class="current">{{ $kategori->nama }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="features section">
        <div class="container">
            <div class="row">
                <!-- Sidebar (Nav Links) -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <h4>{{ $kategori->nama }}</h4>
                    <p style="text-align: justify;">{!! $kategori->deskripsi !!}</p>
    
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs flex-column">
                        @foreach ($layanan as $row)
                        <li class="nav-item">
                            <a class="nav-link {{ $row->slug == $activeLayanan ? 'active' : '' }}" 
                               data-bs-toggle="tab" 
                               href="#features-{{ $row->slug }}"
                               data-image="{{ asset('storage/' . $row->gambar) }}">
                                {{ $row->nama }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                        <!-- Gambar (Tetap Satussss, tetapi diganti dengan JS) -->
                        <div class="mt-3">
                            <img id="preview-img" 
                                 src="{{ asset('storage/' . optional($layanan->first())->gambar) }}"
                                 {{-- onerror="this.src='{{ asset('assets/img/logo.png') }}'" --}}
                                 alt="Gambar Layanan" 
                                 class="img-thumbnail"
                                 data-image="{{ asset('storage/' . optional($layanan->first())->gambar) }}"
                                 style="width: 100%; height: auto; object-fit: cover;">
                        </div>                        
                </div>
    
                <!-- Deskripsi (Tab Content) -->
                <div class="col-lg-8">
                    <div class="tab-content mt-3" data-aos="fade-up" data-aos-delay="200">
                        @foreach ($layanan as $row2)
                        <div class="tab-pane fade {{ $row2->slug == $activeLayanan ? 'show active' : '' }}" 
                             id="features-{{ $row2->slug }}">
                            <h3>{{ $row2->nama }}</h3>
                            {!! App\Helpers\MyHelper::formatText($row2->deskripsi) !!}
                            <hr>
                            <p>Untuk pendaftaran serta pembayaran, silahkan hubungi via WhatsApp ({{ $kontak->pic }})</p>
                            <form action="{{ route('send.whatsappDaftar') }}" method="POST">               
                                @csrf
                                <div class="row gy-3">
                                    <div class="col-md-12">
                                        <input type="hidden" name="layananMsg" class="form-control" value="{{ $row2->nama }}">
                                        <input type="text" name="name" class="form-control" placeholder="Nama Pendaftar" required="">
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="bi bi-whatsapp btn btn-success btn-kirim" name="submit"> Daftar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>    
    <!-- /Service Details Section -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/allourcodes.js') }}"></script>
</main>

@endsection
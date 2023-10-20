@extends('layouts.main')

@section('container')  




<section id="about" class=" text-center">
    <div class="container">
        <div class="row mb-3">
            <div class="col ">
                <h1 class="pb-1">Halaman About</h1>
                <hr class="w-25 mx-auto">
                <p class="lead">Tentang Website Ini</p>
            </div>
        </div>
        <div class="row py-1">
            <div class="col text-center fs-5" style="text-align: justify;">
                <p>Website ini adalah project web portal it dimana berisi postingan-postingan artikel terkait dengan dunia it.</p>
                <p>berikut orang orang yang berkontribusi atas pembuatan website ini :</p>
            </div>
        </div>

            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-4">
                    <center><img id="img-about" src="image/{{ $image }}" alt="" width="387px" class="p-0 m-0 ms-3 me-0"></center>
                </div>
                <div class="col-lg-7 mt-5">
                    <h1 class="about-text1 ">Halo, saya {{ $name }}</h1>
                    <h1 class="about-text2 ">Selamat datang di website portal-it</h1>
                    <div class="py-3">
                        <a href="#" class="text-secondary text-decoration-none fs-5 me-4">
                            <i class="bi bi-facebook"></i> Asyifa Maulana
                        </a>
                        <a href="#" class="text-secondary text-decoration-none fs-5 me-4">
                            <i class="bi bi-instagram"></i> @asyfmaulana
                        </a>
                        <a href="#" class="text-secondary text-decoration-none fs-5 me-4">
                            <i class="bi bi-envelope-at"></i> {{ $email }}
                        </a>
                    </div>
                </div>
                
            </div>

        </div>
    </div>
</section>

@endsection

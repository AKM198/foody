@extends('layouts.foody')

@section('title', 'TASTY FOOD - Tentang Kami')

@section('content')
<!-- Header Section with Banner2 Background -->
<section class="about-header">
    <div class="container-fluid">
        <div class="row align-items-center h-100">
            <div class="col-lg-12">
                <div class="about-header-content">
                    <h1 class="about-header-title">TENTANG KAMI</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tasty Food Section -->
<section class="about-tasty-food-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-text-content">
                    <h2 class="about-section-title">TASTY FOOD</h2>
                    <p class="about-paragraph">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, 
                        augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem 
                        eget lacus. Nullam vitae dignissim neque, vel luctus ex. Fusce sit amet 
                        viverra ante.
                    </p>
                    <p class="about-paragraph">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, 
                        augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem 
                        eget lacus. Nullam vitae dignissim neque, vel luctus ex. Fusce sit amet 
                        viverra ante.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-images-grid">
                    <div class="about-image-item">
                        <img src="{{ asset('assets/images/homemade3.jpg') }}" alt="Tasty Food" class="about-img">
                    </div>
                    <div class="about-image-item">
                        <img src="{{ asset('assets/images/cooking3.jpg') }}" alt="Tasty Food" class="about-img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi Section -->
<section class="about-visi-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-images-grid">
                    <div class="about-image-item">
                        <img src="{{ asset('assets/images/homemade6.jpg') }}" alt="Visi" class="about-img">
                    </div>
                    <div class="about-image-item">
                        <img src="{{ asset('assets/images/street2.jpg') }}" alt="Visi" class="about-img">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-text-content">
                    <h2 class="about-section-title">VISI</h2>
                    <p class="about-paragraph">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque 
                        magna aliquet cursus tempus. Duis viverra metus et turpis elementum 
                        elementum. Aliquam rutrum placerat tellus et suscipit. Curabitur facilisis 
                        lectus vitae eros malesuada eleifend. Mauris eget tellus odio. Phasellus 
                        vestibulum turpis ac sem commodo, at posuere eros consequat. Duis nec 
                        ex at ante volutpat posuere. Morbi vel nunc tortor. Nulla facilisi. Nulla 
                        accumsan ullamcorper purus nec venenatis. Lorem ipsum dolor sit amet, 
                        consectetur adipiscing elit. Integer imperdiet erat vel leo rutrum lobortis.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Misi Section -->
<section class="about-misi-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-text-content">
                    <h2 class="about-section-title">MISI</h2>
                    <p class="about-paragraph">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque 
                        magna aliquet cursus tempus. Duis viverra metus et turpis elementum 
                        elementum. Aliquam rutrum placerat tellus et suscipit. Curabitur facilisis 
                        lectus vitae eros malesuada eleifend. Mauris eget tellus odio. Phasellus 
                        vestibulum turpis ac sem commodo, at posuere eros consequat. Duis nec 
                        ex at ante volutpat posuere. Morbi vel nunc tortor. Nulla facilisi. Nulla 
                        accumsan ullamcorper purus nec venenatis. Lorem ipsum dolor sit amet, 
                        consectetur adipiscing elit. Integer imperdiet erat vel leo rutrum lobortis.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-images-grid single">
                    <div class="about-image-item large">
                        <img src="{{ asset('assets/images/cooking2.jpg') }}" alt="Misi" class="about-img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
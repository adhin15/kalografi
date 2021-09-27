<div class="container-fluid py-5" style="background-color: #8F9C69">
    <div class="container">
        <div class="row text-white py-5">
            <div class="col-md-2">
                <div class="row">
                    <p class="text-bold fs-6">Products</p>
                </div>
                <div class="row">
                    <a href="{{ route('pricelist.wedding.index') }}" class="fs-7 footer-link fw-light mb-1">
                        Wedding
                    </a>
                    <a href="{{ route('pricelist.pre-wedding.index') }}" class="fs-7 footer-link fw-light mb-1">
                        Pre-Wedding
                    </a>
                    <a href="#" class="fs-7 footer-link fw-light mb-1">
                        Engagement
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row">
                    <p class="text-bold fs-6">Links</p>
                </div>
                <div class="row">
                    <a href="#" class="fs-7 footer-link fw-light mb-1">
                        About Us
                    </a>
                    <a href="{{ route('portfolio') }}" class="fs-7 footer-link fw-light mb-1">
                        Portfolio
                    </a>
                    <a href="{{ route('pricelist.index') }}" class="fs-7 footer-link fw-light mb-1">
                        Pricelist
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row">
                    <p class="text-bold fs-6">Social Media</p>
                </div>
                <div class="row">
                    <div class="col">
                        <span class="fa-stack" style="vertical-align: top;">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-instagram fa-stack-1x" style="color: #8F9C69"></i>
                        </span>
                        <span class="fa-stack" style="vertical-align: top;">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-twitter fa-stack-1x" style="color: #8F9C69"></i>
                        </span>
                        <span class="fa-stack" style="vertical-align: top;">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-youtube fa-stack-1x" style="color: #8F9C69"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ms-auto text-end">
                <div class="row justify-content-end">
                    <img src="{{ asset('placeholders/kalografi.png') }}" class="w-50 mb-1" alt="kalografi-footer">
                </div>
                <div class="row">
                    <p class="small">Copyright 2021 {{ ucfirst(config('app.name')) }}. All Rights Reserved.</p>
                </div>
                <div class="row">
                    <div class="col-md-2 offset-md-10">
                        <div class="border-3" style="border-top: solid white;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
    <div class="container-sm">
        <a class="navbar-brand" href="{{ route('landing') }}">
            <img src="{{ asset('placeholders/kalografi (1).png') }}" alt="kalografi-header">
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav mx-auto" style="--bs-scroll-height: 100px;">
                <li class="nav-item fs-9 mx-3 mx-3">
                    <a class="nav-link {{ Route::is('landing') ? 'fw-bold' : '' }}"
                        href="{{ route('landing') }}">Home</a>
                </li>
                <li class="nav-item fs-9 mx-3">
                    <a class="nav-link" href="{{ route('trackorder') }}">Track Your Order</a>
                </li>
                <li class="nav-item dropdown fs-9 mx-3">
                    <a class="nav-link dropdown-toggle {{ Route::is('portfolio') ? 'fw-bold' : '' }}" href="#"
                        id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Portfolio
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item fs-9" href="{{ route('portfolio') }}">All</a></li>
                        <li><a class="dropdown-item fs-9" href="#">Pre-Wedding</a></li>
                        <li><a class="dropdown-item fs-9" href="#">Wedding</a></li>
                        <li><a class="dropdown-item fs-9" href="#">Engagement</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown fs-9 mx-3">
                    <a class="nav-link dropdown-toggle {{ Route::is('pricelist.*') ? 'fw-bold' : '' }}" href="#"
                        id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Products
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li>
                            <a class="dropdown-item fs-9" href="{{ route('pricelist.index') }}">
                                All
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item fs-9" href="{{ route('pricelist.wedding.index') }}">
                                Wedding Documentation
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item fs-9" href="{{ route('pricelist.pre-wedding.index') }}">
                                Pre-Wedding Session
                            </a>
                        </li>
                        <li><a class="dropdown-item fs-9" href="{{ route('pricelist.engagement.index') }}">
                                Engagement Documentation
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="float-right">
                <a href="https://wa.link/8099pb" target="_blank">
                    <button class="btn btn-sm px-4 btn-kalografi" type="submit"
                        style="background-color: #8F9C69">Contact
                        Us</button>
                </a>
            </div>
        </div>
    </div>
</nav>

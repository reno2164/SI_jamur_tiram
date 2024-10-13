<nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #49443a">
    <div class="container">
        <a class="navbar-brand fs-6" href="#">Jamur Tiram <br>Putra Pandawa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end gap-4" id="navbarSupportedContent">
            <ul class="navbar-nav gap-4">
                <li class="nav-item my-auto">
                    <a class="nav-link {{ Request::path() == '/' ? 'active' : '' }}" aria-current="page"
                        href="/">Home</a>
                </li>
                <li class="nav-item my-auto">
                    <a class="nav-link {{ Request::path() == 'shop' ? 'active' : '' }}" href="/shop">Shop</a>
                </li>
                <li class="nav-item my-auto">
                    <a class="nav-link {{ Request::path() == 'contact' ? 'active' : '' }}" href="/contact">Contact
                        </a>
                </li>
                <li class="nav-item my-auto">
                    <div class="notif">
                        <a href="#" class="fs-5 nav-link {{ Request::path() == 'checkOut' ? 'active' : '' }}">
                            <i class="fa-regular fa-bell"></i>
                        </a>
                    </div>
                </li>
                <li class="nav-item my-auto">
                    <div class="notif">
                        <a href="/transaksi" class="fs-5 nav-link {{ Request::path() == 'transaksi' ? 'active' : '' }}">
                            <i class="fa-solid fa-cart-plus"></i>
                        </a>
                        <div class="circle">10</div>
                    </div>
                </li>
                @auth
                    <div class="select" tabindex="0" role="button">
                        <div class="text-links">
                            <div class="d-flex gap-2 align-items-center">
                                <img src="{{ asset('storage/user/' . Auth::user()->foto) }}" class="rounded-circle"
                                    style="width: 50px;" alt="">
                                <div class="d-flex flex-column text-white">
                                    <p class="m-0" style="font-weight: 700; font-size:14px;">{{ Auth::user()->name }}
                                    </p>
                                    <p class="m-0" style="font-size:12px">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="links-login text-white" id="links-login">
                            <a href="logout_pelanggan" style="text-decoration: none" role="button"
                                tabindex="0">Keluar</a>
                        </div>
                    </div>
                @else
                    <li class="nav-item my-auto">
                        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Login</button>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<script>
    $(".text-links").click(function(e) {
        e.preventDefault();
        var $linksLogin = $("#links-login");
        if ($linksLogin.hasClass("activeLogin")) {
            $linksLogin.removeClass("activeLogin");
        } else {
            $linksLogin.addClass("activeLogin");
        }
    });
</script>

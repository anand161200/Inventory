<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">
                    @auth
                    <div>
                        <h6> <i class="fa fa-user" aria-hidden="true"> &nbsp; </i>{{ Auth::user()->firstName }}</h6>
                    </div>
                    @endauth
                </div>
                <a class="nav-link" href="{{ route('index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link" href="{{ route('brand_index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-mobile"></i></div>
                    Brand
                </a>
                <a class="nav-link" href="{{ route('itam_index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-mobile"></i></div>
                    items
                </a>
            </div>
        </div>
    </nav>
</div>



<nav class="site-navigation position-relative text-right" role="navigation">
    <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
    <li class="has-children">
        <a href="about.html"><span>Fitur</span></a>
        <ul class="dropdown arrow-top">
        <li><a href="#">Menu One</a></li>
        <li><a href="#">Menu Two</a></li>
        <li><a href="#">Menu Three</a></li>
        <li class="has-children">
            <a href="#">Dropdown</a>
            <ul class="dropdown">
            <li><a href="#">Menu One</a></li>
            <li><a href="#">Menu Two</a></li>
            <li><a href="#">Menu Three</a></li>
            <li><a href="#">Menu Four</a></li>
            </ul>
        </li>
        </ul>
    </li>
    <li><a href="{{ url('events/add') }}"><span>Buat Acara</span></a></li>
    <li><a href="listings.html"><span>Cara Kerja</span></a></li>
    <li><a href="listings.html"><span>Pricing</span></a></li>
    <li><a href="listings.html"><span>Tentang Kami</span></a></li>
    @if(!Auth::check())
        <li><a href="{{ url('login') }}"><span>Login</span></a></li>
        <li class="active"><a href="contact.html"><span>Daftar</span></a></li>
    @else
        <li class="has-children active">
        <a href="about.html"><span>{{ Auth::user()->name }}</span></a>
            <ul class="dropdown arrow-top">
                <li><a href="#">Profil</a></li>
                <li><a href="{{ Auth::logout() }}">Log out</a></li>
            </ul>
        </li>
    @endif
    </ul>
</nav>

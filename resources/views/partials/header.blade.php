<nav id="sidebar">
    <div class="sidebar-header">
        <img src="https://res.cloudinary.com/net-ninja/image/upload/v1616052315/Net%20Ninja%20Pro/no-circle-white-logo_gwmg67.png" alt="Logo NevoCode">
    </div>

    <ul class="list-unstyled components">
        @auth
            <li>
                <p class="text-white mb-0"><i class="fas fa-user"></i> {{ auth()->user()->name }}</p>
            </li>
            <li>
                <a href="{{ route('logout') }}" class="download" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Deconectare
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @endauth
        @guest
            <ul class="list-unstyled CTAs">
                <li>
                    <a href="{{ route('login') }}" class="download">
                        <i class="fas fa-sign-in-alt"></i> Autentificare
                    </a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="article">
                        <i class="fas fa-user-plus"></i> Înregistrare
                    </a>
                </li>
            </ul>
        @endguest
    </ul>

    <ul class="list-unstyled components">
        <li class="active">
        <li>
            <a href="/"><i class="fas fa-home"></i> Acasă</a>
        </li>
        </li>
        <li>
            <a href="/create"><i class="fas fa-plus"></i> Adaugă cheltuielile lunare</a>
        </li>
        <li>
            <a href="/add"><i class="fas fa-plus"></i> Adaugă o categorie</a>
        </li>
        <li>
            <a href="/budget"><i class="fas fa-money-bill""></i> Vezi cheltuielile lunare</a>
        </li>
        <li>
            <a href="#"><i class="fas fa-solid fa-flag"></i> Rapoarte</a>
        </li>
    </ul>
</nav>

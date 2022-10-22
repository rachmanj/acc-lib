<li class="nav-item">
    <a href="{{ route('gs.index') }}" class="nav-link {{ request()->is('gs') || request()->is('gs/*') ? 'active' : '' }}">
      <i class="far fa-file-alt"></i>
      <p>
        GS Documents
      </p>
    </a>
  </li>
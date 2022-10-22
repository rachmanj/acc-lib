<li class="nav-item">
    <a href="{{ route('general.index') }}" class="nav-link {{ request()->is('general') || request()->is('general/*') ? 'active' : '' }}">
      <i class="far fa-file-alt"></i>
      <p>
        General Documents
      </p>
    </a>
  </li>
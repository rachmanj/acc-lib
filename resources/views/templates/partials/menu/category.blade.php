<li class="nav-item">
    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->is('categories') || request()->is('categories/*') ? 'active' : '' }}">
      <i class="far fa-file-alt"></i>
      <p>
        Categories
      </p>
    </a>
  </li>
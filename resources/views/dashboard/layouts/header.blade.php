<header class="navbar navbar-dark sticky-top  flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/dashboard"><img src="/image/portal.png" alt="Logo" width="22" height="26" class="d-inline-block align-text-top"> Portal-it</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav">
      <div class="nav-item text-nowrap">
        <form action="logout" method="post">
          @csrf
          <button type="submit" class="btn btn-logout nav-link px-3 border-0">Logout <span data-feather="log-out"></span></a></button>
        </form>
      </div>
    </div>
</header>
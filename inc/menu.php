<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="">
      <img src="inc/Logo.png" alt="MemeHub" style="max-height:40px">
      <span class="logoFont">memehub</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Find Friends</a>
	</li>
<!--
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
	</li>
-->
      </ul>
      <ul class="navbar-nav mb-2 mb-lg-0">
      
	<li class="nav-item dropdown">
	  <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" araia-expanded="false" style="padding-right: 100px">
	    <?php echo $_COOKIE['user']; ?>
	  </a>
	  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
	    <li><a class="dropdown-item" href="profile.php">Your Profile</a></li>
	    <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
	  </ul>

	</li>

      </ul>

<!--
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
-->

    </div>
  </div>
</nav>

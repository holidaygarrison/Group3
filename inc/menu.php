<?php session_start(); $reqs = Friends::GetRequestsFor($_SESSION['user']); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">
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
	  <a class="nav-link" href="#FriendsModal" data-bs-toggle="modal">Friend Requests
	  <?php
		if( $reqs ){
			echo "<span class='badge rounded-bill bg-danger'>".count($reqs)."</span>";
		}
	  ?>
	  </a>
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

      <form class="d-flex align-items-center" method='get' action='search.php'>
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name='search'>
        <button class="btn btn-outline-success py-2 px-3" type="submit">Search</button>
      </form>

      <ul class="navbar-nav mb-2 mb-lg-0">
	<li class="nav-item dropdown">
	  <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" araia-expanded="false">
	    <?php echo $_SESSION['user']; ?>
	  </a>
	  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
	    <li><a class="dropdown-item" href="profile.php">Your Profile</a></li>
	    <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
	  </ul>
	</li>

      </ul>

    </div>
  </div>
</nav>

<div class="modal" tabindex="-1" id="FriendsModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	<h5 class="modal-title">Friend Requests</h5>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
      </div>
      <div class="modal-body">
	<ul class="list-group">
<?php
	if( $reqs ){
		foreach( $reqs as $req ){
			echo "<li class='list-group-item d-flex'>\n".
			     "  <a href='profile.php?d=".$req['Sender']."' class='flex-grow-1'>".$req['Sender']."</a>\n".
			     "  <form action='AcceptRequestPro.php' method='post'>\n".
			     "    <input type='hidden' name='User1' value='".$_SESSION['user']."'>\n".
			     "    <input type='hidden' name='User2' value='".$req['Sender']."'>\n".
			     "    <button class='btn btn-dark btn-sm'>Accept</button>\n".
			     "  </form>\n".
			     "  <form action='DeclineRequestPro.php' method='post'>\n".
			     "    <input type='hidden' name='User1' value='".$_SESSION['user']."'>\n".
			     "    <input type='hidden' name='User2' value='".$req['Sender']."'>\n".
			     "    <button class='btn btn-dark btn-sm ms-2'>Decline</button>\n".
			     "  </form>\n".
			     "</li>";
		}
	} else{
		echo "You have no friends requests right now.";
	}
?>
	</ul>
      </div>
    </div>
  </div>
</div>





























<?php
include("inc/create_db.php");
include("lib/posts_class.php");
include("lib/accounts_class.php");

include("inc/header.php");
include("inc/menu.php");

if( isset($_COOKIE['user']) )
{
	$user = $_COOKIE['user'];
} else{
	$user = "";
}

if( isset($_GET['d']) )
{
	$pro = $_GET['d'];
} else{
	$pro = $user;
}

$profile = Accounts::GetAccountInfo($pro);
$posts = Posts::GetPostsFor($pro);
array_multisort( array_column($posts, "ID"), SORT_DESC, $posts );

if( !$profile ){
	echo "<script>\n".
	     " alert('Error: This person does not exist.');\n".
	     " window.location = './'; \n".
	     "</script>\n";
	exit;
}

?>

<doctype html>
<html>
  <head>
    <title>Profile Page</title>
</head>
<body>

<!-- Profile Picture / Username / Add Friend / About Me Container-->
<div class="container">
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="img/profile_placeholder.jpg" class="rounded-circle" width="300">
                    <div class="mt-3">
		      <h4><?php echo $profile['Username']; ?></h4>
		      <?php
			if( $pro != $user ){
				
				echo "<button class=\"btn btn-primary btn btn-dark\">Add Friend</button>\n";
			}
		      ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
<!--
		    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6>Name</h6>
                        <span class = "text-secondary">My Name</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6>Birthday</h6>
                        <span class = "text-secondary">00/00/00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6>About Me</h6>
                        <span class = "text-secondary">sjdj djdjd hlagh fhd fdh fjdsj</span>
		    </li>
-->
                     <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6>Total Meme Count</h6>
			<span class = "text-secondary"><?php echo count($posts); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
			<a class="list-group-link" href="#friendCollapse" data-bs-toggle="collapse" aria-expanded="false" role="button" aria-controls="friendCollapse"> Friend List</a>
			<div class="w-100 collapse" id="friendCollapse">
			    <ul>
				<?php
				    if( !$profile['Friends'] )
					    echo "<li>No Friend :(</li>";
				    else{
					$friends = explode(",", $profile['Friends']);
				        foreach( $friends as $friend )
					{
					    echo "<li><a href='profile.php?d=$friend'>$friend</a></li>\n";
				        }
				    }
				?>
			    </ul>
			</div>
                    </li>
                </ul>
              </div>
            </div>
            <!-- Post Container -->
	    <div class="col-md-8">
<!--
              <div class="postContainer">
                <div class="post create">
                  <div class="top">
                    <div class="image">
                      <img src="img/profile_placeholder.jpg" alt="">
                    </div>
                    <input type="text" placeholder="What meme are we feeling today?"/>
		 </div>
                 <div class="bottom">
                    <div class="action">
                        <span>Image</span>
                    </div>
                    <div class="action">
                        <span>Gif</span>
                    </div>
                 </div>
	      </div>
-->

		<div class="modal" tabindex="-1" id="ShareModal">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
			<h5 class="modal-title">Share Post</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label-"close"></button>
		      </div>
		      <div class="modal-body">
			<form name="Frm" action="SharePostPro.php" method="post">
			  <textarea name="Message" class="form-control mb-3" placeholder="Got anything to add?"></textarea>
			  <div class="w-100 white-bg"></div>
			  <div class="w-100" id="ShareModalContent"></div>
			  <Br>
			  <input type="hidden" name="user" value="<?php echo $user;?>">
			  <input type="hidden" name="post" id="SharePostID" value="">
			  <button class="btn btn-md" role="submit">Post</button>
			</form>
		      </div>
		    </div>
		  </div>
		</div>

		<div class="modal" tabindex="-1" id="EditModal">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
			<h5 class="modal-title">Edit Post</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label-"close"></button>
		      </div>
		      <div class="modal-body">
			<form name="Frm" action="EditPostPro.php" method="post" id="EditModalContent">
			  <textarea name="Message" class="form-control mb-3"></textarea>
			  <div id="EditImg"></div>
			  <input type="hidden" name="user" value="<?php echo $user;?>">
			  <input type="hidden" name="post" id="EditPostID" value="">
			  <input type="hidden" name="delete" value="FALSE">
			  <button class="btn btn-md" role="submit">Update</button>
			  <button class="btn btn-md float-end" id="DeletePostBtn" onclick="CheckPostDelete();">Delete</button>
			</form>
		      </div>
		    </div>
		  </div>
		</div>


	    <!-- Posts -->
	<?php
	foreach($posts as $post){
              echo "<div class='post'>\n".
                   "  <div class='top'>\n".
                   "    <div class='image'>\n".
                   "      <img src='img/profile_placeholder.jpg' alt='name'>\n".
                   "    </div>\n".
                   "    <div class='info'>\n".
                   "      <p class='name'>".$post['User']."</p>\n".
                   "      <span class='time'>".
                   ($post['Date'] == date("Y-m-d") ? "Today" : date("m/d/Y", strtotime($post['Date']))).
                   "      </span>\n".
                   "    </div>\n".
                   ( $post['User'] == $user ?
                   "    <i class='fa fa-ellipsis-h' onclick=\"EditPost('".$post['ID']."');\"></i>\n" : "" ).
                   "  </div>\n".
                   "  <div class='content'>\n".
                   ($post['Msg'] ? "<p class='txt'>".$post['Msg']."</p>" : "").
                   ($post['Img'] ? "<img src='img/".$post['Img']."' alt='img'>" : "").
                   "  </div>\n";
	    if( $post['Share'] ){
                     $shareinfo = Posts::GetPostInfo($post['Share']);
                     echo "  <div class='mx-3 p-3 border border-white border-3'>\n".
                          "    <div class='top'>\n".
                          "      <div class='image'>\n".
                          "        <img src='img/profile_placeholder.jpg' alt='name'>\n".
                          "      </div>\n".
                          "      <div class='info'>\n".
                          ( $shareinfo ?
                          "        <p class='name'>".$shareinfo['User']."</p>\n".
                          "        <span class='time'>".
                          ($shareinfo['Date'] == date("Y-m-d") ? "Today" : date("m/d/Y", strtotime($shareinfo['Date']))).
                          "        </span>\n" : "" ).
                          "      </div>\n".
                          "    </div>\n".
														                            "    <div class='content'>\n".
	                  ($shareinfo ?
	                  ($shareinfo['Msg'] ? "<p class='txt'>".$shareinfo['Msg']."</p>" : "").
	                  ($shareinfo['Img'] ? "<img src='img/".$shareinfo['Img']."' alt='img'>" : "") :
	                  "<p class='txt'>This post is no longer available</p>" ).
	                  "    </div>\n".
	                  "  </div>\n";
	    }
	      echo "  <div class='bottom'>\n".
		   "    <div class='action' onclick=\"Like('".$post['ID']."');\">\n".
		   "      <i class='fa fa-thumbs-up'></i>\n";
	      $likes = explode(",", $post['Likes']);
	      echo "      <span id='Likes".$post['ID']."'>".($post['Likes'] ? count($likes) : "Like")."</span>\n".
		   "    </div>\n".
		   "    <div class='action' onclick=\"Dislike('".$post['ID']."');\">\n".
		   "      <i class='fa fa-thumbs-down'></i>\n";
	      $dislikes = explode(",", $post['Dislikes']);
	      echo "      <span id='Dislikes".$post['ID']."'>".($post['Dislikes'] ? count($dislikes) : "Dislike")."</span>\n".
		   "    </div>\n".
		   "    <div class='action' data-bs-toggle='collapse' data-bs-target='#comments".$post['ID']."' aria-expanded='false' aria-controles='comments".$post['ID']."'>\n".
		   "      <i class='fa fa-comment'></i>\n";
	      $comments = Posts::GetCommentsForPost($post['ID']);
	      echo "      <span>".($comments ? count($comments) : "Comment")."</span>\n".
		   "    </div>\n".
		   "    <div class='action' onclick=\"Share('".$post['ID']."');\">\n".
		   "      <i class='fa fa-share'></i>\n".
		   "      <span>Share</span>\n".
		   "    </div>\n".
		   "  </div>\n".
		   "  <div class='w-100 collapse mt-3' id='comments".$post['ID']."'>\n".
		   "    <div class='card white-bg'>\n".
		   "      <div class='card-body'>\n".
		   "	    <form name='Frm' action='PostComment.php' method='post'>\n".
		   "	      <textarea name='Message' class='form-control' placeholder='Comment'></textarea>\n".
		   "	      <input type='hidden' name='user' value='".$user."'>\n".
		   "	      <input type='hidden' name='post' value='".$post['ID']."'>\n".
		   "	      <button class='btn btn-md' role='submit'>Post</button>\n".
		   "	    </form>\n".
		   "	  </div>\n".
		   "    </div>\n";
	      foreach($comments as $comment){
		 echo "<div class='card white-bg mt-1' id='Comment".$comment['ID']."'>\n".
		      "  <div class='card-body'>\n".
		      ( $comment['User'] == $user ? 
			"<div class='dropdown float-end'>\n".
			"  <i class='fa fa-ellipsis-h dropdown-toggle' id='commdrop".$comment['ID']."' data-bs-toggle='dropdown' aria-expanded='false'></i>\n".
			"  <ul class='dropdown-menu' aria-labelledby='commdrop".$comment['ID']."'>\n".
			"    <li class='dropdown-item' onclick=\"DeleteComment('".$comment['ID']."');\">Delete</li>\n".
			"  </ul>\n".
			"</div>\n" : "" ).
		      "    <h4 class='card-title'>\n".
		      $comment['User'].
		      "    </h4>\n".
		      "    <span class='card-subtitle mb-2 text-muted'>\n".
		      ($comment['Date'] == date("Y-m-d") ? "Today" : date("m/d/Y", strtotime($comment['Date']))).
		      "    </span>\n".
		      "    <p class='card-text'>".$comment['Msg']."</p>\n".
		      "  </div>\n".
		      "</div>\n";
	      }

	      echo "  </div>\n".
		   "</div>\n";
	   }


	?>


        </div>
    </div>

<?php
include("inc/footer.php");
?>
	<script>
	function GetXttp()
	{
		var Xttp = null;
		if (window.XMLHttpRequest)
		{
			Xttp=new XMLHttpRequest();
		}else
		{
			Xttp=new ActivateXObject("Microsoft.XMLHTTP");
		}
		return Xttp;
	}

	document.getElementById("DeletePostBtn").addEventListener("click", function(event){ if( CheckDelete() ){ event.preventDefault();} });
	function CheckDelete()
	{
		if( confirm("Are you sure you want to delete this post?") ){
			document.getElementById('EditModalContent').delete.value = 'TRUE';
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function EditPost( postID ){
		var modal = new bootstrap.Modal(document.getElementById("EditModal"));
		modal.show();

		document.getElementById("EditPostID").value = postID;

		const reqListener = response => {
		   var content = response.currentTarget.response;
		   content = content.split("-;;-");

		   document.getElementById("EditModalContent").Message.innerHTML = content[0];
		   if( content[1] )
		      document.getElementById("EditImg").innerHTML = "<img src='img/"+content[1]+"' alt='img'>";
		   else
		      document.getElementById("EditImg").innerHTML = "";
		};

		const xttp = GetXttp();
		xttp.onload = reqListener;
		xttp.open("GET", "SetEdit.php?post="+postID, true);
		xttp.send();
	}


	function Like( postID ){

		const reqListener = response => {
			const content = document.getElementById("Likes"+postID);
			content.innerHTML = response.currentTarget.response.split(",").length;
		};

		const xttp = GetXttp();
		xttp.onload = reqListener;
		xttp.open("GET", "Like.php?post="+postID+"&user=<?php echo $user; ?>", true);
		xttp.send();
	}

	function Dislike( postID ){

		const reqListener = response => {
			const content = document.getElementById("Dislikes"+postID);
			content.innerHTML = response.currentTarget.response.split(",").length;
		};

		const xttp = GetXttp();
		xttp.onload = reqListener;
		xttp.open("GET", "Dislike.php?post="+postID+"&user=<?php echo $user; ?>", true);
		xttp.send();

	}

	function Share( postID ){
		var modal = new bootstrap.Modal(document.getElementById("ShareModal"));
		modal.show();

		document.getElementById("SharePostID").value = postID;

		const reqListener = response => {
			const content = document.getElementById("ShareModalContent");
			content.innerHTML = response.currentTarget.response;
		};

		const xttp = GetXttp();
		xttp.onload = reqListener;
		xttp.open("GET", "SetShare.php?post="+postID, true);
	xttp.send();

}

function DeleteComment( commID ){
	if( confirm("Are you sure you want to delete this comment?") ){
		const reqListener = response => {
			const content = document.getElementById("Comment"+commID);
			content.innerHTML = "<span class='m-3'>Comment Deleted!</span>";
		};

		const xttp = GetXttp();
		xttp.onload = reqListener;
		xttp.open("GET", "DeleteComment.php?comment="+commID, true);
		xttp.send();
	}
}

</script>

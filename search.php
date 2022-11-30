<?php
/* Includes the files needed for the database, posts, accounts, and friends. */
include("inc/create_db.php");
include("lib/posts_class.php");
include("lib/accounts_class.php");
include("lib/friends_class.php");
include("lib/search_class.php");
/* Includes the files needed for the header and basic structure. */
include("inc/header.php");
include("inc/menu.php");

/* Gets the user information from the user. */
if( isset( $_SESSION['user'] ) ){
	$user = $_SESSION['user'];
		$userinfo = Accounts::GetAccountInfo($user);
} else{
	header("Location:login.php");
	exit;
}

/* getting searched for posts */
if( isset($_GET['search']) ){
	$search = $_GET['search'];
	$accounts = Search::SearchUsers($search);
	$posts = Search::SearchPosts($search);
} else{
	$search = NULL;
	$accounts = NULL;
	$posts = NULL;
}

?>

<style>
.post{
    margin-left:auto;
    margin-right:auto;
}
</style>


<!-- main contianer -->
<div class="back">
    <div class="container-fluid clearfix m-auto" style="max-width:1400px">
	<div class="row">
	    <div class="col-sm-12">
		<h2 class="fst-italic mt-3">Users like "<?php echo $search; ?>"</h2>
	    </div>
<?php
/* if users to display, display them */
if( $accounts ){
    foreach( $accounts as $account ){
	echo	"  <div class='col-4 p-4'>".
		"    <a href='profile.php?d=".$account['Username']."'>".
		"    <div class='row bg-light rounded-3 align-items-center'>".
		"      <div class='col-4 p-3'>".
		"	 <img class='w-100 rounded-circle border border-secondary' src='img/profile_placeholder.jpg' alt='profile'>".
		"      </div>".
		"      <div class='col-8 p-3'>".
		"	 <h4>".$account['FName']." ".$account['LName']."</h4>".
		"	 <h5>".$account['Username']."</h5>".
		"      </div>".
		"    </div>".
		"    </a>".
		"  </div>";
    }

} else{
    echo "<p>There are no users like this.</p>";
}
?>

	</div>

	<!--divider-->
	<div class="row bg-dark" style="height:5px"></div>

	<div class="row">
	  <div class="col-sm-12">
		<h2 class="fst-italic mt-3">Posts like "<?php echo $search; ?>"</h2>
	  </div>
	  <div class="col-sm-12">
<?php
/* if there's posts to show, show them */
if( $posts ){
   array_multisort(array_column($posts, 'Date'), SORT_DESC, array_column($posts, 'ID'), SORT_DESC, $posts);
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
} else{
    echo "<p>There are no posts like this.</p>";
}
?>
	  </div>
	</div>
    </div>
</div>

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
	  <div class="w-100 white-bg" style="height:3px"></div>
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

/* Deleting the Post but displaying a popup to make sure want to delete them. */
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

/* Pulling in all of the database queries for editing a post. */ 
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

/* Pulling in all of the database stuff to like a post. */
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

/* Pulling in all of the database stuff to dis-like a post. */
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

/* Pulling in all of the database stuff to share a post. */
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

/* Pulling in all of the database stuff to delete a comment. */
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

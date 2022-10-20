<?php
include("inc/create_db.php");
include("lib/posts_class.php");

include("inc/header.php");
include("inc/menu.php");

$user = @$_GET['user'];
if(!$user)
	$user = "default";
?>

<style>
    /* Entire Page */
     *{ 
        margin:0;
        padding:0px;
        box-sizing: border-box;
        font-family: "american typewriter";
     }
     /* Background of entire page */
     .back{ 
        background:rgb(243,235,230);
        display:flex;
     }
     /* Container for the posts */
     .container{
        flex:1;
        display:flex;
        flex-direction: column;
        align-items:center;
     }
    /* All of the Posts */
     .post{
        width:600px;
        background-color: rgb(249,179,127)!important;
        border-radius:10px;
        padding:10px;
        margin:10px;
     }
        /* Top of the Post */
            /* Centers the Image and Textbox */
             .post .top{
                display:flex;
                align-items:center;
                padding:10px;
             }
            /* Cuts the Profile Image */
             .post .top .image{
                width:40px;
                height:40px;
                border-radius:50%;
                overflow:hidden;
             }
             .post .top .image > img{
                width:100%;
                cursor:pointer;
             }
            /* Sizes the textbox */
             .post .top > input{
                height:40px;
                padding:10px 15px;
                border-radius:25px;
                outline:none;
                border:none;
                flex:1;
                background:#eee;
                margin-left:30px;
             }
        /* Bottom of the Post */  
            /* Entire Bottom */
             .post .bottom{
                box-shadow:1px solid #ddd;
                display:flex;
                justify-content:space-between;
                padding:0px 60px 0px 60px;
                font-size:20px;
             }
            /* Boxes Around Each Button */
             .post .bottom .action{
                padding:10px;
                border-radius:40px;
                transition:.3s ease-in;
                cursor:pointer;
             }
             .post .bottom .action:hover{
                background:#eee;
             }
            /* Color of the Button Words */
             .post .bottom > .action{
                color:rgb(60,60,60);
             }
        /* Actual Posts */
         .post .top .info{
            margin-left:10px;    
            font-weight: bold;
         }
         .post .top .info .name{
            cursor:pointer;
            font-size:17px;
         }
         .post .top .info .time{
            font-size:11px;
            cursor:pointer;
         }
         .post .top i{
            margin-left:auto;
            cursor: pointer;
         }
         .post .content{
            font-size:16px;
            font-weight:normal;
            padding:10px;
         } 
         .post .content > img{
            width:100%;
            margin:5px 0px;
         }
         .txt {
            color:rgb(60,60,60);
         }
         .name {
	    font: bold;
            color:rgb(50,50,50);
         }
         .time {
            color:rgb(50,50,50);
         }
</style>
<div class="back"> 
    <!-- Posts on Home Page -->
     <div class="container"> 
        <!-- Create Post Popup -->
         <div class="post create"> 
            <!-- Top of Post Box -->
             <div class="top"> 
                <!-- Profile Image on Create Post Popup -->
                 <div class="image"> 
                    <img src="img/profile_placeholder.jpg" alt="profile img" width="40" height="40">
                 </div>
                <!-- Create Post Modal Trigger -->
		<button type="button" class="ms-3 rounded-pill btn btn-lg btn-light" data-bs-toggle="modal" data-bs-target="#PostModal">
		  <h5 class="my-2">Create Post</h5>
		</button>

		<!-- Create Post Modal -->	
		<div class="modal" tabindex="-1" id="PostModal">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header" style="background-color:rgb(255,243,207)">
			<h5 class="modal-title">Create Post</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
		      </div>
		      <div class="modal-body">
			<form name="Frm" action="CreatePostPro.php" method="post" enctype="multipart/form-data">
			  <textarea name="Message" class="form-control mb-3" placeholder="What's on your mind?"></textarea>
			  <input type="hidden" name="MAX_FILE_SIZE" value="3000000000000">
			  <input type="file" name="File" id="File" accept="image/png, image/jpeg">
			  <input type="hidden" name="user" value="<?php echo $user; ?>">
			  <Br>
			  <button class="btn btn-md" role="submit" style="background-color:rgb(240,230,205)">Post</button>
			</form>
		      </div>
		    </div>
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
	      <div class="modal-header" style="background-color:rgb(255,243,207)">
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
		  <button class="btn btn-md" role="submit" style="background-color:rgb(240,230,205)">Update</button>
		  <button class="btn btn-md float-end" id="DeletePostBtn" onclick="CheckPostDelete();" style="background-color:rgb(240,230,205)">Delete</button>
		</form>
	      </div>
	    </div>
	  </div>
	</div>


	 <!-- Posts -->
<?php
   $posts = Posts::GetAllPosts();
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
	      "        <p class='name'>".$shareinfo['User']."</p>\n".
	      "        <span class='time'>".
	      ($shareinfo['Date'] == date("Y-m-d") ? "Today" : date("m/d/Y", strtotime($shareinfo['Date']))).
	      "        </span>\n".
	      "      </div>\n".
	      "    </div>\n".
	      "    <div class='content'>\n".
	      ($shareinfo['Msg'] ? "<p class='txt'>".$shareinfo['Msg']."</p>" : "").
	      ($shareinfo['Img'] ? "<img src='img/".$shareinfo['Img']."' alt='img'>" : "").
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

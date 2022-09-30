<?php
include("inc/header.php");
include("inc/menu.php");
?>

<doctype html>
<html>
  <head>
    <title>Profile Page</title>
<style>

/* Entire Page */
*{
    margin:0;
    padding:0px;
    box-sizing: border-box;
    font-family: "american typewriter";
}

/* Background */
body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}

.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

/* About me Card */
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #F7DD4D;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

/* Container for Post */
.postContainer{
    flex:1;
    display:flex;
    flex-direction: column;
    align-items: center;
}

/* Post */
.post{
        width:600px;
        background:rgb(224, 181, 181);
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
                color:rgb(0,0,0);
             }
        /* Actual Posts */
         .post .top .info{
            margin-left:10px;    
            font-weight: bold;
         }
         .post .top .info .name{
            cursor:pointer;
            font-size:16px;
         }
         .post .top .info .time{
            font-size:12px;
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
</style>
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
                    <img src="ProfilePicture.jpg" class="rounded-circle" width="300">
                    <div class="mt-3">
                      <h4>@username</h4>
                      <button class="btn btn-primary btn btn-dark">Add Friend</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
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
                     <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6>Total Meme Count</h6>
                        <span class = "text-secondary">1245</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <a class="list-group-link>" href="javascript:alert('click!');"> Friend List</a>
                    </li>
                </ul>
              </div>
            </div>
            <!-- Post Container -->
            <div class="col-md-8">
              <div class="postContainer">
                <div class="post create">
                  <div class="top">
                    <div class="image">
                      <img src="ProfilePicture.jpg" alt="">
                    </div>
                    <input type="text" placeholder="What meme are we feeling today?"/>
                 </div>
                <!-- Bottom of Post Box -->
                <div class="bottom">
                    <!-- Creating Button for Image Post Types -->
                    <div class="action">
                    <!--<i class="fa fa-image"></i>-->
                        <span>Image</span>
                    </div>
                    <!-- Creating Button for Gif Post Types -->
                    <div class="action">
                    <!-- <i class="fa fa-smile"></i> -->
                        <span>Gif</span>
                    </div>
                </div>
            </div>
            <!-- Star Wars Meme Post -->
            <div class="post">
                <!-- Top Part of the Post -->
                <div class="top">
                    <!-- Profile Image of the Person Who Posted It -->
                     <div class="image">
                        <img src="ProfilePicture.jpg" alt="">
                    </div>
                    <!-- Header for the Post -->
                    <div class="info">
                        <!-- Name of Person Who Posted It -->
                        <p class="name">My Name</p>
                        <!-- Time When They Posted It -->
                        <span class="time">Today</span>
                    </div>
                    <!-- Three dots to side -->
                    <i class="fas fa-ellipsis-h"></i>
                </div>
                <!-- Actual Post -->
                <div class="content">
                    <!-- Caption -->
                    Best Star War is.
                    <!-- Post Image -->
                    <img src="StarWarsMeme.jpg"/>
                </div> 
                <!-- Bottom Part of the Post-->
                <div class="bottom">
                    <!-- Creating Like Button-->
                    <div class="action">
                        <i class="far fa-thumbs-up"></i>
                        <span>Like</span>
                    </div>
                    <!-- Creating Comment Button-->
                    <div class="action">
                        <i class="far fa-comment"></i>
                        <span>Comment</span>
                    </div>
                    <!-- Creating Share Button-->
                    <div class="action">
                        <i class="fa fa-share"></i>
                        <span>Share</span>
                    </div>
                </div>
            </div>
            <!-- Marvel Meme Post -->
            <div class="post">
                <!-- Top Part of the Post -->
                <div class="top">
                    <!-- Profile Image of the Person Who Posted It -->
                    <div class="image">
                        <img src="ProfilePicture.jpg" alt="">
                    </div>
                    <!-- Header for the Post -->
                    <div class="info">
                        <!-- Name of Person Who Posted It -->
                        <p class="name">My Name</p>
                        <!-- Time When They Posted It -->
                        <span class="time">Today</span>
                    </div>
                    <!-- Three dots to side -->
                    <i class="fas fa-ellipsis-h"></i>
                </div>
                <!-- Actual Post -->
                <div class="content">
                    <!-- Caption -->
                    The similarities is uncanny.
                    <!-- Post Image -->
                    <img src="MarvelMeme.jpg"/>
                </div> 
                <!-- Bottom Part of the Post-->
                <div class="bottom">
                    <!-- Creating Like Button-->
                    <div class="action">
                        <i class="far fa-thumbs-up"></i>
                        <span>Like</span>
                    </div>
                    <!-- Creating Comment Button-->
                    <div class="action">
                        <i class="far fa-comment"></i>
                        <span>Comment</span>
                    </div>
                    <!-- Creating Share Button-->
                    <div class="action">
                        <i class="fa fa-share"></i>
                        <span>Share</span>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</style>

<?php
include("inc/footer.php");
?>
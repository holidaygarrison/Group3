<?php
include("inc/header.php");
include("inc/menu.php");
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
        background:rgb(40,40,40);
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
        background-color: rgb(86,86,86)!important;
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
                color:rgb(255,255,255);
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
         .txt {
            color:rgb(255,255,255);
         }
         .name {
            color:rgb(255,255,255);
         }
         .time {
            color:rgb(255,255,255);
         }
         .popup-container {
            
         }
         .pop-btn {
            padding: 10px;
            background: #fff;
            border: 0;
            outline: none;
            cursor: pointer;
            font-size: 22px;
            font-weight: 500;
            border-radius: 30px;
         }
         .popup {
            width: 400px;
            background: #fff;
            border-radius: 6px;
            position: absolute;
            top:0%;
            left: 50%;
            transform: translate(-50%,-50%) scale(0.1);
            text-align: center;
            padding: 0 30px 30px;
            color: #333;
            visibility: hidden;
            border: 12px solid #B22222;
            border-radius: 10px;
            margin-top: 15px;
            margin-bottom: 15px;
         }
         .open-popup{
            visibility: visible;
            top: 50%;
            transform: translate(-50%,-50%) scale(1);
         }
         .popup h2{
            font-size: 15px;
            font-weight: 500;
            margin: 30px 0 10px;
            color: #fff;
         }
         .popup p {
            font-size: 20px;
            font-weight: 500;
            margin: 30px 0 10px;
            color: #fff;
         }
         .popup button{
            width: 100%;
            margin-top: 50px;
            padding: 10px 0;
            background: #9e0502;
            color: #fff;
            border: 0;
            outline: none;
            font-size: 18px;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
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
                    <img src="./inc/profile_placeholder.jpg" alt="profile img" width="40" height="40">
                 </div>
                <!-- Text Displayed in the Caption Box -->
                 <!--<input type="text" placeholder="What meme are we feeling today?"/> -->
                 <div class="popup-container">
                  <button type="submit" class="pop-btn" onclick="openPopup()">What meme are we feeling today?</button>
                  <div class="popup post create" id="popup">
                     <h2>Create Post</h2>
                     <p>What's on your mind?</p>
                     <div class="btn">
                        <form action="/action_page.php">
                           <input type="text" id="textEnter" name="textEnter"><br>
                           <input type="file" id="myFile" name="filename">
                           <input type="submit">
                        </form>   
                     </div>
                     <button type="button" onclick="closePopup()">Cancel</button>
                  </div>
                 </div>
             </div>
            <!-- Bottom of Post Box -->
             <div class="bottom">
                <!-- Creating Button for Image Post Types -->
                 <div class="action">
                    <!--<i class="fa fa-image"></i>-->
                    <!--<span>Image</span>-->
                 </div>
                <!-- Creating Button for Gif Post Types -->
                 <div class="action">
                    <!-- <i class="fa fa-smile"></i> -->
                    <!--<span>Gif</span>-->
                 </div>
             </div>
         </div>
        <!-- Star Wars Meme Post -->
         <div class="post">
            <!-- Top Part of the Post -->
             <div class="top">
                <!-- Profile Image of the Person Who Posted It -->
                 <div class="image">
                    <!--<img src="./images/dp.jpg" alt="">-->
                 </div>
                <!-- Header for the Post -->
                 <div class="info">
                    <!-- Name of Person Who Posted It -->
                    <p class="name">Person</p>
                    <!-- Time When They Posted It -->
                    <span class="time">Today</span>
                 </div>
                <!-- Three dots to side -->
                <i class="fas fa-ellipsis-h"></i>
             </div>
            <!-- Actual Post -->
             <div class="content">
                <!-- Caption -->
                 <p class="txt">Best Star War is.</p>
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
                    <!--<img src="./images/dp.jpg" alt="">-->
                 </div>
                <!-- Header for the Post -->
                 <div class="info">
                    <!-- Name of Person Who Posted It -->
                    <p class="name">Person</p>
                    <!-- Time When They Posted It -->
                    <span class="time">Today</span>
                 </div>
                <!-- Three dots to side -->
                <i class="fas fa-ellipsis-h"></i>
             </div>
            <!-- Actual Post -->
             <div class="content">
                <!-- Caption -->
                 <p class="txt">The similarities is uncanny.</p>
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

<script>
   let popup = document.getElementById("popup");

   function openPopup(){
      popup.classList.add("open-popup");
   }
   function closePopup(){
      popup.classList.remove("open-popup");
   }
</script>
<?php
include("inc/footer.php");
?>
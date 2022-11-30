<doctype html>
<html>
	<head>
		<title>Login Page </title>
<style>

/* Entire Page */
*{
    margin:0;
    padding:0px;
    box-sizing: border-box;
    font-family: "american typewriter";
    font-size: 1.10rem;
}

/* Background */
body{
  margin-top:20px;
      color: #1a202c;
          text-align: center;
              background-color: #ccc;    
              }
              .main-body {
                 padding:15px;
                 }

                 h1 {
                    font-size: 1.25rem;
                       padding-top: 60px;
                          padding-bottom: 15px;
                          }

                          logoFont {
                             font-family: "American Typewriter", monospace;
                                font-size: 1.5rem;
                                }

                                /* Login Card */
                                .card {
                                   margin: 25px auto;
                                      padding: 30px;
                                         border: 5px solid #ccc;
                                            border-radius:25px;
                                               width: 500px;
                                                  height: 520px;
                                                     background: rgb(224, 181, 181);
                                                     }
                                                        /* Memehub Logo */
                                                           .card .image > img{
                                                                 width: 175px;
                                                                       margin: 10px;
                                                                             cursor: pointer;
                                                                                }

                                                                                /* Username and Password Input */
                                                                                input {
                                                                                   border: 2px solid #ccc;
                                                                                      font-weight: 100;
                                                                                         padding: 20px;
                                                                                            height:40px;
                                                                                               margin: 5px;
                                                                                                  border-radius:25px;
                                                                                                     border: 2px solid #ccc;
                                                                                                        background:#eee;          
                                                                                                        }

                                                                                                        /* Submit Button */
                                                                                                        button {
                                                                                                           margin: 15px auto;
                                                                                                              padding: 10px;
                                                                                                                 font-size: 1.0rem;
                                                                                                                    background: #eee;
                                                                                                                       color: black;
                                                                                                                          border: 2px solid #ccc;
                                                                                                                             border-radius: 25px;
                                                                                                                             }

                                                                                                                             </style>
                                                                                                                             </head>
                                                                                                                             <body>

                                                                                                                             <div class = "container">
                                                                                                                                <div class = "main-body">
                                                                                                                                      <div class = "card">
                                                                                                                                               <div class = "image">
                                                                                                                                                           <img src = "inc/Logo.png" class = "rounded-circle">
                                                                                                                                                                    </div>           
                                                                                                                                                                             <logoFont> Memehub </logoFont>
                                                                                                                                                                                      <h1>Login to your account</h1>
                                                                                                                                                                                               <form name="Frm" action="loginPro.php" method = "post">
                                                                                                                                                                                               	         Username:
                                                                                                                                                                                               	                     <input type="text" name="Username" required>
                                                                                                                                                                                               	                              <br>
                                                                                                                                                                                               	                              	         Password:
                                                                                                                                                                                               	                              	                     <input type="password" name="PWD" required>
                                                                                                                                                                                               	                              	                              <br>
                                                                                                                                                                                               	                              	                                          <button class = "btn-md" role="submit">Submit</button>
                                                                                                                                                                                               	                              	                                                   </form>
                                                                                                                                                                                               	                              	                                                            <p class = "small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href = "#!">
                                                                                                                                                                                               	                              	                                                                        <a href="createAccount.php">Create an Account</a>   
                                                                                                                                                                                               	                              	                                                                        		</div>
                                                                                                                                                                                               	                              	                                                                        			</div>
                                                                                                                                                                                               	                              	                                                                        			</div>
                                                                                                                                                                                               	                              	                                                                        			</body>
                                                                                                                                                                                               	                              	                                                                        			</html>

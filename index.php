<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NIIT Students</title>
	<link rel="icon" href="img/logo.png">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
	<nav>
		<div class="logo">
			<h4>NIIT</h4>
		</div>
		<ul class="nav-links">
			<li id="logoutLink">
				<a href="logout.php" style="color: red; font-size: 16px;"><?php if(isset($_SESSION['niituser'])) echo 'Logout';?></a>
			</li>
			<li id="loggedUser">
				<a href="#" style="color: red; font-size: 16px;"><?php if(isset($_SESSION['niituser'])) echo strtoupper($_SESSION['niituser']);?></a>
			</li>			
		</ul>
		<div class="mob-icon">
			<div class="line1"></div>
			<div class="line2"></div>
			<div class="line3"></div>
		</div>
	</nav>
	<nav class="mobile-nav" id="mobile-nav">
		<div>
			<li>
				<a href="logout.php" style="color: red; font-size: 16px;"><?php if(isset($_SESSION['niituser'])) echo 'Logout';?></a>
			</li>
		</div>	
		<div>
			<li id="loggedUser">
				<a href="#" style="color: red; font-size: 16px;"><?php if(isset($_SESSION['niituser'])) echo strtoupper($_SESSION['niituser']);?></a>
			</li>
		</div>
	</nav>
	<div class="maindiv">
		<div class="login" id="login">
			<div class="loginHeader">
				<header>LOG-IN</header>
			</div>
			<p id="loginstatus"></p>
			<div class="username">
				<label>Username</label>
				<input type="text" id="lUsername" max-length="20">
			</div>
			<div class="password">
				<label>Password</label>
				<input type="password" id="lPassword" max-length="20">
			</div>
			<div class="buttons">
				<button class="btnLogin" onclick="loginClicked()">Login</button>
				<button class="btnJoin" onclick="joinClicked()">Join</button>
			</div>
		</div>
		<div class="signup" id="signup">
			<div class="signUpHeader">
				<header>Sign-Up</header>
			</div>
			<p id="signupstatus"></p>
			<!-- <div class="firstname">
				<label>First Name</label>
				<input type="text" id="firstName">
			</div>
			<div class="lastname">
				<label>Last Name</label>
				<input type="text" id="lastName">
			</div> -->
			<div class="username">
				<label>Username</label>
				<input type="text" id="sUsername" max-length="20">
			</div>
			<div class="password">
				<label>Password</label>
				<input type="password" id="sPassword" max-length="20">
			</div>
			<div class="password">
				<label>Confirm Password</label>
				<input type="password" id="sCPassword" max-length="20">
			</div>
			<div class="buttons">
				<button class="btnSignUp" onclick="signUpClicked()">SignUp</button>
				<button class="btnCancel" onclick="cancelClicked()">Cancel</button>
			</div>
		</div>
		<div class="forum" id="forum">
			<div class="forumHeading">
				<header>NIIT STUDENTS CHAT FORUM</header>
			</div>
			<div class="postsDiv">

			</div>
			
						
			<div class="sendMessage">
				<div class="typingDiv"></div>
				<div class="rawMessageDiv"><textarea class="message" id="message"></textarea></div>
				<div class="btnSendDiv"><button class="btnSend" onclick="sendClicked()">Send</button></div>				
			</div>
		</div>
	</div>

	<input type="hidden" id="logged" value="<?php if(isset($_SESSION['niituser'])) echo $_SESSION['niituser']; else echo 0;?>">
	<script src="js/jquery3.3.1.js"></script>
	<script>
		const setStatus = (obj, col, status) => {
			obj.style.color = col;
			obj.textContent = status; 
			return;
		}
		
		const loginClicked = () => {
			let signup = document.getElementById("signup");
			let login = document.getElementById("login");
			let forum = document.getElementById("forum");
			let status = document.getElementById("loginstatus");
			let user =  document.getElementById("lUsername");
			let pass = document.getElementById("lPassword");
			setStatus(loginstatus, "red", "");

            if(user.value == '' || pass.value == ''){
				setStatus(loginstatus, "red", "Enter a valid username or password")
				return;
			}
			setStatus(loginstatus, "green", "Checking ...");
			//check login
			$.ajax({
				type:"GET",
				url:"config/checklogin.php",
				data: {
					"user": user.value,
					"pass": pass.value
				},
				success: function(data){
					if(data == 0){
						setStatus(loginstatus, "green", "success!!!");
						login.style.display = "none";
						signup.style.display = "none";
						forum.style.display = "block";
						location.reload();
					} else if(data == 1){
						setStatus(loginstatus, "red", "invalid login credentials...");
						return; 
					}
				},
				error: function(){
					;//console.log("error checking login");
					return;
				}
			});

		};
		const joinClicked = () => {
			let signup = document.getElementById("signup");
			let login = document.getElementById("login");
			let forum = document.getElementById("forum");
			let loginstatus = document.getElementById("loginstatus");
			
			setStatus(loginstatus, "red", "");
			login.style.display = "none";
			signup.style.display = "block";
			forum.style.display = "none";

			
		};
		const signUpClicked = () => {
			let signup = document.getElementById("signup");
			let login = document.getElementById("login");
			let forum = document.getElementById("forum");
			let status = document.getElementById("signupstatus");
			let user = document.getElementById("sUsername");
			let pass = document.getElementById("sPassword");
			let confirm = document.getElementById("sCPassword");
			setStatus(loginstatus, "red", "");
			setStatus(status, "red", "");

			if(user.value.length < 2 || user.value.length < 2){
				setStatus(status, "red", "please supply all details correctly");
				return;
			} else if(pass.value != confirm.value){
				setStatus(status, "red", "passwords do not match...");
				return;
			} 

			//check if user exists and add user
			$.ajax({
				type:"GET",
				url:"config/checkuser.php",
				data: {
					"user": user.value,
					"pass": pass.value
				},
				success: function(data){
					if(data == 0){
						setStatus(status, "green", "success");
						signup.style.display = "none";
						login.style.display = "none";
						forum.style.display = "block";
					} else if(data == 1){
						setStatus(status, "red", "this user already exists");
					} else if(data == 2){ 
						setStatus(status, "red", "error signing up");
					}
				},
				error: function(){
					;//console.log("error checking user");
				}
			});

		};
		const cancelClicked = () => {
			let signup = document.getElementById("signup");
			let login = document.getElementById("login");
			let forum = document.getElementById("forum");

			login.style.display = "block";
			signup.style.display = "none";
			forum.style.display = "none";
			
		};
		const sendClicked = () => {
			let message = document.getElementById("message");
			let user = document.querySelector("#logged").value;
			$.ajax({
				type: "GET",
				url: "config/donetyping.php",
				data: {
					"user": user,
					"message": message.value
				},
				success: function(data){
					message.value = "";
					;//console.log(message);
				},
				error: function(){
					;//console.log("error typing");
				} 
			});
		};
	</script>
	<script>
		$(document).ready(()=>{
			document.getElementById('mobile-nav').style.display = "none";
			$l = document.querySelector("#logged").value;
			let signup = document.getElementById("signup");
			let login = document.getElementById("login");
			let forum = document.getElementById("forum");
			if($l != 0){
				signup.style.display = "none";
				login.style.display = "none";
				forum.style.display = "block";
			} else {
				signup.style.display = "none";
				login.style.display = "block";
				forum.style.display = "none";
			}

			$(".message").keyup(()=>{
				let logged = document.querySelector("#logged").value;

				$.ajax({
					type: "GET",
					url: "config/typing.php",
					data: {
						"user":logged
					},
					success: function(data){
						;//console.log(data);
					},
					error: function(){
						;//console.log("error typing");
					} 
				});
			});
			//check typing
			setInterval(() => {
				$.ajax({
					type: "GET",
					url: "config/checktyping.php",
					success: (data) => {
						if(data != 1 && data != 0){
							document.querySelector(".typingDiv").textContent = data+" is typing...";
						} else {
							document.querySelector(".typingDiv").textContent = "";
						}
						;//console.log(data);
					},
					error: () => {
						;//console.log("error typing");
					} 
				});
			}, 3000);
			//load messages from db
			setInterval(() => {
				$.ajax({
					type: "GET",
					url: "config/loadmessages.php",
					success: (data) => {
						if(typeof data !== 'undefined'){
							let res = JSON.parse(data);
							let c = res.length;
							let str = "";
							res.forEach((r)=>{
								str += '<div class="postDiv">';
								str += '<div class="personDiv">'+'<span class="postedby">Posted By: <br></span>'+r.username+'</div>';
								str += '<div class="messageDiv">'+r.post+'</div>';
								str += '<div class="timeDiv">'+r.datetime_added+'</div>';
								str += '</div>';
							});
							let postsDiv = document.querySelector(".postsDiv");
							postsDiv.innerHTML = str;
							postsDiv.scrollTop = postsDiv.scrollHeight;
						}
						
					}, 
					error: () => {
						console.log("error loading messages");
					}
				});
			}, 2000);
		});

		document.querySelector('.mob-icon').addEventListener('click', () => {
			let nav = document.getElementById('mobile-nav');
			if(nav.style.display === "block"){
				nav.style.display = "none";
			} else {
				nav.style.display = "block";
			}
		});
	</script>
</body>
</html>

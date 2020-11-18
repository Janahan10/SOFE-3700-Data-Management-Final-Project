function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("overlay").style.display = "none";
}

function switchForm(){
  var checkbox = document.getElementById("hasAccount")
	var login=document.getElementById("login");
	var signup=document.getElementById("signup");
	if(checkbox.checked == true){
		login.style.display="none";
		signup.style.display="block";
	}else{
		login.style.display="block";
		signup.style.display="none";
	}
}
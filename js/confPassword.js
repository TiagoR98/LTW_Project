window.onload = function() {
document.getElementById("password_confirm").addEventListener('change', confPassword);
document.getElementById("password").addEventListener('change', confPassword);
}

var minPassLength = 6;
var maxPassLength = 60;

function confPassword() {
    var confPasswordField = document.getElementById("password_confirm");
    var passwordField = document.getElementById("password");
    var registerSection = document.getElementById("registerForm");
    var errorMessage =  document.createElement('div');
    errorMessage.setAttribute("id","confPasswordError");
    var showError = false;

    if(registerSection.contains(document.getElementById('confPasswordError'))){
      registerSection.removeChild(document.getElementById('confPasswordError'));
      document.getElementById("submitRegister").setAttribute("type","submit");
    }

    if(confPasswordField.value != passwordField.value){
      errorMessage.appendChild(document.createTextNode("Passwords don't match!"));
      showError=true;
    }else if(confPasswordField.value.length <= minPassLength){
      errorMessage.appendChild(document.createTextNode("Password shorter than "+minPassLength+" characters! "));
      showError=true;
    }else if(confPasswordField.value.length >= maxPassLength){
      errorMessage.appendChild(document.createTextNode("Password longer than "+maxPassLength+" characters! "));
      showError=true;
    }

    if(showError) {
      registerSection.appendChild(errorMessage);
      document.getElementById("submitRegister").setAttribute("type","button");
    }
}

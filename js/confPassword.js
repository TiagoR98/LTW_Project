window.onload = function() {
document.getElementById("password_confirm").addEventListener('change', confPassword);
document.getElementById("password").addEventListener('change', confPassword);
}
function confPassword() {
    var confPasswordField = document.getElementById("password_confirm");
    var passwordField = document.getElementById("password");
    var registerSection = document.getElementById("registerForm");
    var errorMessage =  document.createElement('div');
    errorMessage.setAttribute("id","confPasswordError");
    errorMessage.appendChild(document.createTextNode("Passwords don't match!"));

    if(registerSection.contains(document.getElementById('confPasswordError'))){
      registerSection.removeChild(document.getElementById('confPasswordError'));
      document.getElementById("submitRegister").setAttribute("type","submit");
    }
submitRegister
    if(confPasswordField.value != passwordField.value){
      registerSection.appendChild(errorMessage);
      document.getElementById("submitRegister").setAttribute("type","button");
    }
}

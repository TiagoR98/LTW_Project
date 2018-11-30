window.onload = function() {
document.getElementById("password_confirm").addEventListener('change', confPassword);
}
function confPassword() {
    var confPasswordField = document.getElementById("password_confirm");
    var passwordField = document.getElementById("password");
    var registerSection = document.getElementById("register");
    var errorMessage =  document.createElement('div');
    errorMessage.setAttribute("id","confPasswordError");
    errorMessage.appendChild(document.createTextNode("Passwords don't match!"));

    if(registerSection.contains(document.getElementById('confPasswordError'))){
      registerSection.removeChild(document.getElementById('confPasswordError'));
      document.getElementById("submitRegister").setAttribute("type","submit");
    }

    if(confPasswordField.value != passwordField.value){
      registerSection.appendChild(errorMessage);
      document.getElementById("submitRegister").setAttribute("type","button");
    }
}

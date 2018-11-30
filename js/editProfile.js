function edit(field) {
  var submitButton = "<input type=submit>";
  switch (field) {
    case "email":
      var form = "<input type=email name='email' placeholder='New Email'>";
      document.getElementById("emailInfo").innerHTML = form+submitButton;
      break;
    case "birth":
      var form = "<input type='date' name='birth' placeholder='Birth Date' value='2000-01-01'>";
      document.getElementById("birthInfo").innerHTML = form+submitButton;
      break;
    default:
  }
}

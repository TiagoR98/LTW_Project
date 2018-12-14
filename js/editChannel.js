function edit(field) {
  var submitButton = "<input type=submit>";
  switch (field) {
    case "name":
      var form = "<input type=text name='name' placeholder='Channel Name'>";
      document.getElementById("channelName").innerHTML = form+submitButton;
      break;
    default:
  }
}

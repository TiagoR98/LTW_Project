let orderBox = document.getElementById('orderSelector');
orderBox.addEventListener("change", newOrder);


function newOrder() {
  let orderType = orderBox.options[orderBox.selectedIndex].value;


  // Ajax request
  let request = new XMLHttpRequest()
  request.open("post", "../api/api_list_stories.php", true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  request.addEventListener("load", function () {
    let stories = this.responseText;
    document.getElementById('storyList').innerHTML = stories; // closure
  })
  request.send(encodeForAjax({order: orderType}))


}

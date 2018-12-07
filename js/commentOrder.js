let orderBox = document.getElementById('orderSelector');
orderBox.addEventListener("change", newOrder);

let storyId = document.getElementById('comments').getAttribute('data-id');


function newOrder() {
  let orderType = orderBox.options[orderBox.selectedIndex].value;

  // Ajax request
  let request = new XMLHttpRequest()
  request.open("post", "../api/api_list_comments.php", true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  request.addEventListener("load", function () {
    let comments = this.responseText;
    document.getElementById('commentList').innerHTML = comments; // closure
  })
  request.send(encodeForAjax({order: orderType,storyId: storyId}))


}

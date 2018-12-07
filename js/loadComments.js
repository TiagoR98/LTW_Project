let limit = 5;
let offset = limit;
let loadButton = document.getElementById("btnLoadComments");
loadButton.addEventListener('click',loadMoreStories);
let originalText = loadButton.innerHTML;
let orderCheckBox = document.getElementById('orderSelector');
orderCheckBox.addEventListener('change',function(){
  loadButton.innerHTML = originalText;
  loadButton.removeAttribute("disabled");
  offset=limit;
})

function loadMoreStories(event){
let commentSection = document.getElementById("commentList");
let orderType = orderCheckBox.options[orderCheckBox.selectedIndex].value;

  // Ajax request
  let request = new XMLHttpRequest()
  request.open("post", "../api/api_loadComments.php", true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  request.addEventListener("load", function () {
    let newStories = this.responseText;
    if(newStories == "\n\n\n\n\n\n\n\n\n"){
      loadButton.innerHTML = "No more comments to show";
      loadButton.setAttribute("disabled","true");
    }else{
    commentSection.innerHTML += this.responseText;
    offset += limit;
    }
  })
  request.send(encodeForAjax({order: orderType ,offset: offset,limit: limit,storyId: storyId}))
}

// Helper function
function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&')
}

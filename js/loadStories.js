let limit = 5;
let offset = limit;
let loadButton = document.getElementById("btnLoadStories");
loadButton.addEventListener('click',loadMoreStories);
let originalText = loadButton.innerHTML;
let orderCheckBox = document.getElementById('orderSelector');
orderCheckBox.addEventListener('change',function(){
  loadButton.innerHTML = originalText;
  loadButton.removeAttribute("disabled");
  offset=limit;
})

if(document.getElementById('channelStories') == null)
  channelStories = false;
else
  channelStories = document.getElementById('channelStories').getAttribute('data-id');


function loadMoreStories(event){
let storySection = document.getElementById("storyList");
let orderType = orderCheckBox.options[orderCheckBox.selectedIndex].value;

  // Ajax request
  let request = new XMLHttpRequest()
  request.open("post", "../api/api_loadStories.php", true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  request.addEventListener("load", function () {
    let newStories = this.responseText;
    if(newStories == "\n\n\n\n\n\n\n\n\n"){
      loadButton.innerHTML = "No more stories to show";
      loadButton.setAttribute("disabled","true");
    }else{
    storySection.innerHTML += this.responseText;
    offset += limit;
    }
  })
  request.send(encodeForAjax({order: orderType ,offset: offset,limit: limit,userStories: userStories,channelStories: channelStories}))
}

// Helper function
function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&')
}

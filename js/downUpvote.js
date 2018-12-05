//execute AJAX up/downvote everytime user changes order
document.body.addEventListener('DOMSubtreeModified', updateElements);
window.addEventListener('load', updateElements);

let downVoteButtons,upVoteButtons;

function updateElements(){
downVoteButtons = document.querySelectorAll('.nDownVote');
downVoteButtons.forEach((downVoteButton) => downVoteButton.addEventListener('click', newDownVote));
upVoteButtons = document.querySelectorAll('.nUpVote');
upVoteButtons.forEach((upVoteButton) => upVoteButton.addEventListener('click', newUpVote));
}

function newDownVote(event) {
  let button = event.target;
  let storyId = button.getAttribute('data-id');

  // Ajax request
  let request = new XMLHttpRequest()
  request.open("post", "../api/api_downUpVote.php", true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  request.addEventListener("load", function () {
    let votes = JSON.parse(this.responseText)
    button.innerHTML = "Downvotes: " + votes.downvotes; // closure
    Array.prototype.forEach.call(upVoteButtons, function(upVoteButton) {
      if(upVoteButton.getAttribute('data-id')===storyId)
        upVoteButton.innerHTML = "Upvotes: " + votes.upvotes;
      });
  })
  request.send(encodeForAjax({storyId: storyId,voteType: 'downvote'}))


}


function newUpVote(event) {
  let button = event.target;
  let storyId = button.getAttribute('data-id');

  // Ajax request
  let request = new XMLHttpRequest()
  request.open("post", "../api/api_downUpVote.php", true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  request.addEventListener("load", function () {
    let votes = JSON.parse(this.responseText)
    button.innerHTML = "Upvotes: " + votes.upvotes; // closure
    Array.prototype.forEach.call(downVoteButtons, function(downVoteButton) {
      if(downVoteButton.getAttribute('data-id')===storyId)
        downVoteButton.innerHTML = "Downvotes: " + votes.downvotes;
      });
  })
  request.send(encodeForAjax({storyId: storyId,voteType: 'upvote'}))

}

// Helper function
function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&')
}

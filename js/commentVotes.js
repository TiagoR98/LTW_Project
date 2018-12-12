//execute AJAX up/downvote everytime user changes order
document.body.addEventListener('DOMSubtreeModified', updateElements);
window.addEventListener('load', updateElements);

let commentDownVoteButtons,commentUpVoteButtons;

function updateElements(){
commentDownVoteButtons = document.querySelectorAll('.commentDownVote');
commentDownVoteButtons.forEach((commentDownVoteButton) => commentDownVoteButton.addEventListener('click', newCommentDownVote));
commentUpVoteButtons = document.querySelectorAll('.commentUpVote');
commentUpVoteButtons.forEach((commentUpVoteButton) => commentUpVoteButton.addEventListener('click', newCommentUpVote));
}

function newCommentDownVote(event) {
  let button = event.currentTarget;
  let ID = button.getAttribute('data-id');

  // Ajax request
  let request = new XMLHttpRequest()
  request.open("post", "../api/api_commentVote.php", true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  request.addEventListener("load", function () {
    let votes = JSON.parse(this.responseText)
    button.innerHTML = "<i class=\"fas fa-thumbs-down\"></i> " + votes.downvotes; // closure
    Array.prototype.forEach.call(commentUpVoteButtons, function(upVoteButton) {
      if(upVoteButton.getAttribute('data-id')===ID)
        upVoteButton.innerHTML = "<i class=\"fas fa-thumbs-up\"></i>" + votes.upvotes;
      });
  })
  request.send(encodeForAjax({commentId: ID,voteType: 'downvote'}))


}


function newCommentUpVote(event) {
  let button = event.currentTarget;
  let ID = button.getAttribute('data-id');

  // Ajax request
  let request = new XMLHttpRequest()
  request.open("post", "../api/api_commentVote.php", true)
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  request.addEventListener("load", function () {
    let votes = JSON.parse(this.responseText)
    button.innerHTML = "<i class=\"fas fa-thumbs-up\"></i>" + votes.upvotes; // closure
    Array.prototype.forEach.call(commentDownVoteButtons, function(downVoteButton) {
      if(downVoteButton.getAttribute('data-id')===ID)
        downVoteButton.innerHTML = "<i class=\"fas fa-thumbs-down\"></i> " + votes.downvotes;
      });
  })
  request.send(encodeForAjax({commentId: ID,voteType: 'upvote'}))

}

// Helper function
function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&')
}

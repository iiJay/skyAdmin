$('#chatForm').submit(function(event){
  event.preventDefault();
  var message = $('#chatForm').find('input[name="message"]').val();
  var user = $('#chatForm').find('input[name="userId"]').val();
  $.ajax({
    type: 'GET',
    url: 'chat-ajax.php',
    data: 'get=post&userId= ' + user + '&message=' + message,
  }).done(function(){
    $('#chatBox').load('chat-ajax.php?get=getChat');
    $('#message').empty();
  });
});

function emptyChat(){
  $.ajax({
    type: 'GET',
    url: 'chat-ajax.php',
    data: 'get=empty',
  }).done(function(){
    $('#n').fadeIn('slow').html('<div id="success">Shoutbox has been truncated</div>');
  });
}
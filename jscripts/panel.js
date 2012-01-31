/*
 * skyAdmin AJAX and effect file.
 * Powered by jQuery.
 * Fully written by Jian Ting
 * http://jtprojects.me/
 */

function deleteUser(id){
  $.ajax({
    type: 'POST',
    url: 'ajax.php',
    data: 'mode=deleteUser&id=' + id,
  }).done(function(){
    var div = 'li[name="' + id + '"]';
    $(div).fadeOut('slow');
  });
}
function deleteLink(id){
  $.ajax({
    type: 'POST',
    url: 'ajax.php',
    data: 'mode=deleteLink&id=' + id,
  }).done(function(){
    var div = 'li[name="' + id +'"]';
    $(div).fadeOut('slow');
  });
}
function deletePage(id){
  $.ajax({
    type: 'POST',
    url: 'ajax.php',
    data: 'mode=deletePage&id=' + id,
  }).done(function(){
    var div = 'li[name="' + id + '"]';
    $(div).fadeOut('slow');
  });
}
function deleteGroup(id){
  $.ajax({
    type: 'POST',
    url: 'ajax.php',
    data: 'mode=deleteGroup&id=' + id,
  }).done(function(){
    var div = 'li[name="' + id + '"]';
    $(div).fadeOut('slow');
  });
}
/*
 * Simplicity Theme
 * Author: Jian Ting
 * Site: http://jtprojects.me/
 * Version: 1.2
 */

/*
 * Notice Headers
 */
$(function(){
  $('#error').delay('9000').slideUp('slow');
  $('#success').delay('9000').slideUp('slow');
});

/*
 * Navigation UI Tweaks
 * Added 1.2
 */
$(function(){
	$('#nav > #accordionButton').hover(function(){
		$(this).animate({
			width: '160px',
			paddingRight: '20px'
		}, 200);
	}, function(){
		$(this).animate({
			width: '170px',
			paddingRight: '10px'
		}, 200);
	});
});

/*
 * Random Stuff
 * REQUIRED
 */
function accordionMenu(id){
  var c = '.accordion-' + id;
  $(c).parent().siblings().find('#accordionContent').slideUp('fast'); // Slide up all sub menus except the one clicked
  $(c).slideToggle('fast');
}
function accordionContent(n){
  var c = '.accordionContent-' + n;
  $(c).slideToggle('fast');
}

<?php
  /*
   * This file is ESSENTIAL for theme development.
   * Theme: Simplicity
   * Author: Jian Ting
   * Site: http://jtprojects.me/
   * Additional Notes: This theme is the default theme for skyAdmin. So you might not wanna delete this. 
   */
  if(!defined('BASEPATH')) die();

  /*
   * Theme Headers
   * All will be a div ID
   * <div id="something"></div>
   * #something
   */
  
  /*
   * Error and Success
   * Headers
   */
  define('skyadmin_error_header', 'error');
  define('skyadmin_success_header', 'success');
  
  /*
   * Contents
   */
  define('skyadmin_content_header', 'header');
  define('skyadmin_content_space', 'words');
  define('skyadmin_content_wrapper', 'content');
  
  /*
   * Navigation
   */
  define('skyadmin_nav_div', 'nav');
  define('skyadmin_nav_button', 'accordionButton');
  define('skyadmin_nav_content', 'accordionContent');
  
  /*
   * Essential Classes
   * This will be in classes
   * <div class="something"></div>
   * .something
   */
  define('skyadmin_content_float_left', 'left');
  define('skyadmin_content_float_right', 'right');
  
  /*
   * Dashboard Font
   */
  define('skyadmin_dashboard_id', 'dashboard');
  
  /*
   * Additional Stuff
   * e.g. Javascript Class
   * MUST BE IN CLASSES
   * <div class="something"></div>
   * .something
   * If nothing, just leave value blank.
   */
  define('javascript_skyadmin_menu_content', 'accordion-');
  
?>
<?php
/**
 * Created by PhpStorm.
 * Date: 13-12-2
 * Time: 下午11:40
 * @overview 
 * @author Meatill <lujia.zhai@dianjoy.com>
 * @since 
 */
get_header();

//If the form is submitted
if( isset( $_POST['submitted'] ) ) {

  //Check to see if the honeypot captcha field was filled in
  if( trim( $_POST['checking'] ) !== '' ) {
    $captchaError = true;
  } else {

    //Check to make sure that the name field is not empty
    if( trim( $_POST['contactName'] ) === '' ) {
      $nameError =  __( 'You forgot to enter your name.', 'woothemes' );
      $hasError = true;
    } else {
      $name = trim( $_POST['contactName'] );
    }

    //Check to make sure sure that a valid email address is submitted
    if( trim( $_POST['email'] ) === '' )  {
      $emailError = __( 'You forgot to enter your email address.', 'woothemes' );
      $hasError = true;
    } else if ( ! eregi( "^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email'] ) ) ) {
      $emailError = __( 'You entered an invalid email address.', 'woothemes' );
      $hasError = true;
    } else {
      $email = trim( $_POST['email'] );
    }

    //Check to make sure comments were entered
    if( trim( $_POST['comments'] ) === '' ) {
      $commentError = __( 'You forgot to enter your comments.', 'woothemes' );
      $hasError = true;
    } else {
      $comments = stripslashes( trim( $_POST['comments'] ) );
    }

    //If there is no error, send the email
    if( ! isset( $hasError ) ) {

      $emailTo = get_option( 'woo_contactform_email' );
      $subject = __( 'Contact Form Submission from ', 'woothemes' ).$name;
      $sendCopy = trim( $_POST['sendCopy'] );
      $body = __( "Name: $name \n\nEmail: $email \n\nComments: $comments", 'woothemes' );
      $headers = __( 'From: ', 'woothemes') . "$name <$email>" . "\r\n" . __( 'Reply-To: ', 'woothemes' ) . $email;

      wp_mail( $emailTo, $subject, $body, $headers );

      if( $sendCopy == true ) {
        $subject = __( 'You emailed ', 'woothemes' ) . get_bloginfo( 'title' );
        $headers = __( 'From: ', 'woothemes' ) . "$name <$emailTo>";
        wp_mail( $email, $subject, $body, $headers );
      }

      $emailSent = true;

    }
  }
}

$result = array(

);

require_once(dirname(__FILE__) . '/inc/mustache.php');
$tpl = new Mustache_Engine();
$template = dirname(__FILE__) . '/template/contact.html';
$template = file_get_contents($template);
$template = str_replace('"../', '"{{theme_url}}wp-content/themes/line/', $template);
echo $tpl->render($template, $result);

get_footer();
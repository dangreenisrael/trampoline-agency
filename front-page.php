<?php

if (@$_POST['is_email']){
    $email_address = $_POST['contact_email_address'];
    $admin_email = get_bloginfo('admin_email');
    $subject = "Message from contact form on ".get_bloginfo('name');
    $phone_number = $_POST['contact_phone_number'];
    $name = $_POST['contact_name'];
    $message = $_POST['message'];
    $body = "Name: $name \r\nNumber:$phone_number\r\nEmail:$email_address\r\n----\r\n$message";
    if (wp_mail ($admin_email, $subject, $body)){
        echo "true";
    } else{
        echo "false";
    }
    exit;
}
// Code to display Page goes here...
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['isFrontPage'] = true;

wp_enqueue_script( "front-page", get_stylesheet_directory_uri().'/static/js/front-page.js', 'jQuery', null, true);
wp_enqueue_style( 'global', get_stylesheet_directory_uri() . '/static/less/global.less' );
wp_enqueue_style( 'front-page', get_stylesheet_directory_uri() . '/static/less/front-page.less' );

Timber::render('front-page.twig', $context );

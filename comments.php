<?php

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

$context['formArgs'] =  array(
    'class_submit'  => "btn btn-default",
    'class_form'    => "form-group",
    'comment_field'  => '
        <div class="comment-form-comment form-group">
            <label for="comment">Your Comment:</label> 
            <textarea id="comment" class="form-control" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea>
        </div>
        ',
    'fields' => array(
        'author'    => '
            <div class="comment-form-author form-group">
                <label for="author"> Your Name <span class="required">*</span></label> 
                <input class="form-control" id="author" name="author" type="text"  size="30" maxlength="245" aria-required="true" required="required">
            </div>',
        'email'     => '
            <div class="comment-form-email form-group">
                <label for="email"> Your Email Address <span class="required">*</span></label> 
                <input class="form-control" id="email" name="email" type="text" size="30" maxlength="100" aria-describedby="email-notes" aria-required="true" required="required">
            </div>',
        'url'       => '
            <div class="comment-form-url form-group">
                <label for="url">Your Website</label> 
                <input class="form-control" id="url" name="url" type="text"  size="30" maxlength="200">
            </div>'
    )
);


Timber::render("comments.twig", $context );
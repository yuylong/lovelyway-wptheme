<?php
add_filter( 'comment_form_default_fields', 'fashion_blogging_comment_form' );
function fashion_blogging_comment_form( $fashion_blogging_comment_field ) {
	$fashion_blogging_comment_field['author'] = '<input type="text" class="form-control" name="author" id="name-cmt" placeholder="' . esc_attr__( 'Your Name', 'fashion-blogging' ) . '">';
	$fashion_blogging_comment_field['email']  = '<input type="email" class="form-control" name="email" id="email-cmt" placeholder="' . esc_attr__( 'Your Email', 'fashion-blogging' ) . '">';
	$fashion_blogging_comment_field['url']    = '
                    <input type="text" class="form-control" name="url" id="website" placeholder="' . esc_attr__( 'Your Website', 'fashion-blogging' ) . '">';
	return $fashion_blogging_comment_field;
}
add_filter( 'comment_form_defaults', 'fashion_blogging_comment_default_form' );
function fashion_blogging_comment_default_form( $default_form ) {
	$default_form['comment_field']        = '<textarea class="form-control" name="comment" rows="7" placeholder="' . esc_attr__( 'Message goes here', 'fashion-blogging' ) . '"></textarea>';
	$default_form['submit_button']        = '<button type="submit" class="btn btn-primary">' . esc_attr__( 'Post Comment', 'fashion-blogging' ) . '</button>';
	$default_form['comment_notes_before'] = '';
	$default_form['title_reply']          = esc_attr__( 'Leave A Comment', 'fashion-blogging' );
	$default_form['title_reply_before']   = '<h4>';
	$default_form['title_reply_after']    = '</h4>';
	return $default_form;
}

function fashion_blogging_comment_form_structure( $fields ) {
		$author_field = $fields['author'];
		$email_field = $fields['email'];
		$url_field = $fields['url'];
		$comment_field = $fields['comment'];
		$cookies_field = $fields['cookies'];
		unset( $fields['author'] );
		unset( $fields['email'] );
		unset( $fields['url'] );
		unset( $fields['comment'] );
		unset( $fields['cookies'] );
		$fields['author'] = $author_field;
		$fields['email'] = $email_field;
		$fields['url'] = $url_field;
		$fields['comment'] = $comment_field;
		$fields['cookies'] = $cookies_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'fashion_blogging_comment_form_structure' );
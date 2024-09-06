<?php
/*
Template Name: Form page
*/
get_header(); ?>
        This is a form page:
        <?php
		if ( have_posts() ) :

			while ( have_posts() ) :
				the_post();
				the_title();
				the_content();
			endwhile;

		endif;
		?>
			<?php
				if($_SERVER['REQUEST_METHOD'] === 'POST') {

					if(isset($_POST['message'])) {

						$new_message = $_POST['message'];
						
						global $allowedposttags;
						
						$allowed_content = array_merge(array(), $allowedposttags);
						unset($allowed_content['b']);

						$new_message = wp_kses($new_message, $allowed_content);
						//<b>Bold</b> and <a href="example.com">Länk</a>
						add_post_meta(get_the_id(), 'secretMessage', $new_message);
					}
					
				}

				$messages = get_post_meta(get_the_id(), 'secretMessage', false);
				$messages = apply_filters('secret_messages', $messages, get_the_id(), $messages);
				
				if(isset($_GET['showMessage']) && $_GET['showMessage'] == '1') {
					foreach($messages as $message) {
						echo('<div>'.$message.'</div>');
					}
				}
			?>
			<?php do_action('before_form_on_page_template', count($messages), $messages); ?>
			<?php do_action('form_on_page_template'); ?>
			<?php do_action('after_form_on_page_template'); ?>
        <?php
get_footer();
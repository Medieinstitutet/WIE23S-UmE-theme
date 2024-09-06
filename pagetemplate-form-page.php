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

					var_dump($_POST);
					
				}

				
			?>
			<?php do_action('before_form_on_page_template'); ?>
			<?php do_action('form_on_page_template'); ?>
			<?php do_action('after_form_on_page_template'); ?>
        <?php
get_footer();
<?php
/*
Template Name: Occasion
*/
?>
<?php
get_header();
?>
<?php
		if ( have_posts() ) :

			while ( have_posts() ) :
				the_post();

				the_title();

				the_content();

			endwhile;

		endif;
		
		$terms = get_terms(array(
			'taxonomy' => 'occasion',
			'hide_empty' => true,
			'parent' => 0
		));

		if($terms) {
			foreach($terms as $term) {
				echo('<a href="'.get_term_link($term).'">'.$term->name.'</a>');
			}
		}
            
        ?>
        <?php
get_footer();
?>
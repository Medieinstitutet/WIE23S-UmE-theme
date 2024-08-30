<?php
get_header(); 

$term = get_queried_object();
echo '<h1>' . esc_html($term->name) . '</h1>';

?>
En snacks för varje tillfälle
		<?php
		if ( have_posts() ) :

			while ( have_posts() ) :
				the_post();
                ?>
                    <a href="<?php echo(get_permalink($post->ID)); ?>">
                <?php
				    the_title();
                ?>
                    </a>
                <?php
			endwhile;

		endif;
		?>

<?php
get_footer();

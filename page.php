<?php
get_header(); 

?>
<div class="menu-line">
	<div class="centered-site">
<?php
wp_nav_menu( array(
	'theme_location' => 'frontMenu'
) );
?>
</div>
</div>
<div class="centered-site">
        <?php


		if ( have_posts() ) :

			while ( have_posts() ) :
				the_post();

				$query = new WP_Query(
					array(
						'post_parent' => get_the_ID(),
						'post_type' => 'page',
						'orderby' => 'menu_order',
						'order' => 'ASC'
					)
				);

				while($query->have_posts()) {
					$query->the_post();

					?><a href="<?php echo(get_permalink(get_the_ID())); ?>">
					<?php
					the_title();
					?>
					</a>
					<?php
				}

				wp_reset_postdata();


				the_content();

			endwhile;

		endif;
		?>
</div>
        <?php
get_footer();
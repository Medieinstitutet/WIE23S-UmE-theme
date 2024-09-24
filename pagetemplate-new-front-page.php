<?php
/*
Template Name: New front
*/
?>
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
<?php
		if ( have_posts() ) :

			while ( have_posts() ) :
				the_post();

				?>
					<div class="centered-content">
						<h1>
							<?php
						the_title();
						?>
						</h1>
						<div class="date-and-author">
							<div class="date">2024-09-19</div>
							<div class="author">Mattias</div>
						</div>
						<div class="excerpt">
							<?php
								the_excerpt();
							?>
							
						</div>
					</div>
					<div class="centered-site hero-image">
						<?php
							the_post_thumbnail();
						?>
					</div>
					<div class="centered-content">
						<?php
							the_content();
						?>
					</div>
				<?php

			endwhile;

		endif;
		
            
        ?>
        <?php
get_footer();
?>
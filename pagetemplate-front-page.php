<?php
/*
Template Name: Front
*/
?>

<?php
get_header(); 

?>
Front
		<?php
		if ( have_posts() ) :

			while ( have_posts() ) :
				the_post();
				the_title();
				the_content();

                //echo(get_post_meta(get_the_ID(), 'offer_title', true));
                the_field('offer_title');

                the_field('offer_content');

                $popular_collections = get_field('popular_products'); //MENOTE: field not labeled correctly in admin ACF
                foreach($popular_collections as $collection) {
                    ?>
                        <a href="<?php echo(get_permalink($collection->ID)); ?>">
                            <?php
                                echo($collection->post_title);
                            ?>
                        </a>
                    <?php
                }
			endwhile;

		endif;
		?>

<?php
get_footer();

<?php
/*
Template Name: New front
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
		?>
        <h2>Senaste kollektioner</h2>
        <?php
             add_filter( 'mp_get_latest_collections_query_args', function($args) {
                
                $args['posts_per_page'] = 4;

                return $args
             } );
            $query = apply_filters("mp_get_latest_collections", null);

            if($query) {
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
            }
            
        ?>
        <?php
get_footer();
?>
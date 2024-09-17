<?php
get_header(); 

$term = get_queried_object();

$breadcrumbs = array();
$debug_counter = 0;
$breadcrumb_term = $term;
while($breadcrumb_term->parent) {
	if($debug_counter++ > 100) {
		var_dump("Too long");
		break;
	}
	$parent = get_term($breadcrumb_term->parent, 'product_cat');

	$breadcrumbs[] = $parent;

	$breadcrumb_term = $parent;
}
$breadcrumbs = array_reverse($breadcrumbs);

foreach($breadcrumbs as $breadcrumb_term) {
	echo('<a href="'.get_term_link($breadcrumb_term).'">'.$breadcrumb_term->name.'</a> &gt;');
}

echo '<h1>' . esc_html($term->name) . '</h1>';

?>
Kategorier
		<?php

$terms = get_terms(array(
	'taxonomy' => 'product_cat',
	'hide_empty' => false,
	'parent' => $term->term_id,
));

if($terms) {
	foreach($terms as $term) {
		echo('<a href="'.get_term_link($term).'">'.$term->name.'</a>');
	}
}

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

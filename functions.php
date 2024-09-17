<?php

function mt_theme_setup() {
    load_theme_textdomain( 'mt', get_template_directory() );
}
add_action( 'after_setup_theme', 'mt_theme_setup' );

function mt_register_collections_post_type() {

    $labels = array(
        'name'                  => _x( 'Collections', 'Post type general name', 'mt' ),
        'singular_name'         => _x( 'Collection', 'Post type singular name', 'mt' ),
        'menu_name'             => _x( 'Collections', 'Admin Menu text', 'mt' ),
        'name_admin_bar'        => _x( 'Collection', 'Add New on Toolbar', 'mt' ),
        'add_new'               => __( 'Add New', 'mt' ),
        'add_new_item'          => __( 'Add New Collection', 'mt' ),
        'new_item'              => __( 'New Collection', 'mt' ),
        'edit_item'             => __( 'Edit Collection', 'mt' ),
        'view_item'             => __( 'View Collection', 'mt' ),
        'all_items'             => __( 'All Collections', 'mt' ),
        'search_items'          => __( 'Search Collections', 'mt' ),
        'parent_item_colon'     => __( 'Parent Collection:', 'mt' ),
        'not_found'             => __( 'No collections found.', 'mt' ),
        'not_found_in_trash'    => __( 'No collections found in Trash.', 'mt' ),
        'featured_image'        => _x( 'Collection Cover Image', 'Overrides the “Featured Image” phrase', 'mt' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase', 'mt' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase', 'mt' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase', 'mt' ),
        'archives'              => _x( 'Collection Archives', 'The post type archive label', 'mt' ),
        'insert_into_item'      => _x( 'Insert into collection', 'Overrides the “Insert into post” phrase', 'mt' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this collection', 'Overrides the “Uploaded to this post” phrase', 'mt' ),
        'filter_items_list'     => _x( 'Filter collections list', 'Screen reader text for the filter link', 'mt' ),
        'items_list_navigation' => _x( 'Collections list navigation', 'Screen reader text for pagination', 'mt' ),
        'items_list'            => _x( 'Collections list', 'Screen reader text for item list', 'mt' ),
    );

    $args = array(
        'labels'               => $labels,
        'public'              => true,
        'supports'            => array( 'title', 'editor', 'thumbnail' ),
        'has_archive'         => true,
        'show_in_rest' => false,
        'rewrite' => array( 'slug' => 'fardiga-mixar' )
    );

    register_post_type( 'collection', $args );

}
add_action( 'init', 'mt_register_collections_post_type' );


add_action('form_on_page_template', 'mt_output_form', 10);

function mt_output_form() {

    $products = wc_get_products(array());

    ?>
        <form method="POST">
                    <input name="title" />
                    <textarea name="content"></textarea>
<select name="selectedProducts[]" multiple>
    <?php
        foreach($products as $product) {

            $id = $product->get_id();
            $title = $product->get_name();

            ?>
                <option value="<?php echo($id); ?>"><?php echo(esc_html($title)); ?></option>
            <?php
        }
    ?>
</select>
                    <input type="submit" />
                </form>
    <?php
}


function mt_collection_filter($query) {
    if($query->is_main_query() ) {
        if(isset($_GET['startDate']) && $_GET['startDate']) {
            $date_query = array(
                array(
                    'after'     => $_GET['startDate'],
                    'inclusive' => true,
                ),
            );
            
            $query->set( 'date_query', $date_query );
        }
    }
    }
    add_action( 'pre_get_posts', 'mt_collection_filter' );

?>
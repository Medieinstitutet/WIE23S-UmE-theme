<?php


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
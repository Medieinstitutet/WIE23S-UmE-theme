<?php

if( is_user_logged_in() ) {

    $user = wp_get_current_user();

    $roles = ( array ) $user->roles;

	if(in_array('administrator', $roles)) {

	}
}

if(current_user_can('administrator')) {

}

get_header(); ?>
        <div>
			<a href="<?php echo(home_url("/fardiga-mixar/")); ?>">Färdiga mixar</a>
		</div>
        <?php
		if ( have_posts() ) :

			while ( have_posts() ) :
				the_post();
				the_title();
				the_content();
			endwhile;

		endif;

		$product_ids = get_post_meta(get_the_ID(), 'products', true);

		foreach($product_ids as $product_id) {
			$product = wc_get_product($product_id);

			?>
				<div>
					<a href="<?php echo(get_permalink($product_id)); ?>">
						<?php echo($product->get_name()) ?>
					</a>
				</div>
			<?php
		}

		?>
			<form method="POST">
				<input type="submit" value="Lägg till i varukorg" />
			</form>
		<?php

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			$product_ids = get_post_meta(get_the_ID(), 'products', true);
			foreach($product_ids as $product_id) {
				WC()->cart->add_to_cart($product_id, 1, 0, array(), array('collection' => get_the_ID() ));
			}
		}

		if($_SERVER['REQUEST_METHOD'] == 'POST' && false) { //MEDEBUG: always false

			$action = $_POST['action'];
			$id = $_POST['id'];
			$date = $_POST['date'];
			$nonce = $_POST['nonce'];
		
			$valid_nonce = wp_create_nonce($action.'|'.$id.'|'.$date);
		
			if($nonce == $valid_nonce) {

				$stale_nonce = $_POST['stale_nonce'];
				$saved_stale_nonce = wp_create_nonce(get_the_content());
				if($stale_nonce == $saved_stale_nonce) {
					$current_date = date('Y-m-d h:i:s');
					$current_time = time();
			
					$time_in_10_minutes = $current_time - (10 * 60);
					$plus10 = date('Y-m-d h:i:s', $time_in_10_minutes);
			
					if($plus10 < $date) {
						echo("Correct");
						if($action == 'edit') {
							wp_update_post(array(
								'ID' => $id,
								'post_content' => $_POST['description']
							));
						}
						else if($action == 'delete') {
							
						}
					}
					else {
						echo("Too late");
					}
				}
				else {
					echo("Stale data");
				}
				
			}
			else {
				echo("Incorrect nonce");
			}
		}


		$action = 'edit';
		$post_id = get_the_ID();
		$date = date('Y-m-d h:i:s');
		$nonce = wp_create_nonce($action.'|'.$post_id.'|'.$date);
		$stale_nonce = wp_create_nonce(get_the_content());

		?>
			<form method="POST">
				<input type="hidden" name="action" value="<?php echo($action); ?>" />
				
				<input type="hidden" name="id" value="<?php echo($post_id); ?>" />
				<input type="hidden" name="date" value="<?php echo($date); ?>" />
				<input type="hidden" name="nonce" value="<?php echo($nonce); ?>" />
				<input type="hidden" name="stale_nonce" value="<?php echo($stale_nonce); ?>" />
				<textarea name="description">

				</textarea>
				<input type="submit" />
			</form>
        <?php
get_footer();
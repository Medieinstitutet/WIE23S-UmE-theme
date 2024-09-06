<?php
get_header();

?>
Archive collection
<form method="GET">
    <input type="date" name="startDate" />
    <input type="date" name="endDate" />
    <select name="filterOccasion">
        <option>Välj tidpunkt</option>
    </select>
    <input type="submit" />
</form>
		<?php
		if ( have_posts() ) :

			while ( have_posts() ) :
				the_post();

                ?>
                    <a href="<?php echo(get_permalink(get_the_ID())); ?>">
                    <div>
                        <?php
				            the_title();
                        ?>
                    </div>
                    </a>
				<?php
			endwhile;

		endif;
		?>

<?php
get_footer();

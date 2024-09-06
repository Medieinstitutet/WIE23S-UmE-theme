<?php


add_action('form_on_page_template', 'mt_output_form', 10);

function mt_output_form() {
    ?>
        <form method="POST">
                    <input name="title" />
                    <textarea name="content">

</textarea>
<select name="selectedProducts[]" multiple>
    <option value="0">Test</option>
    <option value="1">Test</option>
</select>
                    <input type="submit" />
                </form>
    <?php
}




?>
<?php


add_action('before_form_on_page_template', function($message_count, $messages) {
    do_action('before_form_on_page_template_reversed', $messages, $message_count);
}, 10, 2);


add_action('form_on_page_template', 'mt_output_form', 10);

function mt_output_form() {
    ?>
        <form method="POST">
                    <input name="message" />
                    <input type="submit" />
                </form>
    <?php
}




?>
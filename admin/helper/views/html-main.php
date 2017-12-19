<?php

?>

<div class="wrap">
    <h1>Test plugin settings</h1>

    <form method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Test checkbox</th>
                <td><input type='checkbox' id='test_plugin_checkbox' name='test_plugin_checkbox' value="1"
                        <?php checked(get_option('test_plugin_checkbox'),1)?>>
            </tr>
            <tr valign="top">
                <th scope="row">Test checkbox</th>
                <td>
                    <?php  $options = get_option('test_plugin_select'); ?>
                    <p><select  name="test_plugin_select">
                            <option disabled>Оберіть пункт</option>
                            <option value="1" <?php echo selected($options,1); ?>>Пункт 1</option>
                            <option value="2" <?php echo selected($options,2); ?>>Пункт 2</option>
                            <option value="3" <?php echo selected($options,3); ?>>Пункт 3</option>
                            <option value="4" <?php echo selected($options,4); ?>>Пункт 4</option>
                        </select></p>
                </td>
            </tr>
            <tr>
                <th scope="row">Test input</th>
                <td>
                    <input type='text' name='test_plugin_input'  value='<?php echo esc_attr(get_option('test_plugin_input')); ?>'>
                </td>
            </tr>
        </table>

        <input name='action' type="hidden" value='custom_form_submit'>

        <?php submit_button('Save settings') ?>

    </form>
</div>



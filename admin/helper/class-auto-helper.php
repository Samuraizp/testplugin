<?php


Class Test_auto_helper {

    public static function getViewFilename($view)
    {
        return __DIR__ . "/views/$view";
    }
    public static function renderAutoAdminPage()
    {

        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        if ( isset( $_GET['settings-updated'] ) ) {
            add_settings_error( 'premmerce_messages', 'premmerce_message', 'Settings Saved', 'updated' );
        }

        settings_errors( 'premmerce_messages' );

        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <form action="options.php" method="post">
                <?php
                settings_fields( 'test-plugin-settings' );

                do_settings_sections( 'test-plugin-settings' );

                submit_button( 'Save Settings' );
                ?>
            </form>
        </div>
        <?php
        
    }

    public static function test_plugin_section_callback() {
        echo "<p>Контент секції</p>";
    }

    public static function test_plugin_input_auto_callback( $args ) {

        $option = get_option( 'test_plugin_input_auto' )
        ?>
        <input type="text" name="test_plugin_input_auto[<?= esc_attr( $args['label_for'] ); ?>]"
               value="<?= $option[ $args['label_for'] ] ?>">
        <?php
    }

    public static function test_plugin_select_auto_callback( $args ) {

        $option = get_option( 'test_plugin_select_auto' );
        ?>

        <p><select name="test_plugin_select_auto">
                <option disabled>Оберіть пункт</option>
                <option value="1" <?php echo selected($option,1); ?>>Пункт 1</option>
                <option value="2" <?php echo selected($option,2); ?>>Пункт 2</option>
                <option value="3" <?php echo selected($option,3); ?>>Пункт 3</option>
                <option value="4" <?php echo selected($option,4); ?>>Пункт 4</option>
            </select></p>
        <?php
    }

    public static function test_plugin_checkbox_auto_callback( $args ) {

        $option = get_option( 'test_plugin_checkbox_auto' );
        ?>
        <input type='checkbox' name='test_plugin_checkbox_auto' value="1"
            <?php checked($option,1)?>>
        <?php
    }


}




?>
<?php
/**
 * Created by PhpStorm.
 * User: samuraizp
 * Date: 18.12.17
 * Time: 16:43
 */


if (!class_exists('TestAdmin', false)) :

    class TestAdmin
    {
        public function __construct()
        {
            add_action('admin_menu', array($this, 'adminMenu'));
            add_action('admin_init', array($this, 'registerSettings'));
            add_action('admin_post_custom_form_submit', array($this,'process_form_data'));

        }

        public function adminMenu()
        {
            add_menu_page( 'Test plugin admin', 'Test plugin', 'manage_options', PLUGIN_SETTINGS_SLUG, array($this, 'adminPage'), '', 25 );
            add_submenu_page(PLUGIN_SETTINGS_SLUG, 'Test plugin auto settings', 'auto settings',
                'manage_options', 'auto-settings', array($this, 'autoAdminPage'));
        }


        public function registerSettings()
        {
            register_setting('test-plugin-settings', 'test_plugin_select_auto');
            register_setting('test-plugin-settings', 'test_plugin_checkbox_auto');
            register_setting('test-plugin-settings', 'test_plugin_input_auto');


            add_settings_section(
                'test_plugin_section',
                'Settings block',
                array('Test_auto_helper','test_plugin_section_callback'),
                'test-plugin-settings'
            );


            add_settings_field(
                'test_plugin_checkbox_auto',

                'Checkbox',
                array('Test_auto_helper','test_plugin_checkbox_auto_callback'),
                'test-plugin-settings',
                'test_plugin_section'
            );

            add_settings_field(
                'test_plugin_select_auto',

                'Select',
                array('Test_auto_helper','test_plugin_select_auto_callback'),
                'test-plugin-settings',
                'test_plugin_section'
            );

            add_settings_field(
                'test_plugin_input_auto',

                'Input',
                array('Test_auto_helper','test_plugin_input_auto_callback'),
                'test-plugin-settings',
                'test_plugin_section',
                [
                    'label_for' => 'test_plugin_input_auto',
                ]
            );

        }



        public function adminPage()
        {
            if (!class_exists('Test_Helper'))
            {
                include_once TEST_ABSPATH . 'admin/helper/class-helper.php';
                Test_Helper::renderAdminPage();
            }

        }


        public function autoAdminPage()
        {
            if (!class_exists('Test_Helper'))
            {
                include_once TEST_ABSPATH . 'admin/helper/class-auto-helper.php';
                Test_auto_helper::renderAutoAdminPage();
            }

        }

        public function process_form_data()
        {

            $test_plugin_checkbox = $_POST['test_plugin_checkbox'];
            $test_plugin_select = $_POST['test_plugin_select'];
            $test_plugin_input = $_POST['test_plugin_input'];
            $this->editOption('test_plugin_checkbox',$test_plugin_checkbox);
            $this->editOption('test_plugin_select',$test_plugin_select);
            $this->editOption('test_plugin_input',$test_plugin_input);

            wp_redirect('admin.php?page='.PLUGIN_SETTINGS_SLUG);

        }

        public function editOption($option_name,$new_value)
        {
            if ( get_option( $option_name ) !== false ) {
                update_option( $option_name, $new_value );
            } else {
                $deprecated = null;
                $autoload = 'yes';
                add_option( $option_name, $new_value, $deprecated, $autoload );
            }
        }

                
    }



endif;

return new TestAdmin();













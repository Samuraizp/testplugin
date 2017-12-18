<?php
/**
 * Created by PhpStorm.
 * User: samuraizp
 * Date: 18.12.17
 * Time: 16:41
 */


Class TestPlugin
{
    protected static $_instance = null;
    public function __construct()
    {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }
    private function define_constants()
    {
        $this->define('TEST_ABSPATH', dirname(TEST_PLUGIN) . '/');
        $this->define('TEST_PLUGIN_DIR', untrailingslashit(dirname(TEST_PLUGIN)));
        $this->define('TEST_PLUGIN_URL', untrailingslashit(plugins_url('', TEST_PLUGIN)));
        $this->define('TEST_PLUGIN_ADMIN_URL', TEST_PLUGIN . '/admin');
    }
    private function define($name, $value)
    {
        if (!defined($name))
        {
            define($name, $value);
        }
    }
    public function includes()
    {
        if (is_admin())
        {
            include_once(TEST_ABSPATH . 'admin/admin.php');
        }
    }
    private function init_hooks()
    {

    }
    public static function instance()
    {
        if (is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
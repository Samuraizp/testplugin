<?php
/*
Plugin Name: Test plugin
Description: Test plugin
Version: 0.0.1
*/


if (!defined('ABSPATH'))
{
    exit;
}
if (!defined('TEST_PLUGIN'))
{
    define('TEST_PLUGIN', __FILE__);
}
if (!class_exists('testPlugin'))
{
    include_once dirname(TEST_PLUGIN) . '/includes/class-main-test.php';
}

function testPlugin()
{
    return testPlugin::instance();
}

$GLOBALS['testPlugin'] = testPlugin();
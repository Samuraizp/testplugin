<?php


Class Test_Helper {

    public static function getViewFilename($view)
    {
        return __DIR__ . "/views/$view";
    }
    public static function renderAdminPage()
    {
        $cpt_name = 'any';
        if (!empty($_GET['pag']) && is_numeric($_GET['pag']))
        {
            $paged = $_GET['pag'];
        }
        else
        {
            $paged = 1;
        }
        $posts_per_page = (get_option('posts_per_page')) ? get_option('posts_per_page') : 10;
        $args = array(
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
            'fields'         => 'ids',
            'post_type'      => $cpt_name
        );
        $all_posts  = get_posts($args);
        $post_count = count($all_posts);
        $num_pages = ceil($post_count / $posts_per_page);
        if ($paged > $num_pages || $paged < 1)
        {
            $paged = $num_pages;
        }
        $args = array(
            'posts_per_page' => $posts_per_page,
            'orderby'        => 'title',
            'order'          => 'ASC',
            'post_type'      => $cpt_name,
            'paged'          => $paged
        );
        $my_posts = get_posts($args);
        include(self::getViewFilename('html-main.php'));
        return;
    }
}




?>
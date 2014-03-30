<?php
/**
 * Template Name: 球衣diy
 *
 * Created by PhpStorm.
 * Date: 14-3-30
 * Time: 下午10:04
 * @overview 
 * @author Meatill <lujia.zhai@dianjoy.com>
 * @since 
 */
get_header();

require_once(dirname(__FILE__) . '/inc/mustache.php');
$tpl = new Mustache_Engine();
$template = dirname(__FILE__) . '/template/diy.html';
$template = file_get_contents($template);
$template = str_replace('"../', '"{{theme_url}}wp-content/themes/line/', $template);
echo $tpl->render($template, $result);

get_footer();
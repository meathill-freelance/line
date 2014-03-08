<?php
/**
 * Created by PhpStorm.
 * Date: 13-12-4
 * Time: 下午11:51
 * @overview 
 * @author Meatill <lujia.zhai@dianjoy.com>
 * @since 
 */
get_header();


$result = array(

);

require_once(dirname(__FILE__) . '/inc/mustache.php');
$tpl = new Mustache_Engine();
$template = dirname(__FILE__) . '/template/contact.html';
$template = file_get_contents($template);
$template = str_replace('"../', '"{{theme_url}}wp-content/themes/line/', $template);
echo $tpl->render($template, $result);

get_footer();
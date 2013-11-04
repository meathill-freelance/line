<?php
/**
 * Created by PhpStorm.
 * Date: 13-11-5
 * Time: 上午12:32
 * @overview
 * @author Meatill <lujia.zhai@dianjoy.com>
 * @since
 */

require(dirname(__FILE__) . '/inc/mustache.php');
$tpl = new Mustache_Engine();

$template = dirname(__FILE__) . '/template/index.html';
$template = file_get_contents($template);
$template = str_replace('"../', '"{{theme_url}}wp-content/themes/line/', $template);

$home_url = esc_url(home_url('/'));
echo $tpl->render($template, array('theme_url' => $home_url));
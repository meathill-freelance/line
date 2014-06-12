<?php
/**
 * Created by PhpStorm.
 * Date: 13-11-14
 * Time: 下午11:16
 * @overview 
 * @author Meatill <lujia.zhai@dianjoy.com>
 * @since 
 */

require_once(dirname(__FILE__) . '/inc/mustache.php');
$tpl = new Mustache_Engine(array('cache' => '/var/tmp'));

global $page, $paged;
$pagenum = $page > 2 || $paged > 2 ? ' | ' . sprintf(__('第 %s 页'), max($paged, $page)) : '';
$home_url = esc_url(home_url('/'));
$result = array(
  'theme_url' => $home_url,
  'title' => wp_title('|', FALSE, 'right') . get_bloginfo('name') . $pagenum,
  'body-class' => join( ' ', get_body_class( $class ) ),
);

$template = dirname(__FILE__) . '/template/header.html';
$template = file_get_contents($template);
$template = str_replace('"../', '"{{theme_url}}wp-content/themes/line/', $template);
$html = $tpl->render($template, $result);
$htmls = explode('<!-- wp & woo headers -->', $html);

echo $htmls[0];
wp_head();
woo_head();
echo $htmls[1];
<?php
use Wildfire\Core\Theme;

include_once 'init.php';

$theme = new Theme();
?>

<!doctype html>
<html lang="<?=$types['webapp']['lang'];?>">
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex, nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>
		<?=
		'Wildfire Dashboard'.(isset($types['webapp']['headmeta_title']) ?
			' &raquo; ' . $types['webapp']['headmeta_title'] :
			'');
		?>
	</title>
	<meta name="description" content="Content management dashboard interface<?php echo(isset($types['webapp']['headmeta_title']) ? ' for ' . $types['webapp']['headmeta_title'] : ''); ?>">
	<link rel="stylesheet" href="https://use.typekit.net/xkh7dxd.css">
	<link rel="stylesheet" href="<?=ADMIN_URL;?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=ADMIN_URL;?>/css/wildfire.css">
	<link rel="stylesheet" href="<?=ADMIN_URL;?>/plugins/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?=ADMIN_URL;?>/plugins/datatables/datatables.min.css">
	<link rel="stylesheet" href="<?=ADMIN_URL;?>/css/custom.css">
</head>

<body>
<hr class="hr fixed-top" style="margin:0 !important;">

<?php
if ($menus['admin_menu'] ?? false) {
	$admin_menus['admin_menu'] = $menus['admin_menu'];
	$admin_menus['admin_footer_1'] = $menus['admin_footer_1'];
	$admin_menus['admin_footer_2'] = $menus['admin_footer_2'];
	$admin_menus['admin_menu']['logo']['name'] = '<span class="fas fa-angle-double-left"></span>&nbsp;' . $menus['admin_menu']['logo']['name'];
} else {
	$admin_menus = json_decode(file_get_contents(__DIR__ . '/config/admin_menus.json'), true);

	if ($menus['main']['logo']['name']) {
		$admin_menus['admin_menu']['logo']['name'] = '<span class="fas fa-angle-double-left"></span>&nbsp;' . $menus['main']['logo']['name'];
	}
}
$css_classes = [
	'navbar' => 'navbar-expand-md navbar-light bg-primary mb-4 pt-1 pb-0',
	'ul' => 'navbar-nav ml-auto mr-0',
	'li' => 'nav-item',
	'a' => 'nav-link text-white',
	'toggler' => 'navbar-toggler text-white'
];
$hamburger_bars = '<span class="fas fa-bars"></span>';

echo $theme->get_navbar_menu($admin_menu, $css_classes, $hamburger_bars);
?>

<div class="p-3 container">

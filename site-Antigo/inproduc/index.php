<?php

//print_r($_SERVER);die();

$sitepad['db_name'] = 'wltoposc_spad257';
$sitepad['db_user'] = 'wltoposc_spad257';
$sitepad['db_pass'] = 'q.SSq.jg(0';
$sitepad['db_host'] = 'localhost';
$sitepad['db_table_prefix'] = 'lqUZFc0_';
$sitepad['charset'] = 'utf8mb4';
$sitepad['collate'] = 'utf8mb4_unicode_ci';
$sitepad['serving_url'] = 'wltopos.com.br/inproduc';// URL without protocol but with directory as well
$sitepad['url'] = 'https://wltopos.com.br/inproduc';
$sitepad['relativeurl'] = '/inproduc';
$sitepad['.sitepad'] = '/home/wltoposc';
$sitepad['sitepad_plugin_path'] = '/usr/local/sitepad';
$sitepad['editor_path'] = '/usr/local/sitepad/editor';
$sitepad['path'] = dirname(__FILE__);
$sitepad['AUTH_KEY'] = 'SA3Q9WI4A9KAY2QoTvGbDccoq5N4au5fixI1LSmMhXdAceULc1uS5mgvm2c3zJBa';
$sitepad['SECURE_AUTH_KEY'] = 'TR30rmOBa4Jh5O5t2iGvtTkloUAkYyrQhQwF6xvW1SUIHScB5ghUqP94xVf4I1qG';
$sitepad['LOGGED_IN_KEY'] = 'ebonjXStXmbLhJQexY5IuVfRYVtlv8gKjx3gYrq4px3WesNpPMA1ro6PghKYlDbd';
$sitepad['NONCE_KEY'] = 'K8DizKDVAlPnoDLYbSdQURmAlT39HBfUlkb401MG5Y39gxJrjdIA17YQnzbIEbXE';
$sitepad['AUTH_SALT'] = 'ldYiCPlAx3IMxDj1HmOH1hSCJCsuLejVkJjtHQE3JH4jeGopN6jUGqYjWz4cP3Zx';
$sitepad['SECURE_AUTH_SALT'] = 'cDLl76yqk5KhPT0780YKvlsXUWeNC1LbmAr7NTHN86chEsghFNe1RSD4XU37uuwX';
$sitepad['LOGGED_IN_SALT'] = 'UsMz2x55FLQqNwpdhhtuli13lOLPhaaxni6lWvTYHxrg0UqXkO8ry8aqV6Ehe2ct';
$sitepad['NONCE_SALT'] = 'XZWGSrFI7yI8v93WozaMPRbBPC2D3vJXOiUTiZnfp8CKvekkxhY963wEq6buI6hF';

if(!include_once($sitepad['editor_path'].'/site-inc/bootstrap.php')){
	die('Could not include the bootstrap.php. One of the reasons could be open_basedir restriction !');
}


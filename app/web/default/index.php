<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Viso" />
	<link rel="stylesheet" media="screen" href="<?php echo gf_DOMAIN; ?>/apps/web/default/css/stylesheet.css" />
	<title>Kroc.pl - Przytnij link</title>
</head>

<body>
	<div id="container">

		<div id="header">
			<h1><img src="<?php echo gf_DOMAIN; ?>/apps/web/default/images/logo.png" /><img src="<?php echo gf_DOMAIN; ?>/apps/web/default/images/slogan.png" /></h1>
		</div>

		<div id="linebreak"></div>

		<div id="navigation">
			<center>
				<ul>
					<li><a href="<?php echo gf_DOMAIN; ?>/index.htm">Strona Główna</a></li>
					<li><a href="<?php echo gf_DOMAIN; ?>/rules.htm">Regulamin</a></li>
					<li><a href="<?php echo gf_DOMAIN; ?>/about_api.htm">API</a></li>
					<li><a href="<?php echo gf_DOMAIN; ?>/contact.htm">Kontakt</a></li>

				</ul>
			</center>
		</div>

		<div id="linebreak"></div>

		<div id="content">
			<center>
                <?php
                include($template);
                gfLog::add(gfLog::TYPE_DEBUGG, gfLog::DEBUGG_FILE_LOADED, gfLog::STATUS_SUCCESS, $sPath, gfDebugg::getTime());
                ?>
			</center>
		</div>

		<div id="linebreak"></div>

		<div id="footer" align="right">
			Copyright &copy; 2011 <b>Kroc.pl</b>. <br />
			All rights reserved.
		</div>

	</div>
</body>
</html>
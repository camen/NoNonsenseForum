<!DOCTYPE html>
<meta charset="utf-8" />
<!-- NoNonsense Forum © Copyright (CC-BY) Kroc Camen 2011
     licensed under Creative Commons Attribution 3.0 <creativecommons.org/licenses/by/3.0/deed.en_GB>
     you may do whatever you want to this code as long as you give credit to Kroc Camen, <camendesign.com> -->
<title>Append to <?=$HEADER['TITLE']?></title>
<!-- get rid of IE site compatibility button -->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<link rel="stylesheet" href="/themes/<?=FORUM_THEME?>/theme.css" />
<meta name="viewport" content="width=device-width, maximum-scale=1, user-scalable=no" />
<meta name="robots" content="noindex, nofollow" />
<!-- details on using mobile favicons with thanks to <mathiasbynens.be/notes/touch-icons> -->
<link rel="shortcut icon" type="image/x-icon" href="/themes/<?=FORUM_THEME?>/favicon.ico" />
<link rel="apple-touch-icon-precomposed" href="/themes/<?=FORUM_THEME?>/touch.png" />
<!-- Microsoft’s insane IE9 pinned site syntax: <msdn.microsoft.com/library/gg131029> -->
<meta name="application-name" content="<?=PATH ? safeString(PATH) : safeString (FORUM_NAME)?>" />
<meta name="msapplication-starturl" content="<?=FORUM_URL.PATH_URL?>" />
<meta name="msapplication-window" content="width=1024;height=600" />
<meta name="msapplication-navbutton-color" content="#222" />

<body>
<!-- =================================================================================================================== -->
<!-- original 'Grayscale' theme by Jon Gjengset <thesquareplanet.com>,
     greyscale theme by Kroc Camen, please modify to suit your needs -->
<header id="mast">
	<h1><a href="/"><?=safeHTML(FORUM_NAME)?></a></h1>
	<form id="search" method="get" action="http://google.com/search"><!--
		--><input type="hidden" name="as_sitesearch" value="<?=safeString($_SERVER['HTTP_HOST'])?>" /><!--
		--><input id="query" type="search" name="as_q" placeholder="Google Search…" /><!--
		--><input id="go" type="image" src="/themes/<?=FORUM_THEME?>/icons/go.png" value="Search" width="20" height="20" /><!--
	--></form>
	
	<nav><p>
		<a id="index" href="/">Index</a><?php if (PATH): ?> » <a href="<?=PATH_URL?>"><?=PATH?></a><?php endif; ?>
	</p></nav>
</header>
<!-- =================================================================================================================== -->
<section id="append">
	<h1>Append</h1>
	<form method="post" action="#reply" enctype="application/x-www-form-urlencoded;charset=utf-8" autocomplete="on">
<?php if (FORUM_ENABLED): ?>
		<div id="rightcol">
		
		<p id="puser">
			<label for="user">Name:</label>
			<input name="username" id="user" type="text" size="28" tabindex="2"
			       maxlength="<?=SIZE_NAME?>" required autocomplete="on"
			       placeholder="Your name" value="<?=$FORM['NAME']?>" />
		</p><p id="ppass">
			<label for="pass">Password:</label>
			<input name="password" id="pass" type="password" size="28" tabindex="3"
			       maxlength="<?=SIZE_PASS?>" required autocomplete="on"
			       placeholder="A password to keep your name" value="<?=$FORM['PASS']?>" />
		</p><p id="pemail">
			<label class="email">Email:</label>
			<input name="email" type="text" value="example@abc.com" tabindex="0"
			       required autocomplete="off" />
			(Leave this as-is, it’s a trap!)
		</p>
<?php switch ($FORM['ERROR']):
	case ERROR_NONE: ?>
		<p id="ok">Only the original author or a moderator can append to this post.</p>
<?php break;
	case ERROR_NAME: ?>
		<p id="error">Enter a name. You’ll need to use this with the password each time.</p>
<?php break;
	case ERROR_PASS: ?>
		<p id="error">Enter a password. It’s so you can re-use your name each time.</p>
<?php break;
	case ERROR_TEXT: ?>
		<p id="error">Well, write a message!</p>
<?php break;
	case ERROR_AUTH: ?>
		<p id="error">Name / password mismatch! You must enter the name and password of either the original author,
		or a designated moderator.</p>
<?php endswitch; ?>
		<p id="markup">
			Pro tip: Use <a href="/markup.txt">markup</a> to add links, quotes and more.
		</p>
		
		</div><div id="leftcol">
		
		<p id="ptext">
			<label for="text">Message:</label>
			<div id="wtext">
				<textarea name="text" id="text" cols="40" rows="14" tabindex="1"
				          maxlength="<?=SIZE_TEXT?>" required placeholder="Type your message here…"
				><?=$FORM['TEXT']?></textarea>
			</div>
		</p>
		
		</div>
		
		<p id="psubmit"><label for="submit">Submit
			<input id="submit" name="submit" type="image" src="/themes/<?=FORUM_THEME?>/icons/submit.png"
			       width="40" height="40" tabindex="4" value="&gt;" />
		</label></p>
<?php else: ?>
		<p id="error">Sorry, posting is currently disabled.</p>
<?php endif; ?>
	</form>
</section>
<!-- =================================================================================================================== -->
<section id="post">
	<h1 id="<?=$POST['ID']?>"><?=$POST['TITLE']?></h1>
	
	<article>
		<header>
			<time datetime="<?=$POST['DATETIME']?>" pubdate><?=$POST['TIME']?></time>
			<b<?=$POST['MOD']?' class="mod"':''?>><?=$POST['AUTHOR']?></b>
		</header>
		
		<?=$POST['TEXT']?>
	</article>
</section>
<!-- =================================================================================================================== -->
<div id="mods">
<?php if (!empty ($MODS['LOCAL'])): ?>
<p>
	Moderators for this sub-forum:
	<b class="mod"><?=implode ('</b>, <b class="mod">', array_map ('safeHTML', $MODS['LOCAL']))?></b>
</p>
<?php endif; ?>
<?php if (!empty ($MODS['GLOBAL'])): ?>
<p>
	Your friendly neighbourhood moderators:
	<b class="mod"><?=implode ('</b>, <b class="mod">', array_map ('safeHTML', $MODS['GLOBAL']))?></b>
</p>
<?php endif; ?>
</div>
<footer><p>
	Powered by <a href="http://camendesign.com/nononsense_forum">NoNonsense Forum</a><br />
	© Kroc Camen of <a href="http://camendesign.com">Camen Design</a>
</p></footer>
<div id="grid"></div>
<script>
//in iOS tapping a label doesn't click the related input element, we'll add this back in using JavaScript
if (document.getElementsByTagName !== undefined) {
	var labels = document.getElementsByTagName ("label");
	for (i=0; i<labels.length; i++) if (labels[i].getAttribute ("for")) labels[i].onclick = function (){
		document.getElementById (this.getAttribute ("for")).click ();
	}
}
</script>
<!-- page generated in: <?=round (microtime (true) - START, 3)?>s -->
</body>
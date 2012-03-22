<?php //just display the markup documentation
/* ====================================================================================================================== */
/* NoNonsense Forum v18 © Copyright (CC-BY) Kroc Camen 2012
   licenced under Creative Commons Attribution 3.0 <creativecommons.org/licenses/by/3.0/deed.en_GB>
   you may do whatever you want to this code as long as you give credit to Kroc Camen, <camendesign.com>
*/

//bootstrap the forum; you should read that file first
require_once './start.php';

$template = prepareTemplate (
	FORUM_ROOT.'/themes/'.FORUM_THEME.'/markup.html',
	'Markup'
);

theme_custom ($template);
die ($template->html ());

?>
<?php 
get_header(); 

//$page = strtok(basename($_SERVER["REQUEST_URI"]),'?');
$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
#var_dump(dirname($uri_parts[0]));die;
if(dirname($uri_parts[0])!="/") {
	$page = explode("/", dirname($uri_parts[0]));
	$page = $page[1];
} else {
	$page = basename($uri_parts[0]);
}
#var_dump($uri_parts);die;
#$urlParts = explode("/", $_SERVER['REQUEST_URI']);
#$rpage = explode("/", $page);
#if(isset($rpage[0]))
#$page = $rpage[0];
#echo $page;die;
$pages = array("focar", "calendar", "ranking", "produtividade", "inicio", "stats", "csv", "metas", "premios", "game", "1invite", "ticket", "product");
#var_dump($uri_parts);die;
#global $user_prefered_language;
#var_dump($user_prefered_language);die;
#if($user_prefered_language=="" || $user_prefered_language=="en")
#$user_prefered_language=="en_US";
var_dump($user_prefered_language);die;
if(!in_array($page, $pages)) {
	
	#if($user_prefered_language=="pt_BR" || $user_prefered_language=="pt")
		#$page = "inicio";
	#else
		$page = "index";
} else {
	if (!is_user_logged_in()) {
		if($page!="plugins-br" && $page!="product")
		$page = "closed";
	} else {
		if($page=="focar") {
			wp_enqueue_script("sound-js");
			wp_enqueue_script("pomodoros-js");
			#wp_enqueue_script("projectimer-pomodoros-shared-parts-js");
			wp_enqueue_script("rangeslider-js");
		}
	}
}

#echo "INDEX p".$page;die;
locate_template( "part-".$page.".php", true );

get_footer();
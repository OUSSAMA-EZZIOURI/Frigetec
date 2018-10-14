<?php
//require_once 'bootstrap.php';
error_reporting(E_ALL | E_STRICT);

// define constants
define('PROJECT_DIR', realpath('./'));
define('LOCALE_DIR', PROJECT_DIR .'/locale');
define('DEFAULT_LOCALE', 'de_DE');

require_once('libs/gettext.inc');

$supported_locales = array('de_DE', 'fr_FR', 'en_EN');
$encoding = 'UTF-8';

$locale = (isset($_GET['lang']))? $_GET['lang'] : DEFAULT_LOCALE;
define('LANG', $locale);
define('LOCAL', $locale );
// gettext setup
T_setlocale(LC_MESSAGES, $locale);
// Set the text domain as 'messages'
$domain = 'messages';
T_bindtextdomain($domain, LOCALE_DIR);
T_bind_textdomain_codeset($domain, $encoding);
T_textdomain($domain);

header("Content-type: text/html; charset=$encoding");
/*
if (!function_exists("gettext")|| !function_exists("_")){
    echo "gettext is not installed\n";
}else{
	echo "gettext is installed\n";
}*/

$TITLE = APP::SITE_TITLE(false);

class URL{
	
	const SITE_URL= "http://www.riad-thami.de/";
	const CSS_FOLDER = "css";
	const CSS_PATH = "css/";
	const JS_FOLDER = "js";
	const JS_PATH = "js/";
	const IMG_FOLDER = "images";
	const IMG_PATH = "images/";
	const GALLERY_FOLDER = "images/gallery";
	const GALLERY_PATH = "images/gallery/";
	const FONT_FOLDER = "font";
	const FONT_PATH = "font/";
	
	
	public static function SITE_URL($display=True)
	{
		if ($display) echo self::SITE_URL; else return self::SITE_URL;
	}
	public static function PAGE_NAME($display=True)
	{
		$res = explode(".php", basename($_SERVER['PHP_SELF']));		
		if ($display) echo $res[0]; else return $res[0];
	}
	public static function CSS_PATH($display=True)
	{
		if ($display) echo self::CSS_PATH; else return self::CSS_PATH;
	}
	public static function CSS_FOLDER($display=True)
	{
		if ($display) echo self::CSS_FOLDER; else return self::CSS_FOLDER;
	}
	public static function JS_PATH($display=True)
	{
		if ($display) echo self::JS_PATH; else return self::JS_PATH;
	}
	public static function JS_FOLDER($display=True)
	{
		if ($display) echo self::JS_FOLDER; else return self::JS_FOLDER;
	}
	public static function IMG_PATH($display=True)
	{
		if ($display) echo self::IMG_PATH; else return self::IMG_PATH;
	}
	public static function IMG_FOLDER($display=True)
	{
		if ($display) echo self::IMG_FOLDER; else return self::IMG_FOLDER;
	}
	//Gallery
	public static function GALLERY_PATH($display=True)
	{
		if ($display) echo self::GALLERY_PATH; else return self::GALLERY_PATH;
	}
	public static function GALLERY_FOLDER($display=True)
	{
		if ($display) echo self::GALLERY_FOLDER; else return self::GALLERY_FOLDER;
	}
	//Font
	public static function FONT_PATH($display=True)
	{
		if ($display)  echo self::FONT_PATH; else return self::FONT_PATH;
	}
	public static function FONT_FOLDER($display=True)
	{
		if ($display) echo self::FONT_FOLDER; else return self::FONT_FOLDER;
	}
}

class APP{
	
	const AUTHOR = "<a href='https://www.linkedin.com/pub/oussama-ezziouri/61/14/204' style='color:white;' target='_blank'>EZZIOURI Oussama</a>";
	const NAME = "Riad Thami";
	//TITLE_FR = "Riad Marrakech pas cher, voyage maroc, réservation riad marrakech en ligne : Riad Thami"
	const SITE_TITLE = "Riad Thami";
	const TITLE = "Riad Thami - Riad Marrakech billig, Reisen Marokko, Online-Buchung Riad Marrakech: Riad Thami";
	//KEYWORDS_FR = "Maison d'hôtes Marrakech, Week-end à Marrakech, Vacances à Marrakech, Riad pas cher à Marrakech , Séjour riad à Marrakech, riad marrakech, riad medina marrakech, ryad marrakech, riad thami"
	const KEYWORDS = "Gästehaus Marrakesch Wochenende in Marrakesch, Urlaub in Marrakesch, Marrakesch Riad billig, Wohnzimmer Riad in Marrakesch, Marrakesch Riad Riad Medina von Marrakesch, Riad Marrakech, Riad thami, Maison d'hôtes Marrakech, Week-end à Marrakech, Vacances à Marrakech, Riad pas cher à Marrakech , Séjour riad à Marrakech, riad marrakech, riad medina marrakech, ryad marrakech, riad thami";
	//DESCRIPTION_FR = "Riad Thami est un riad Marrakech authentique et un riad pas cher à Marrakech.Vous apprécierez le calme du riad et découvrirez la magie de Marrakech"
	const DESCRIPTION = "Riad Thami. ein Riad in Marrakesch authentisch und billig Riad in Marrakesch. Genießen Sie die Ruhe des Riad und entdecken Sie die Magie von Marrakesch";
	const WEBMASTER_MAIL = "nassiri1994@gmx.de";
	const CONTACT_MAIL = "nassiri1994@gmx.de";
	/*const CONTACT_MAIL = "ezziouri.oussama.iga@gmail.com";
	const WEBMASTER_MAIL = "ezziouri.oussama.iga@gmail.com";*/
	const ADDRESS1 = " 134 Derb Ahl Souss <br /> Berrima";
	const ADDRESS2 = " 40000 Marrakech <br /> Marokko";
	const PHONE1 = "00212 613286574";  
	const PHONE2 = "0049 1602456719";
	const SMTP = "ns0.ovh.net";
	const SMTP_USER = "info@riad-thami.de";
	const SMTP_PASS = "infop@ssw0rd2016";
	
	public static function ADDRESS1($display=True)
	{
		if ($display) echo self::ADDRESS1; else return self::ADDRESS1;
	}
	public static function ADDRESS2($display=True)
	{
		if ($display) echo self::ADDRESS2; else return self::ADDRESS2;
	}
	public static function SMTP($display=True)
	{
		if ($display) echo self::SMTP; else return self::SMTP;
	}
	public static function PHONE1($display=True)
	{
		if ($display) echo self::PHONE1; else return self::PHONE1;
	}
	public static function PHONE2($display=True)
	{
		if ($display) echo self::PHONE2; else return self::PHONE2;
	}
	public static function SMTP_PASS($display=True)
	{
		if ($display) echo self::SMTP_PASS; else return self::SMTP_PASS;
	}
	public static function SMTP_USER($display=True)
	{
		if ($display) echo self::SMTP_USER; else return self::SMTP_USER;
	}
	public static function CONTACT_MAIL($display=True)
	{
		if ($display) echo self::CONTACT_MAIL; else return self::CONTACT_MAIL;
	}
	public static function WEBMASTER_MAIL($display=True)
	{
		if ($display) echo self::WEBMASTER_MAIL; else return self::WEBMASTER_MAIL;
	}
	public static function AUTHOR($display=True)
	{
		if ($display) echo self::AUTHOR; else return self::AUTHOR;
	}
	public static function NAME($display=True)
	{
		if ($display) echo self::NAME; else return self::NAME;
	}
	public static function TITLE($display=True)
	{
		if ($display) echo self::TITLE; else return self::TITLE;
	}
	public static function SITE_TITLE($display=True)
	{
		if ($display) echo self::SITE_TITLE; else return self::SITE_TITLE;
	}
	public static function KEYWORDS($display=True)
	{
		if ($display) echo self::KEYWORDS; else return self::KEYWORDS;
	}
	public static function DESCRIPTION($display=True)
	{
		$desc = sprintf(T_(self::DESCRIPTION), self::TITLE);
		if ($display) echo $desc; else return $desc;
	}
	
}

?>
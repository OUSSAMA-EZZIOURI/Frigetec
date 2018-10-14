(function() {
	function addEventListener(element, event, handler) {
		if (element.addEventListener) {
			element.addEventListener(event, handler, false);
		} else if (element.attachEvent) {
			element.attachEvent('on' + event, handler);
		}
	}

	function maybePrefixUrlField() {
		if (this.value.trim() !== '' && this.value.indexOf('http') !== 0) {
			this.value = "http://" + this.value;
		}
	}

	var urlFields = document.querySelectorAll('.mc4wp-form input[type="url"]');
	if (urlFields && urlFields.length > 0) {
		for (var j = 0; j < urlFields.length; j++) {
			addEventListener(urlFields[j], 'blur', maybePrefixUrlField);
		}
	} /* test if browser supports date fields */
	var testInput = document.createElement('input');
	testInput.setAttribute('type', 'date');
	if (testInput.type !== 'date') {

		/* add placeholder & pattern to all date fields */
		var dateFields = document.querySelectorAll('.mc4wp-form input[type="date"]');
		for (var i = 0; i < dateFields.length; i++) {
			if (!dateFields[i].placeholder) {
				dateFields[i].placeholder = 'YYYY-MM-DD';
			}
			if (!dateFields[i].pattern) {
				dateFields[i].pattern = '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])';
			}
		}
	}

	if (!window.mc4wp) {
		window.mc4wp = {
			listeners: [],
			forms: {
				on: function(event, callback) {
					window.mc4wp.listeners.push({
						event: event,
						callback: callback
					});
				}
			}
		}
	}

	function revslider_showDoubleJqueryError(sliderID) {
		var errorMessage = "Revolution Slider Error: You have some jquery.js library include that comes after the revolution files js include.";
		errorMessage += "<br> This includes make eliminates the revolution slider libraries, and make it not work.";
		errorMessage += "<br><br> To fix it you can:<br>&nbsp;&nbsp;&nbsp; 1. In the Slider Settings -> Troubleshooting set option:  <strong><b>Put JS Includes To Body</b></strong> option to true.";
		errorMessage += "<br>&nbsp;&nbsp;&nbsp; 2. Find the double jquery.js include and remove it.";
		errorMessage = "<span style='font-size:16px;color:#BC0C06;'>" + errorMessage + "</span>";
		jQuery(sliderID).show().html(errorMessage);
	}


})();
/* <![CDATA[ */
var booked_js_vars = {
	"ajax_url": "http:\/\/airsupply.themerex.net\/wp-admin\/admin-ajax.php",
	"profilePage": "",
	"publicAppointments": "",
	"i18n_confirm_appt_delete": "Are you sure you want to cancel this appointment?",
	"i18n_please_wait": "Please wait ...",
	"i18n_wrong_username_pass": "Wrong username\/password combination.",
	"i18n_fill_out_required_fields": "Please fill out all required fields.",
	"i18n_guest_appt_required_fields": "Please enter your name to book an appointment.",
	"i18n_appt_required_fields": "Please enter your name, your email address and choose a password to book an appointment."
};
/* ]]> */
/* <![CDATA[ */
var _wpcf7 = {
	"loaderUrl": "http:\/\/airsupply.themerex.net\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif",
	"recaptcha": {
		"messages": {
			"empty": "Please verify that you are not a robot."
		}
	},
	"sending": "Sending ..."
};
/* ]]> */
/* <![CDATA[ */
var AIRSUPPLY_STORAGE = {
	"system_message": {
		"message": "",
		"status": "",
		"header": ""
	},
	"theme_font": "encode_sans",
	"theme_color": "#0a1f54",
	"theme_bg_color": "#ffffff",
	"strings": {
		"ajax_error": "Invalid server answer",
		"bookmark_add": "Add the bookmark",
		"bookmark_added": "Current page has been successfully added to the bookmarks. You can see it in the right panel on the tab &#039;Bookmarks&#039;",
		"bookmark_del": "Delete this bookmark",
		"bookmark_title": "Enter bookmark title",
		"bookmark_exists": "Current page already exists in the bookmarks list",
		"search_error": "Error occurs in AJAX search! Please, type your query and press search icon for the traditional search way.",
		"email_confirm": "On the e-mail address &quot;%s&quot; we sent a confirmation email. Please, open it and click on the link.",
		"reviews_vote": "Thanks for your vote! New average rating is:",
		"reviews_error": "Error saving your vote! Please, try again later.",
		"error_like": "Error saving your like! Please, try again later.",
		"error_global": "Global error text",
		"name_empty": "The name can&#039;t be empty",
		"name_long": "Too long name",
		"email_empty": "Too short (or empty) email address",
		"email_long": "Too long email address",
		"email_not_valid": "Invalid email address",
		"subject_empty": "The subject can&#039;t be empty",
		"subject_long": "Too long subject",
		"text_empty": "The message text can&#039;t be empty",
		"text_long": "Too long message text",
		"send_complete": "Send message complete!",
		"send_error": "Transmit failed!",
		"geocode_error": "Geocode was not successful for the following reason:",
		"googlemap_not_avail": "Google map API not available!",
		"editor_save_success": "Post content saved!",
		"editor_save_error": "Error saving post data!",
		"editor_delete_post": "You really want to delete the current post?",
		"editor_delete_post_header": "Delete post",
		"editor_delete_success": "Post deleted!",
		"editor_delete_error": "Error deleting post!",
		"editor_caption_cancel": "Cancel",
		"editor_caption_close": "Close"
	},
	"ajax_url": "http:\/\/airsupply.themerex.net\/wp-admin\/admin-ajax.php",
	"ajax_nonce": "26e39b166a",
	"site_url": "http:\/\/airsupply.themerex.net",
	"site_protocol": "http",
	"vc_edit_mode": "",
	"accent1_color": "#11224d",
	"accent1_hover": "#e5631b",
	"slider_height": "100",
	"user_logged_in": "",
	"toc_menu": "float",
	"toc_menu_home": "1",
	"toc_menu_top": "1",
	"menu_fixed": "1",
	"menu_mobile": "1024",
	"menu_hover": "fade",
	"button_hover": "fade",
	"input_hover": "iconed",
	"demo_time": "0",
	"media_elements_enabled": "1",
	"ajax_search_enabled": "1",
	"ajax_search_min_length": "3",
	"ajax_search_delay": "200",
	"css_animation": "1",
	"menu_animation_in": "bounceIn",
	"menu_animation_out": "fadeOutDown",
	"popup_engine": "magnific",
	"email_mask": "^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$",
	"contacts_maxlength": "1000",
	"comments_maxlength": "1000",
	"remember_visitors_settings": "",
	"admin_mode": "",
	"isotope_resize_delta": "0.3",
	"error_message_box": null,
	"viewmore_busy": "",
	"video_resize_inited": "",
	"top_panel_height": "0"
};
/* ]]> */
/* <![CDATA[ */
var mejsL10n = {
	"language": "en-US",
	"strings": {
		"Close": "Close",
		"Fullscreen": "Fullscreen",
		"Turn off Fullscreen": "Turn off Fullscreen",
		"Go Fullscreen": "Go Fullscreen",
		"Download File": "Download File",
		"Download Video": "Download Video",
		"Play": "Play",
		"Pause": "Pause",
		"Captions\/Subtitles": "Captions\/Subtitles",
		"None": "None",
		"Time Slider": "Time Slider",
		"Skip back %1 seconds": "Skip back %1 seconds",
		"Video Player": "Video Player",
		"Audio Player": "Audio Player",
		"Volume Slider": "Volume Slider",
		"Mute Toggle": "Mute Toggle",
		"Unmute": "Unmute",
		"Mute": "Mute",
		"Use Up\/Down Arrow keys to increase or decrease volume.": "Use Up\/Down Arrow keys to increase or decrease volume.",
		"Use Left\/Right Arrow keys to advance one second, Up\/Down arrows to advance ten seconds.": "Use Left\/Right Arrow keys to advance one second, Up\/Down arrows to advance ten seconds."
	}
};
var _wpmejsSettings = {
	"pluginPath": "\/wp-includes\/js\/mediaelement\/"
};
/* ]]> */
/* <![CDATA[ */
var mc4wp_forms_config = [];
/* ]]> */

var htmlDivCss = unescape(
	".persephone.tparrows%20%7B%0A%09cursor%3Apointer%3B%0A%09background%3Argba%28201%2C201%2C201%2C0.75%29%3B%0A%09width%3A40px%3B%0A%09height%3A40px%3B%0A%09position%3Aabsolute%3B%0A%09display%3Ablock%3B%0A%09z-index%3A100%3B%0A%20%20%20%20border%3A1px%20solid%20rgba%28255%2C%20255%2C%20255%2C%201%29%3B%0A%7D%0A.persephone.tparrows%3Ahover%20%7B%0A%09background%3Argba%280%2C%200%2C%200%2C%201%29%3B%0A%7D%0A.persephone.tparrows%3Abefore%20%7B%0A%09font-family%3A%20%22revicons%22%3B%0A%09font-size%3A15px%3B%0A%09color%3A%20rgb%28255%2C%20255%2C%20255%29%3B%0A%09display%3Ablock%3B%0A%09line-height%3A%2040px%3B%0A%09text-align%3A%20center%3B%0A%7D%0A.persephone.tparrows.tp-leftarrow%3Abefore%20%7B%0A%09content%3A%20%22%5Ce824%22%3B%0A%7D%0A.persephone.tparrows.tp-rightarrow%3Abefore%20%7B%0A%09content%3A%20%22%5Ce825%0A%22%3B%0A%7D%0A%0A%0A"
);
var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
if (htmlDiv) {
	htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
} else {
	var htmlDiv = document.createElement('div');
	htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
	document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
}

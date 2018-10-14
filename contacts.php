<?php
error_reporting(-1);

//require_once (__DIR__.'/libs/class.phpmailer.php');
require __DIR__.'/libs/PHPMailerAutoload.php';
$er = "";
$success = "";

// Check if the web form has been submitted
if (isset($_POST["contact_form"])){

	/*
	 * Process the web form variables
	 * Strip out any malicious attempts at code injection, just to be safe.
	 * All that is stored is safe html entities of code that might be submitted.
	 */
	$contactName = htmlentities(substr($_POST["name"], 0, 100), ENT_QUOTES);
	$contactEmail = htmlentities(substr($_POST["email"], 0, 100), ENT_QUOTES);	
	$messageContent = htmlentities(substr($_POST["message"], 0, 10000), ENT_QUOTES);
	
	/*
	 * Perform some logic on the form data
	 * If the form data has been entered incorrectly, return an Error Message
	 */

	 // Check if the data entered for the E-mail is formatted like an E-mail should be
	if (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
		//Please enter a valid e-mail address.
		$er .= 'S\'il vous plaît entrer une adresse e-mail valide.<br />';
	}

	// Check if all of the form fields contain data before we allow it to be submitted successfully
	if ($contactName == "" || $contactEmail == "" ||  $messageContent == ""){
		//Your Name, E-mail, Message Subject, and Message Content cannot be left blank.<br />
		$er .= "Votre nom, e-mail et le message ne peut pas être vide. <br />";
	}
	
	// IF NO ERROR - START
	if ($er == ''){

		// Prepare the E-mail elements to be sent
		try {
			$mail = new PHPMailer(true); //New instance, with exceptions enabled
			// : A Contact Message
			$message =
					'<html>
						<head>
						<title>Figetec Maroc - Formulaire contact</title>
						</head>
						.<body>
						' . wordwrap($messageContent, 100) . '
						</body>
					</html>';
			$message             = preg_replace('/\\\\/','', $message); //Strip backslashes
		
			
			/*
			$mail->IsSMTP();                           // tell the class to use SMTP
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = 'ssl';
			$mail->Port       = 465;
			$mail->Host       = "ns0.ovh.net"; // SMTP server
			$mail->Username = "formulaire-contact@frigetecmaroc.com";              // SMTP username
			$mail->Password = "frigetec2017";              // SMTP password
			*/
			//$mail->IsMail();                         // tell the class to use SMTP
			$mail->IsSMTP();                           // tell the class to use SMTP
			//$mail->SMTPDebug   = 3;       			
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";
			$mail->Port       = 465;
			$mail->Host       = "ssl0.ovh.net"; // SMTP server			
			$mail->Username = "formulaire-contact@frigetecmaroc.com";              // SMTP username
			$mail->Password = "frigetec2017";              // SMTP password

			//$mail->IsSendmail();  // tell the class to use Sendmail
			$mail->ReturnPath = $contactName . ' <' . $contactEmail . '>';
			$mail->AddReplyTo($contactEmail,$contactName);
		    $mail->Sender = $contactEmail;
			$mail->From       = $contactEmail;
			$mail->FromName   = $contactName . ' <' . $contactEmail . '>';
		
			// Ca doit être nassiri1994
			$to = "oussama.ezziouri@gmail.com";
		
			$mail->AddAddress($to);
		
			$mail->Subject  = 'Frigetec Maroc - Formulaire contact';
			//To view the message, please use an HTML compatible email viewer!
			$mail->AltBody    = "Pour voir le message, s'il vous plaît utiliser une visionneuse e-mail compatible HTML!"; // optional, comment out and test
			$mail->WordWrap   = 80; // set word wrap
		
			$mail->MsgHTML($message);
		
			$mail->IsHTML(true); // send as HTML
		
			$mail->Send();			
			//Thank you for contacting . We will read your message and contact you if necessary.
			$success = "Nous nous réjouissons de votre demande!";
			$success .= '<br /><br />';
			$success .= "Votre message a été envoyé, nous prendrons contact avec vous dans le plus bref délais.";
			$success .= '<br /><br />';
			$success .= "Si vous avez des questions, merci de nous contacter.";
			$success .= '<br /><br />';
			$success .= '<b>Téléphone : 06 61 96 42 80</b>'; 				
		} catch (phpmailerException $e) {
			//echo $e->errorMessage();
			//We weren't able to send your message. Please contact 
			$er .= $e->errorMessage() .'</br>';
			$er .= "Nous ne pouvons pas envoyer le message. S'il vous plaît contacter " . $to . '.<br />';
		}
	}
	// IF NO ERROR - END
}
			

?>

<!DOCTYPE html>
<html lang="en-US" class="scheme_original">
<head>
	<title>Frigetec Maroc &#8211;Travaux Divers</title>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no"><link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />
	<link rel='dns-prefetch' href='http://use.fontawesome.com/' />
	<link rel='dns-prefetch' href='http://fonts.googleapis.com/' />
	<link href="https://fonts.googleapis.com/css?family=Abril+Fatface%7CDroid+Serif:400,700%7COpen+Sans:300,400,600,700,800%7CRaleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
	<link property="stylesheet" rel='stylesheet' id='airsupply-font-encode_sans-style-css' href='css/font-face/encode_sans/stylesheet.css' type='text/css' media='all' />
	<link property="stylesheet" rel='stylesheet' id='airsupply-fontello-style-css' href='css/fontello/css/fontello.css' type='text/css' media='all' />
	<link property="stylesheet" rel='stylesheet' id='airsupply-main-style-css' href='css/style.css' type='text/css' media='all' />
	<link property="stylesheet" rel='stylesheet' id='global' href='css/global.css' type='text/css' media='all' />
	<link property="stylesheet" rel='stylesheet' id='airsupply-animation-style-css' href='js/vendor/fw/css/core.animation.css' type='text/css' media='all' />
	<link property="stylesheet" rel='stylesheet' id='airsupply-shortcodes-style-css' href='js/vendor/shortcodes/theme.shortcodes.css' type='text/css' media='all' />
	<link property="stylesheet" rel='stylesheet' id='airsupply-responsive-style-css' href='css/responsive.css' type='text/css' media='all' />
</head>
<body class="body_filled page page-template-default airsupply_body scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide">
	<a id="toc_home" class="sc_anchor" title="Accueil" data-description="&lt;i&gt;Return to Accueil&lt;/i&gt; - &lt;br&gt;navigate to home page of the site" data-icon="icon-home" data-separator="yes"></a>
	<a id="toc_top" class="sc_anchor" title="To Top" data-description="&lt;i&gt;Back to top&lt;/i&gt; - &lt;br&gt;scroll to top of the page" data-icon="icon-double-up" data-url="" data-separator="yes"></a>
	<div class="body_wrap">
		<div class="page_wrap">
			<div class="top_panel_fixed_wrap"></div>
			<header class="top_panel_wrap top_panel_style_1 scheme_original">
				<div class="top_panel_wrap_inner top_panel_inner_style_1 top_panel_position_above">
					<div class="top_panel_middle">
						<div class="content_wrap">
							<div class="columns_wrap columns_fluid no_margins">
								<div class="column-1_3 contact_logo">
									<div class="logo">
										<a href="index.html"><img src="images/logo-header.png" class="logo_main" alt="" width="246" height="52"></a>
									</div>
								</div>
								<div class="contact_information column-2_3">
									<div class="columns_wrap columns_fluid no_margins">
										<div class="contact_field contact_phone column-1_3">
											<span class="contact_icon icon-phone-call"></span>
											<span class="contact_label contact_phone">Contactez-nous</span>
											<span class="contact_email">0661 964 280</span>
										</div>
										<div class="contact_field open_hours column-1_3">
											<span class="contact_icon icon-clock-1"></span>
											<span class="contact_label open_hours_label">Horaire de travail</span>
											<span class="open_hours_time">8.00-18.00</span>
										</div>
										<div class="contact_field contact_address column-1_3">
											<span class="contact_icon icon-pin-1"></span>
											<span class="contact_label contact_address_1">202, Bd Abdelmoumene</span>
											<span class="contact_address_2">RDC N° 5 Casablanca</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="top_panel_bottom">
						<div class="content_wrap clearfix">
							<nav class="menu_main_nav_area menu_hover_fade">
								<ul id="menu_main" class="menu_main_nav">
									<li class="menu-item"><a href="index.html"><span>Accueil</span></a></li>
									<li class="menu-item"><a href="gallery.html"><span>Gallerie</span></a></li>
									<li class="menu-item current-menu-item current-menu-ancestor current-menu-parent"><a href="contacts.php"><span>Contact</span></a></li>
								</ul>
							</nav>							
						</div>
					</div>

				</div>
			</header>

			<div class="header_mobile">
				<div class="content_wrap">
					<div class="menu_button icon-menu"></div>
					<div class="logo">
						<a href="index.html"><img src="images/logo-header.png" class="logo_main" alt="" width="246" height="52"></a>
					</div>
				</div>
				<div class="side_wrap">
					<div class="close">Fermer</div>
					<div class="panel_top">
						<nav class="menu_main_nav_area">
							<ul id="menu_mobile" class="menu_main_nav">
								<li class="menu-item"><a href="index.html"><span>Accueil</span></a></li>
								<li class="menu-item"><a href="gallery.html"><span>Gallerie</span></a></li>
								<li class="menu-item current-menu-item current-menu-ancestor current-menu-parent"><a href="contacts.php"><span>Contact</span></a></li>
							</ul>
						</nav>
					</div>

					<div class="panel_middle">
						<div class="contact_field contact_address">
							<span class="contact_icon icon-home"></span>
							<span class="contact_label contact_address_1">202, Bd Abdelmoumene</span>
							<span class="contact_address_2">RDC N° 5 Casablanca</span>
						</div>
						<div class="contact_field contact_phone">
							<span class="contact_icon icon-phone"></span>
							<span class="contact_label contact_phone">0661 964 280</span>
							<span class="contact_email">frigetecmaroc@gmail.com</span>
						</div>


						<div class="top_panel_top_user_area">
							<ul id="menu_user_mobile" class="menu_user_nav">

							</ul>

						</div>
					</div>

					<div class="panel_bottom">
					</div>
				</div>
				<div class="mask"></div>
			</div>
			<div class="top_panel_title top_panel_style_1  title_present breadcrumbs_present scheme_original">
				<div class="top_panel_title_inner top_panel_inner_style_1  title_present_inner breadcrumbs_present_inner">
					<div class="content_wrap">
						<h1 class="page_title">Contact</h1>
						<div class="breadcrumbs"><a class="breadcrumbs_item home" href="index.html">Accueil</a><span class="breadcrumbs_delimiter"></span><span class="breadcrumbs_item current">Contact</span></div>
					</div>
				</div>
			</div>

			<div class="page_content_wrap page_paddings_no">


				<div class="content_wrap">
					<div class="content">
						<div class="itemscope page hentry" itemscope itemtype="http://schema.org/Article">
							<div class="post_content" itemprop="articleBody">
								<div class="full-width">
									<div class="column">
										<div class="main-block">
											<div class="wrapper">
												<div class="h30"></div>
												<?php if($success != ''){ ?>
													<p class="success"><?php echo $success; ?></p>
												<?php }else if($er != ''){ ?>
													<p class="error"><?php echo $er; ?></p>
												<?php } ?>
												<div class="columns_wrap sc_columns columns_nofluid sc_columns_count_2 margin_top_huge margin_bottom_huge">
													<div class="column-1_2 sc_column_item sc_column_item_1 odd first">
														<div id="sc_googlemap_1829197282" class="sc_googlemap" data-zoom="16" data-style="default">
															<div id="sc_googlemap_1829197282_1" class="sc_googlemap_marker" data-title="U.S. Bank" data-description="&lt;div class=&quot;content_element&quot;&gt;&lt;div class=&quot;wrapper&quot;&gt;&lt;p&gt;&lt;strong&gt;U.S. Bank&lt;/strong&gt;&lt;br /&gt;A reliable bank with ancient traditions and friendly staff&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;" data-address="11 Madison Street, Oak Park, IL 60302" data-latlng="" data-point="images/map-marker.png">
																	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d207.77458307111584!2d-7.625614018109578!3d33.56913546554103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7d2b10f955555%3A0x8686902f10f3bba7!2sFrigetec+Maroc!5e0!3m2!1sfr!2s!4v1501015579665" width="485" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
															</div>	
														</div>
													</div>
													
													
													<div class="column-1_2 sc_column_item sc_column_item_2 even">
														<div class="sc_section sc_section_block margin_top_null margin_left_small alignleft">
															<div class="sc_section_inner">
																<h2 class="sc_section_title sc_item_title sc_item_title_without_descr">Localisez-nous</h2>
																<div class="sc_section_content_wrap">
																	<h5 class="sc_title sc_title_regular margin_top_small margin_bottom_null cerulean">Location:</h5>
																	<div class="content_element">
																		<div class="wrapper">
																			<p>202, Bd Abdelmoumene RDC N° 5 Casablanca</p>

																		</div>
																	</div>
																	<h5 class="sc_title sc_title_regular margin_top_small margin_bottom_null cerulean">Téléphone:</h5>
																	<div class="content_element">
																		<div class="wrapper">
																			<p>06 61 96 42 80</p>

																		</div>
																	</div>
																	<h5 class="sc_title sc_title_regular margin_top_small margin_bottom_null cerulean">E-mail:</h5>
																	<div class="content_element">
																		<div class="wrapper">
																			<p>frigetecmaroc@gmail.com</p>

																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="h35"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="block_1473078833951 scheme_dark">
									<div class="column">
										<div class="main-block">
											<div class="wrapper">
												<div class="sc_content content_wrap">
													<div class="h26"></div>
													<div class="sc_section sc_section_block margin_top_huge margin_bottom_huge aligncenter column-2_3">
														<div class="sc_section_inner">
															<div class="sc_section_content_wrap">
																<h1 class="block_heading">Envoyer un message</h1>
																<div id="sc_form_224916523_wrap" class="sc_form_wrap">
																	<div id="sc_form_224916523" class="sc_form sc_form_style_form_1 margin_top_medium contact_form_1">

<form id="sc_form_224916523_form" class="sc_input_hover_iconed contact_1" method="post" action="contacts.php" >
<div class="sc_form_info">
	<div class="sc_form_item sc_form_field label_over"><input id="contact_form_username" type="text" name="name" required aria-required="true"><label class="required" for="contact_form_username" ><i class="sc_form_label_icon icon-user"></i><span class="sc_form_label_content" data-content="Nom">Nom</span></label></div>
	<div class="sc_form_item sc_form_field label_over"><input id="contact_form_email" type="email" name="email" required aria-required="true"><label class="required" for="contact_form_email"><i class="sc_form_label_icon icon-mail-empty"></i><span class="sc_form_label_content" data-content="E-mail">E-mail</span></label></div>
</div>
<div class="sc_form_item contact_form_message"><textarea id="contact_form_message" name="message" required aria-required="true"></textarea><label class="required" for="contact_form_message"><i class="sc_form_label_icon icon-feather"></i><span class="sc_form_label_content" data-content="Message">Message</span></label></div>
<div class="sc_form_item sc_form_button"><button type="submit" name="contact_form" class="contact_form_submit">Envoyer le message</button></div>
<div class="result sc_infobox"></div>
																		</form>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="h30"></div>
												</div>
											</div>
										</div>
									</div>
								</div>


							</div>
						</div>
						<div class="related_wrap related_wrap_empty"></div>

					</div>
					<!-- </div> class="content"> -->
				</div>
				<!-- </div> class="content_wrap"> -->
			</div>
			<!-- </.page_content_wrap> -->

			
			<div class="block_1473346822144">
			<div class="column">
				<div class="main-block">
					<div class="wrapper">
						<div class="h25"></div>
						<div id="sc_clients_1304864647_wrap" class="sc_clients_wrap">
							<div id="sc_clients_1304864647" class="sc_clients sc_clients_style_clients-1  margin_top_medium margin_bottom_medium">
								<div class="sc_slider_swiper swiper-slider-container sc_slider_nopagination sc_slider_controls sc_slider_controls_side" data-interval="5342" data-slides-per-view="6" data-slides-min-width="100">
									<div class="slides swiper-wrapper">
										<div class="swiper-slide">
											<div id="sc_clients_1304864647_1" class="sc_clients_item sc_clients_item_1 odd first">
												<div class="sc_client_image"><img alt="Client1" src="images/client1.png"></div>
											</div>
										</div>
										<div class="swiper-slide">
											<div id="sc_clients_1304864647_2" class="sc_clients_item sc_clients_item_2 even">
												<div class="sc_client_image"><img alt="Client2" src="images/client2.png"></div>
											</div>
										</div>
										<div class="swiper-slide">
											<div id="sc_clients_1304864647_3" class="sc_clients_item sc_clients_item_3 odd">
												<div class="sc_client_image"><img alt="Client3" src="images/client3.png"></div>
											</div>
										</div>
										<div class="swiper-slide">
											<div id="sc_clients_1304864647_4" class="sc_clients_item sc_clients_item_4 even">
												<div class="sc_client_image"><img alt="Client4" src="images/client4.png"></div>
											</div>
										</div>
										<div class="swiper-slide">
											<div id="sc_clients_1304864647_5" class="sc_clients_item sc_clients_item_5 odd">
												<div class="sc_client_image"><img alt="Client5" src="images/client5.png"></div>
											</div>
										</div>
										<div class="swiper-slide">
											<div id="sc_clients_1304864647_6" class="sc_clients_item sc_clients_item_6 even">
												<div class="sc_client_image"><img alt="Client6" src="images/client6.png"></div>
											</div>
										</div>
									</div>
									<div class="sc_slider_controls_wrap">
										<a class="sc_slider_prev" href="#"></a>
										<a class="sc_slider_next" href="#"></a>
									</div>
									<div class="sc_slider_pagination_wrap"></div>
								</div>
							</div>
							<!-- /.sc_clients -->
						</div>
						<!-- /.sc_clients_wrap -->
						<div class="h20"></div>
					</div>
				</div>
			</div>
		</div>

			<!-- /.footer_wrap -->
			<footer class="footer_wrap widget_area scheme_dark">
				<div class="footer_wrap_inner widget_area_inner">
					<div class="content_wrap">
						<div class="columns_wrap">
							<aside id="airsupply_widget_socials-2" class="widget_number_1 column-1_4 widget widget_socials">
								<h5 class="widget_title">Rejoignez-nous sur facebook</h5>
								<div class="widget_inner">									
										<a href="https://www.facebook.com/frigetecmaroc/">
										<img alt="" class="widgets_logo_img" src="images/footer_img_fb.png">
										</a>
										<br />									
								</div>

							</aside>
							<aside id="nav_menu-2" class="widget_number_2 column-1_4 widget widget_nav_menu">
								<h5 class="widget_title">Services</h5>
								<div class="menu-widget-menu-container">
									<ul id="menu-widget-menu" class="menu">
										<li class="menu-item"><a href="#">Réparation des climatiseurs</a></li>
										<li class="menu-item"><a href="#">Réparation des appareils</a></li>
										<li class="menu-item"><a href="#">Préstations en électricité</a></li>
										<li class="menu-item"><a href="#">Réparation de chauffage</a></li>
										<li class="menu-item"><a href="#">Services de plomberie</a></li>
									</ul>
								</div>
							</aside>
							
							<aside id="nav_menu-3" class="widget_number_2 column-1_4 widget widget_nav_menu">
								<h5 class="widget_title">Téléphones</h5>
								<div class="menu-widget-menu-container">
								<ul id="menu-widget-menu" class="menu">
									<li class="menu-item"><a href="#">06 61 96 42 80</a></li>
									<li class="menu-item"><a href="#">06 60 32 98 02</a></li>
									<li class="menu-item"><a href="#">06 10 33 66 09</a></li>
								</ul>									
								</div>																	
							</aside>
							<aside id="text-2" class="widget_number_4 column-1_4 widget widget_text">
								<div class="textwidget">
									<h5 class="widget_title">Email</h5>									
									<div class="menu-widget-menu-container">
									<ul id="menu-widget-menu" class="menu">
										<li class="menu-item"><a href="#">frigetecmaroc@gmail.com</a></li>										
									</ul>									
									</div>									
									<h5>Adresse</h5>			
									<div class="menu-widget-menu-container">
									<ul id="menu-widget-menu" class="menu">
										<li class="menu-item"><a href="#">
											202, Bd Abdelmoumene, RDC N° 5 Casablanca, Maroc
										</a></li>										
									</ul>									
									</div>				
								</div>
							</aside>
						</div>
						<!-- /.columns_wrap -->
					</div>
					<!-- /.content_wrap -->
				</div>
				<!-- /.footer_wrap_inner -->
			</footer>
			<!-- /.footer_wrap -->
			<div class="copyright_wrap copyright_style_text  scheme_dark">
				<div class="copyright_wrap_inner">
					<div class="content_wrap">
						<div class="copyright_text">
							<p><a href="#">ThemeREX</a> © 2017 All Rights Reserved - Integrated by EZZIOURI Oussama</p>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- /.page_wrap -->
	</div>
	<!-- /.body_wrap -->
	<a href="#" class="scroll_to_top icon-up" title="Scroll to top"></a>
	<div class="custom_html_section"></div>
	<script type='text/javascript' src='js/vendor/jquery.js'></script>
	<script type='text/javascript' src='js/vendor/jquery-migrate.min.js'></script>
	<script type='text/javascript' src='js/vendor/fontawesome.js'></script>
	<script type='text/javascript' src='js/vendor/fw/js/superfish.js'></script>
	<script type='text/javascript' src='js/vendor/fw/js/core.utils.js'></script>
	<script type='text/javascript' src='js/vendor/fw/js/core.init.js'></script>
	<script type='text/javascript' src='js/custom/theme.init.js'></script>
	<script type='text/javascript' src='js/vendor/shortcodes/theme.shortcodes.js'></script>
	<!-- script type='text/javascript' src='http://maps.google.com/maps/api/js?rnd=1118803086'></script>-->
	<!-- script type='text/javascript' src='js/vendor/fw/js/core.googlemap.js'></script -->
	 
</body>
</html>




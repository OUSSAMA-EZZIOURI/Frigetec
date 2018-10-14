function airsupply_googlemap_init(dom_obj, coords) {
	"use strict";
	if (typeof AIRSUPPLY_STORAGE['googlemap_init_obj'] == 'undefined') airsupply_googlemap_init_styles();
	AIRSUPPLY_STORAGE['googlemap_init_obj'].geocoder = '';
	try {
		var id = dom_obj.id;
		AIRSUPPLY_STORAGE['googlemap_init_obj'][id] = {
			dom: dom_obj,
			markers: coords.markers,
			geocoder_request: false,
			opt: {
				zoom: coords.zoom,
				center: null,
				scrollwheel: false,
				scaleControl: false,
				disableDefaultUI: false,
				panControl: true,
				zoomControl: true, //zoom
				mapTypeControl: false,
				streetViewControl: false,
				overviewMapControl: false,
				styles: AIRSUPPLY_STORAGE['googlemap_styles'][coords.style ? coords.style : 'default'],
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
		};
		
		airsupply_googlemap_create(id);

	} catch (e) {
		
		dcl(AIRSUPPLY_STORAGE['strings']['googlemap_not_avail']);

	};
}

function airsupply_googlemap_create(id) {
	"use strict";

	// Create map
	AIRSUPPLY_STORAGE['googlemap_init_obj'][id].map = new google.maps.Map(AIRSUPPLY_STORAGE['googlemap_init_obj'][id].dom, AIRSUPPLY_STORAGE['googlemap_init_obj'][id].opt);

	// Add markers
	for (var i in AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers)
		AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].inited = false;
	airsupply_googlemap_add_markers(id);
	
	// Add resize listener
	jQuery(window).resize(function() {
		if (AIRSUPPLY_STORAGE['googlemap_init_obj'][id].map)
			AIRSUPPLY_STORAGE['googlemap_init_obj'][id].map.setCenter(AIRSUPPLY_STORAGE['googlemap_init_obj'][id].opt.center);
	});
}

function airsupply_googlemap_add_markers(id) {
	"use strict";
	for (var i in AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers) {
		
		if (AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].inited) continue;
		
		if (AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].latlng == '') {
			
			if (AIRSUPPLY_STORAGE['googlemap_init_obj'][id].geocoder_request!==false) continue;
			
			if (AIRSUPPLY_STORAGE['googlemap_init_obj'].geocoder == '') AIRSUPPLY_STORAGE['googlemap_init_obj'].geocoder = new google.maps.Geocoder();
			AIRSUPPLY_STORAGE['googlemap_init_obj'][id].geocoder_request = i;
			AIRSUPPLY_STORAGE['googlemap_init_obj'].geocoder.geocode({address: AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].address}, function(results, status) {
				"use strict";
				if (status == google.maps.GeocoderStatus.OK) {
					var idx = AIRSUPPLY_STORAGE['googlemap_init_obj'][id].geocoder_request;
					if (results[0].geometry.location.lat && results[0].geometry.location.lng) {
						AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[idx].latlng = '' + results[0].geometry.location.lat() + ',' + results[0].geometry.location.lng();
					} else {
						AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[idx].latlng = results[0].geometry.location.toString().replace(/\(\)/g, '');
					}
					AIRSUPPLY_STORAGE['googlemap_init_obj'][id].geocoder_request = false;
					setTimeout(function() { 
						airsupply_googlemap_add_markers(id); 
						}, 200);
				} else
					dcl(AIRSUPPLY_STORAGE['strings']['geocode_error'] + ' ' + status);
			});
		
		} else {
			
			// Prepare marker object
			var latlngStr = AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].latlng.split(',');
			var markerInit = {
				map: AIRSUPPLY_STORAGE['googlemap_init_obj'][id].map,
				position: new google.maps.LatLng(latlngStr[0], latlngStr[1]),
				clickable: AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].description!=''
			};
			if (AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].point) markerInit.icon = AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].point;
			if (AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].title) markerInit.title = AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].title;
			AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].marker = new google.maps.Marker(markerInit);
			
			// Set Map center
			if (AIRSUPPLY_STORAGE['googlemap_init_obj'][id].opt.center == null) {
				AIRSUPPLY_STORAGE['googlemap_init_obj'][id].opt.center = markerInit.position;
				AIRSUPPLY_STORAGE['googlemap_init_obj'][id].map.setCenter(AIRSUPPLY_STORAGE['googlemap_init_obj'][id].opt.center);				
			}
			
			// Add description window
			if (AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].description!='') {
				AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].infowindow = new google.maps.InfoWindow({
					content: AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].description
				});
				google.maps.event.addListener(AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].marker, "click", function(e) {
					var latlng = e.latLng.toString().replace("(", '').replace(")", "").replace(" ", "");
					for (var i in AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers) {
						if (latlng == AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].latlng) {
							AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].infowindow.open(
								AIRSUPPLY_STORAGE['googlemap_init_obj'][id].map,
								AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].marker
							);
							break;
						}
					}
				});
			}
			
			AIRSUPPLY_STORAGE['googlemap_init_obj'][id].markers[i].inited = true;
		}
	}
}

function airsupply_googlemap_refresh() {
	"use strict";
	for (id in AIRSUPPLY_STORAGE['googlemap_init_obj']) {
		airsupply_googlemap_create(id);
	}
}

function airsupply_googlemap_init_styles() {
	// Init Google map
	AIRSUPPLY_STORAGE['googlemap_init_obj'] = {};
	AIRSUPPLY_STORAGE['googlemap_styles'] = {
		'default': []
	};
	if (window.airsupply_theme_googlemap_styles!==undefined)
		AIRSUPPLY_STORAGE['googlemap_styles'] = airsupply_theme_googlemap_styles(AIRSUPPLY_STORAGE['googlemap_styles']);
}
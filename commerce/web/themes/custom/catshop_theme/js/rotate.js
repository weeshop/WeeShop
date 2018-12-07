(function ( $ ) {
	defOptions = {
		'source': 'img/',
		'ext' : '.jpg',
		'count' : 10,
		'speed': 10,
	},

	$.fn.rotate3d = function(options) {
		// Set options
		if (!options.source) options.source = defOptions.source;
		if (!options.ext) options.ext = defOptions.ext;
		if (!options.count) options.count = defOptions.count;
		if (!options.speed) options.speed = defOptions.speed;

		var clickPosition = null,
			currentIndex = 0,
			images = [],
			image = null;


		// Load images
		for (var i = 0; i <= options.count; ++i) {
			var img = new Image();
			img.src = options.source + i + options.ext;
			images.push(img);
		}

		// Move

		var moveHandler = function(e) {
			var offset = e.clientX - clickPosition;

			if (Math.abs(offset) > options.speed) {
				clickPosition = e.clientX;
				currentIndex = currentIndex + (1 * (offset / Math.abs(offset)));

				if(currentIndex >= options.count) currentIndex = 0;
				if(currentIndex < 0) currentIndex = options.count;

				image.attr('src', images[currentIndex].src);
			}
		}

		var upHandler = function(e){
			$(document).off('mousemove', moveHandler);
		}

		// Init
		$(this).on('drag', function () {
			return false;
		});

		$(this).on('dragdrop', function () {
			return false;
		});

		$(this).on('dragstart', function () {
			return false;
		});

		$(this)
			.append($('<img>').attr({'src': options.source + currentIndex + options.ext}))
			.find('img')
			.on('mousedown', function(e){
				clickPosition = e.clientX;
				$(document).on('mousemove', moveHandler);
			});

		image = $(this).find('img');

		$(document).on('mouseup', upHandler);
	}
}(jQuery));
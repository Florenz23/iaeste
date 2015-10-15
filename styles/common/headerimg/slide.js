(function() {
	'use strict';

	var DELAY = 10000,
		valid_image_indices;

	function fade(step) {
		var myTimeout;

		var img1 = document.getElementById("slideimg1");
		var img2 = document.getElementById("slideimg2");

		step = step || 0;

		img2.style.opacity = step/100.0;
		img2.style.filter = "alpha(opacity=" + step + ")";

		step = step + 2;

		if (step <= 100) {
			setTimeout(function () { fade(step); }, 30);
		} else {
			setTimeout(function () { slideHeadImg(); }, DELAY);
		}
	}

	function slideHeadImg() {
		var img1 = document.getElementById("slideimg1");
		var img2 = document.getElementById("slideimg2");

		var src = img2.src;
		img1.src = src;
		img2.style.opacity = 0.0;
		img2.style.filter = "alpha(opacity=0)";

		var n = valid_image_indices.length;
		var random_ix = Math.floor(Math.random()*n);
		var filename = valid_image_indices[random_ix] + ".jpg";
		img2.src = "styles/common/headerimg/"+filename;

		fade(0);
	}

	window.startSlide = function(valid_headerimg) {
		valid_image_indices = valid_headerimg;
		setTimeout(slideHeadImg, DELAY);
	};
}());
window.onload = function() {
	document.getElementById('hat1').addEventListener("click", function() {
		changeFrame('frame1');
	});
	document.getElementById('hat2').addEventListener("click", function() {
		changeFrame('frame2');
	});
	document.getElementById('hat3').addEventListener("click", function() {
		changeFrame('frame3');
	});
	// Grab elements, create settings, etc.
	var video = document.getElementById('video');

	// Get access to the camera!
	if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
	    // Not adding `{ audio: true }` since we only want video now
	    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
	        video.src = window.URL.createObjectURL(stream);
	        video.play();
	    });
	}
	
	// Elements for taking the snapshot
	var canvas = document.getElementById('canvas');
	var context = canvas.getContext('2d');
	var video = document.getElementById('video');
	var frame = document.getElementById('frame');

    document.getElementById("snap").addEventListener("click", function() {
        context.drawImage(video, 0, 0, 640, 480);
        frame_canvas = convertImageToCanvas(frame);
        context.drawImage(frame_canvas, 0, 0, 640, 480);
        new_image = convertCanvasToImage(canvas); // IMPORTANT! save this image to mysql
        // document.write('<img src="' + new_image.src + '"/>');
		new_image.onload = function() {    // Событие onLoad, ждём момента пока загрузится изображение
		var data, xhr;

	    data = new FormData();
	    data.append('image', new_image.src);

	    xhr = new XMLHttpRequest();

	    xhr.open('POST', 'saveimage.php', true);
	    xhr.send(data);
	    }
    });

	document.getElementById("upload").addEventListener("change", function(event) {
		// var output = document.getElementById("output");
		var output = new Image();
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function () {
		// img.src = "images/vft.jpg" // specifies the location of the image
        output_canvas = convertImageToCanvas(output);
		context.drawImage(output_canvas, 0, 0, 640, 480); // draws the image at the specified x and y location
        frame_canvas = convertImageToCanvas(frame);
        context.drawImage(frame_canvas, 0, 0, 640, 480);
        new_image = convertCanvasToImage(canvas); // IMPORTANT! save this image to mysql
        // document.write('<img src="' + new_image.src + '"/>');
		new_image.onload = function() {    // Событие onLoad, ждём момента пока загрузится изображение
	    	// console.log(new_image.src);
		var data, xhr;

	    data = new FormData();
	    data.append('image', new_image.src);

	    xhr = new XMLHttpRequest();

	    xhr.open('POST', 'saveimage.php', true);
	    xhr.send(data);
	    }
	}
	});
}


function changeFrame(frame) {
	document.getElementById('frame').src="img/" + frame + ".png";// Trigger photo take
}
// Converts image to canvas; returns new canvas element
function convertImageToCanvas(image) {
	var canvas = document.createElement("canvas");
	canvas.width = image.width;
	canvas.height = image.height;
	canvas.getContext("2d").drawImage(image, 0, 0);
	return canvas;
}

// Converts canvas to an image
function convertCanvasToImage(canvas) {
	var image = new Image();
	image.src = canvas.toDataURL("image/png");
	return image;
}
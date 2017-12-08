function ReaderImageDisplay(files, class_box, w) {	
	var reader = new FileReader();	
	w = (w) ? w: 100;
	console.log(w);
	reader.onload =  function(e) {	
		$('.'+ class_box).html('<img style="width:'+ w +'px;" class="img" src="'+ e.target.result +'"/>'); 
	};
	reader.readAsDataURL(files[0]);
}
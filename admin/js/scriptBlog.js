document.addEventListener('DOMContentLoaded', init);
function init(){
	var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementsByClassName('myImg');

var modalImg = document.getElementById("img01");

var captionText = document.getElementById("caption");

var h1et = document.getElementById("h1");

var mensajes = $("#mensajes");

var cajasMensa = $("#cajasMensa");

mensajes.onclick = function(params) {
	cajasMensa.innerHTML("");
}

for (var i = 0; i < img.length; i++) {
	img[i].onclick = function(){
		
		var idPropia = this.getAttribute('id');
			$("<input id='in' name='idPropio' type='hidden' value='"+idPropia+"'>").appendTo("#myModal");
			modal.style.display = "block";
			modalImg.src = this.src;
        captionText.innerHTML = this.alt;
				h1et.innerHTML = this.getAttribute("titulo");
				var inp = $("#in");
		if(inp.length >1){
			
			inp.remove();
		}
		
	}
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}

}

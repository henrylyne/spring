// On page load
window.onload = function(e){
	
	init = function() {
		// - make tag boxes clickable
		var elements = document.getElementsByClassName('tags');
	
		for(var i=0; i<elements.length; i++){
			var element = elements[i];
			elements[i].addEventListener("click", function(ele){return function(){highlightTag(ele)};}(element), false);
		}
	}

	// toggle on/off highlighting
	highlightTag = function(ele) {
		console.log(ele.id);
		var tagClass = "tag_"+ele.id
		
		setBackground(tagClass, '#5c5');
		if(this.lastTagClass) { setBackground(lastTagClass, '#ddd'); }
		//var elements = document.getElementsByClassName(tagClass);
	
		//for(var i=0; i<elements.length; i++){
		//	elements[i].setAttribute("style", "background-color: #5c5;");
		//}
		this.lastTagClass = tagClass
	};

	// set the background color fort all elements with a certain class
	setBackground = function(tagClass, color) {
		var elements = document.getElementsByClassName(tagClass);
	
		for(var i=0; i<elements.length; i++){
			elements[i].setAttribute("style", "background-color: "+color+";");
		}
	};
	
	init();
};	
// On page load
window.onload = function(e){
	var high_color = '#5c5';
	var lo_color = '#ddd';
	
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

		// turn off the previous highlight
		if(this.lastTagClass) {
			this.lastEle.setAttribute("style", "background-color: "+lo_color+";");
			setBackground(lastTagClass, lo_color);
		}

		// if a new choice turn on highlight
		if(tagClass != this.lastTagClass) {
			ele.setAttribute("style", "background-color: "+high_color+";");
			setBackground(tagClass, high_color);
		// clicked on the same tag again, then turn off highlighting for that tag
		} else {
			delete this.lastEle;
			delete this.lastTagClass;
			return;
		}

		// remember the last tag chosen
		this.lastEle = ele
		this.lastTagClass = tagClass
	};

	// set the background color for all elements with a certain class
	setBackground = function(tagClass, color) {
		var elements = document.getElementsByClassName(tagClass);
	
		for(var i=0; i<elements.length; i++){
			elements[i].setAttribute("style", "background-color: "+color+";");
		}
	};
	
	init();
};	
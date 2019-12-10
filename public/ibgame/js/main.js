function customeSelect() {
	var x, i, j, selElmnt, a, b, c;
	/* Look for any elements with the class "custom-select": */
	x = document.getElementsByClassName("custom-select");
	for (i = 0; i < x.length; i++) {
	  selElmnt = x[i].getElementsByTagName("select")[0];
	  /* For each element, create a new DIV that will act as the selected item: */
	  a = document.createElement("DIV");
	  a.setAttribute("class", "select-selected");
	  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
	  x[i].appendChild(a);
	  /* For each element, create a new DIV that will contain the option list: */
	  b = document.createElement("DIV");
	  b.setAttribute("class", "select-items select-hide");
	  for (j = 1; j < selElmnt.length; j++) {
	    /* For each option in the original select element,
	    create a new DIV that will act as an option item: */
	    c = document.createElement("DIV");
	    c.innerHTML = selElmnt.options[j].innerHTML;
	    c.addEventListener("click", function(e) {
	        /* When an item is clicked, update the original select box,
	        and the selected item: */
	        var y, i, k, s, h;
	        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
	        h = this.parentNode.previousSibling;
	        for (i = 0; i < s.length; i++) {
	          if (s.options[i].innerHTML == this.innerHTML) {
	            s.selectedIndex = i;
	            h.innerHTML = this.innerHTML;
	            y = this.parentNode.getElementsByClassName("same-as-selected");
	            for (k = 0; k < y.length; k++) {
	              y[k].removeAttribute("class");
	            }
	            this.setAttribute("class", "same-as-selected");
	            break;
	          }
	        }
	        h.click();
	    });
	    b.appendChild(c);
	  }
	  x[i].appendChild(b);
	  a.addEventListener("click", function(e) {
	    /* When the select box is clicked, close any other select boxes,
	    and open/close the current select box: */
	    e.stopPropagation();
	    closeAllSelect(this);
	    this.nextSibling.classList.toggle("select-hide");
	    this.classList.toggle("select-arrow-active");
	  });
	}

	function closeAllSelect(elmnt) {
	  /* A function that will close all select boxes in the document,
	  except the current select box: */
	  var x, y, i, arrNo = [];
	  x = document.getElementsByClassName("select-items");
	  y = document.getElementsByClassName("select-selected");
	  for (i = 0; i < y.length; i++) {
	    if (elmnt == y[i]) {
	      arrNo.push(i)
	    } else {
	      y[i].classList.remove("select-arrow-active");
	    }
	  }
	  for (i = 0; i < x.length; i++) {
	    if (arrNo.indexOf(i)) {
	      x[i].classList.add("select-hide");
	    }
	  }
	}

	/* If the user clicks anywhere outside the select box,
	then close all select boxes: */
	document.addEventListener("click", closeAllSelect);
}
customeSelect()

function loader() {
	var loaderDelete = setTimeout(function(e) {
		document.getElementsByClassName('loader')[0].style.display = 'none'
	}, 2500);
}
loader()

function timer() {
	var hours = parseInt(document.getElementsByClassName('timer-hours')[0].innerText);
	var mins = parseInt(document.getElementsByClassName('timer-mins')[0].innerText);
	var secs = parseInt(document.getElementsByClassName('timer-secs')[0].innerText);

	var timer = setInterval(function(){

		if (hours == 0 && mins <= 1) {
			document.getElementsByClassName('timer')[0].classList.add('last_minute')
			document.getElementsByClassName('time_alert').classList.remove('hidden')
		}
		if (hours == 0 && mins <= 0 && secs <= 15) {
			document.getElementsByClassName('timer')[0].classList.add('timesUp')
		}
		if ((hours <= 0 && mins <= 0 && secs <= 1)) {
			document.getElementsByClassName('timer-secs')[0].innerText = '00';
			return
		}

		secs--
		if (secs <= 0) {
			secs = 59;
			mins--
			if(mins <= 0) {
				mins = 59
				if (hours <= 0) {
					hours = 0;
				}
			}
		}	

		if (hours <= 9) {
			document.getElementsByClassName('timer-hours')[0].innerText = '0' +  hours
		}
		else {
			document.getElementsByClassName('timer-hours')[0].innerText = hours
		}
		if (mins <= 9) {
			document.getElementsByClassName('timer-mins')[0].innerText = '0' + mins
		}
		else {
			document.getElementsByClassName('timer-mins')[0].innerText = mins
		}

		if (secs <= 9) {
			document.getElementsByClassName('timer-secs')[0].innerText = '0' + secs
		}
		else {
			document.getElementsByClassName('timer-secs')[0].innerText = secs
		}

	},1000)
}

var overlay = document.getElementsByClassName('overlay')[0];

var trainingPassed = false;

function training() {
	var trainingsElement = [];
	var step = 1
    // Добавляем все элементы для обучения в массив
	for (var i = 0; i <= document.getElementsByClassName('item_wrap').length - 1; i++) {
		trainingsElement.push(document.getElementsByClassName('item_wrap')[i])
	}
 	
 	// Ищем нужный элемент для обучения
 	function activateElement(e) {
 		if (e.target.classList.contains('btn-training')) {
 			if (trainingsElement.length == step) {
 				localStorage.setItem('trainingPassed', 'true');
 				overlay.classList.add('hidden');
 				document.getElementsByClassName('item_wrap-active')[0].classList.remove('item_wrap-active')
 				timer()
 				return
 			}
 			else {
 				for (var i = 0; i <= trainingsElement.length -1; i++) {
 					trainingsElement[i].classList.remove('item_wrap-active')
 					if(trainingsElement[i].getAttribute('data-order') == step) {
 						trainingsElement[i].classList.add('item_wrap-active')
 					} 
 				}
 				step++
 			}
 		}
 	}

 	document.addEventListener('click', activateElement)
}

if (document.getElementsByClassName('item_wrap')[0]) {
	if (localStorage.getItem('trainingPassed') == false || localStorage.getItem('trainingPassed') == null) {
	 	training()
	 	console.log('начать обучение')
	} else {
		console.log('обучение уже пройдено')
		overlay.classList.add('hidden');
		document.getElementsByClassName('item_wrap-active')[0].classList.remove('item_wrap-active')
		timer()	
	}
}
function modalsControl(e){
	if (e.target.classList.contains('new_info_show')) {
		var modal = document.getElementsByClassName('new-info')[0];
		modal.classList.add('modal-active')
		overlay.classList.remove('hidden')
	}
	if (e.target.classList.contains('overlay') && document.getElementsByClassName('modal-active')[0] || e.target.classList.contains('modal_close')) {
		var modal = document.getElementsByClassName('modal-active')[0];
		modal.classList.remove('modal-active')
		overlay.classList.add('hidden')
	}
	if (e.target.classList.contains('alert_show')) {
		var modal = document.getElementsByClassName('alert')[0];
		modal.classList.add('modal-active')
		overlay.classList.remove('hidden')
	}
	if (e.target.classList.contains('form_show')) {
		var modal = document.getElementsByClassName('modal-form')[0];
		modal.classList.add('modal-active')
		overlay.classList.remove('hidden')
	}
	if (e.target.classList.contains('time_show')) {
		var modal = document.getElementsByClassName('time_alert')[0];
		modal.classList.remove('hidden')
	}
}

document.addEventListener('click', modalsControl)

function teamChoosing(e) {
	if (e.target.classList.contains('team_selector')) {
		for (var i = 0; i <= document.getElementsByClassName('team_selector').length - 1; i++){
			document.getElementsByClassName('team_selector')[i].parentNode.classList.remove('active')
		}
		e.target.parentNode.classList.add('active')
	}
}

document.addEventListener("change", teamChoosing)

function resultAnimation(){
	var circle = document.getElementsByClassName('circle_progress')[0];
	var radius = circle.r.baseVal.value; 
	var circumference = 2 * Math.PI * radius;

 	circle.style.strokeDasharray = `${circumference} ${circumference}`;
 	circle.style.strokeDashoffset = circumference;

	function setProgress(percent) {
		var offset = circumference - percent / 100 * circumference;
		circle.style.strokeDashoffset = offset;
	}

	var result = document.getElementsByClassName('result_value')[0].value;
	var n = 0;
	var number = document.getElementsByClassName('result_counter')[0];
	var animation = setInterval(function() {
		if(n >= result) {
			clearInterval(animation)
		}
		else {
			n++
			number.innerText = n + '%'
			setProgress(n)
		}
	},50) 

	
	// setProgress(10)
}

function handleFileSelect(evt) {
	if (evt.target.classList.contains('fileMulti')) {
		document.querySelector('.output_wrap').style.display = 'flex';
		var files = []
	    var file = evt.target.files; // FileList object
	    // Loop through the FileList and render image files as thumbnails.
	    for (var i = 0, f; f = file[i]; i++) {
	    	// Only process image files.
	    	if (!f.type.match('image.*')) {
	    	    var reader = new FileReader();
	    	    // Closure to capture the file information.
	    	    reader.onload = (function (theFile) {
	    	        return function (e) {
	    	            // Render thumbnail.
	    	            var span = document.createElement('span');
	    	            span.classList.add('thumb_wrap')
	    	            span.innerHTML = ['<img class="thumb" title="', theFile.name, '" src="img/noimg.png" /> <button type="button" class="remove_file">&times;</button>'].join('');
	    	            evt.target.parentNode.nextElementSibling.insertBefore(span, null);
	    	        };
	    	    })(f);
	    	    // Read in the image file as a data URL.
	    	    reader.readAsDataURL(f);
	    	}
	    	else {
	    		var reader = new FileReader();
	    		// Closure to capture the file information.
	    		reader.onload = (function (theFile) {
	    		    return function (e) {
	    		        // Render thumbnail.
	    		        var span = document.createElement('span');
	    		        span.classList.add('thumb_wrap')
	    		        span.innerHTML = ['<img class="thumb" title="', theFile.name, '" src="', e.target.result, '" /> <button type="button" class="remove_file">&times;</button>'].join('');
	    		        evt.target.parentNode.nextElementSibling.insertBefore(span, null);
	    		    };
	    		})(f);
	    		// Read in the image file as a data URL.
	    		reader.readAsDataURL(f);
	    	}
	    }
    }
}

document.addEventListener('change', handleFileSelect, false);
function removeImg(e) {
	if (e.target.classList.contains('remove_file')) {
		e.target.parentNode.remove()
	}
}

document.addEventListener('click', removeImg)

document.addEventListener("DOMContentLoaded", function() {
  	var bd = document.querySelector("body");
	[].forEach.call(document.querySelectorAll(".access-trigger"), function(el) {
	  el.addEventListener("click", function(e) {
	    e.preventDefault();
	    bd.classList.toggle('open-sidebar');
	  });
	});
	[].forEach.call(document.querySelectorAll(".mainmenu > span"), function(el) {
	  el.addEventListener("click", function(e) {
	    bd.classList.remove('open-sidebar');
	  });
	});

});
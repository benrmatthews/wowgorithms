$(document).ready(function() {
	$('.access-trigger').on('click', function(e){
		e.preventDefault();
		$('body').toggleClass('open-sidebar');
	})

	$('.btn-add').on('click', function(e) {
		e.preventDefault();
		$('body').toggleClass('open-modal');

	})

	$('.overlay').on('click', function(e){
		$('body').removeClass('open-sidebar open-modal');
	})

	$('body').keydown(function (e) {
		if ((e.metaKey && e.keyCode=='70' ) || (e.ctrlKey && e.keyCode=='70' )) {
			e.preventDefault();
			if (!$("body").hasClass("isSearching")) {
				setTimeout(function(){
		        	$("#searchform-input").focus();
		        },200);
			}
		} else if (e.keyCode=='27') {
			setTimeout(function(){
				$("body").removeClass("isSearching");
	        },200);
			$('#searchform-input').val("");
			$('.grid__block').show();
		}
	})

	$('#searchform-input').keyup(function (e) {
		if ((e.keyCode!='27') && ($(this).val().length > 0)){
			$("body").addClass("isSearching");
		} else {
			$("body").removeClass("isSearching");
		}
		var searchterm = $(this).val().toLowerCase();
		$('.grid__block').each(function() {
			var brand = $(this).find(".grid__block-title").text().toLowerCase();
			var brandTags = $(this).attr('data-tags');
			if ((brand.indexOf(searchterm) >= 0) || (brandTags.indexOf(searchterm)) >= 0)  {
				$(this).show();
			} else {
				$(this).hide();
			}
		});
	})

	$(".color").on("click", function() {

		if (document.body.createTextRange) {
	        range = document.body.createTextRange();
	        range.moveToElementText(this);
	        range.select();
	    } else if (window.getSelection) {
	        selection = window.getSelection();        
	        range = document.createRange();
	        range.selectNodeContents(this);
	        selection.removeAllRanges();
	        selection.addRange(range);
	    }

	})

});
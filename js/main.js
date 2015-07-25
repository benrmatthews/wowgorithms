function searchTerm(st) {
	if( Object.prototype.toString.call( st ) === '[object Object]' ) {
		var searchterm = st.val().toLowerCase();
	} else {
		var searchterm = st.toLowerCase();
	}

	$('.grid__block').each(function() {
		var brand = $(this).find(".grid__block-title").text().toLowerCase();
		var brandTags = $(this).attr('data-tags');
		if ((brand.indexOf(searchterm) >= 0) || (brandTags.indexOf(searchterm)) >= 0)  {
			$(this).show();
		} else {
			$(this).hide();
		}
	});
}

$(document).ready(function() {
	$('.access-trigger').on('click', function(e){
		e.preventDefault();
		$('body').toggleClass('open-sidebar');
	})

	$('.btn-add').on('click', function(e) {
		e.preventDefault();
		$('body').removeClass('open-sidebar');
		$('body').toggleClass('open-modal');

	})

	$('.overlay, .close').on('click', function(e){
		$('body').removeClass('open-sidebar open-modal');
	})

	$('.reset').on('click', function(e) {
		$('#searchform-input').val("");
		$('.grid__block').show();
		$("body").removeClass("isSearching");
	})

	$('.tag').on('click', function(e){
		e.preventDefault();
		$("body").addClass("isSearching");
		$('#searchform-input').val($(this).text());
		searchTerm($(this).text());
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

	$('.options select').change(function() {
		$('.options__form').trigger('submit');
	})

	$('#searchform-input').keyup(function (e) {
		if ((e.keyCode!='27') && ($(this).val().length > 0)){
			$("body").addClass("isSearching");
		} else {
			$("body").removeClass("isSearching");
		}
		searchTerm($(this));
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
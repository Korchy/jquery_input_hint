//------------------------------------------------------------------
// InputHint JQUERY plugin
//
//	Adds to input fields an ability to hint typing text
//
//	Gets the results from the query, specified in the "hint_query" parameter of the input field
//
// If some hint item is selected, plugin sends a custom event "inputhint_item_selected" with the selected item data
//	the data is URI decoded, JSON.parse(decodeURI(params)) to use it in the event handler
//------------------------------------------------------------------
$(window).on('load', function() {
	$('.inputhint').inputhint();
});
$(window).on('unload', function() {
	$('.inputhint').inputhint('destroy');
});
(function($){
	
	var methods = {
		init: function(options) {
			return this.each(function(){
				if($(this).data('inputhintInit') == true) return this;
				else {
					$(this).on('input', search);
					$(this).on('blur', close_hint_interval);
					$(this).on('keyup', search_key_up);
					$(this).data('inputhintInit', true);
				}
			});
		},
		destroy: function() {
			return this.each(function(){
				$(this).unbind('keyup', search_key_up);
				$(this).unbind('blur', close_hint_interval);
				$(this).unbind('input', search);
				$(this).data('inputhintInit', false);
			});
		}
	};
	
	function search() {
		// Getting data from query
		// Search from 3-x letters
		let search = $(this).val();
		obj = $(this);
		if(search.length > 2) {
			$.ajax({
				type: "POST",
				data: {
					search: search,													// search text
					limit: obj[0].hasAttribute('limit') ? obj.attr('limit') : 0		// limit of gettin gresults
				},
				url: $(this).attr('hint_query'),
				success: function(responce) {
					// console.log(responce);
					// console.log(JSON.parse(responce));
					let rez = JSON.parse(responce);
					// show results as hints
					let rez_length = Object.keys(rez).length;
					if(rez_length > 0) {
						// div for hint showing
						let searchRez = '<div class = "input_hint_rez">';
						for(var i = 0; i < rez_length; i++) {
							// in the hint item show data from the first field
							let view_field = Object.keys(rez[i])[0];
							searchRez += '<div class = "input_hint_rez_item"';
							searchRez +=  ' hint_data = "' + encodeURI(JSON.stringify(rez[i])) + '"';	// all data
							searchRez += '>' + rez[i][view_field] + '</div>';
						}
						searchRez += '</div>';
						// add to page
						close_hint();
						obj.after(searchRez);
						// under the input field
						$('.input_hint_rez').css('left', obj.position().left + 'px');
						$('.input_hint_rez').css('top', (obj.position().top + obj.height() + 3) + 'px');
						// hint on click event
						$('.input_hint_rez_item').on('click', on_hint_item_select);
					}
					else close_hint();
				}
			});
		}
		else close_hint();
	}

	function close_hint() {
		// close (remove) hint window
		$('.input_hint_rez_item').unbind('click', on_hint_item_select);
		$('.input_hint_rez').remove();
	}

	function close_hint_interval() {
		// close (remove) hint window with interval to have some time to process the clicking items event
		let id = setInterval(close_hint_interval, 150);
		function close_hint_interval() {
			close_hint();
			clearInterval(id);
		}
	}
	
	function search_key_up(event) {
		// Pressing keys in the input field
		// ESC - close hint window
		if(event.keyCode == 27) {
			close_hint();
		}
	}

	function on_hint_item_select() {
		// On selecting of one of the hint items
		input_field = $(this).parent().parent().find('.inputhint');
		// fill the input field
		input_field.val($(this).html());
		// sent the custom event with full getted data to process by another ways on the page
		input_field.trigger('inputhint_item_selected', [$(this).attr('hint_data')]);
	}
	
	$.fn.inputhint = function(method) {
		if(methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		}
		else if(typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		}
		else {
			$.error('Undefined method: ' +  method);
		}
	};
}
)(jQuery);

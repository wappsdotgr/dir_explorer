$(document).ready(function(){
	// oti leei
	function sort() {
		$('section ul').each( function() {
			tinysort($(this).children('li[data-type="dir"]'),{
				order:'asc'
			});
			tinysort($(this).children('li[data-type="file"]'),{
				order:'asc'
			});
		});
	};
	function apply_sort() {
		// vars
		var content = $('section li').get();
		var olddom = $('aside textarea').text();
		olddom = olddom.substr(olddom.indexOf(':eof:'));
		var newdom = '';
		$(content).each( function() {
			// add level
			for (var i = 0; i < $(this).attr('data-lvl'); i++) {
				newdom += '\t';
			};
			// case: dir
			if ($(this).attr('data-type') == 'dir') {
				newdom += ($(this).children('input').is(':checked')) ? '-|' : '+|';
				newdom += $(this).children('label').text() + '\n';
			}
			// case: file
			else {
				newdom += $(this).text();
			}
		});
		// Update content
		$('aside textarea').val(newdom + '\n' + olddom).attr('data-saved','false');
	};
	// Menu bttns
	$('header .icon-options').click( function() {
		// sort();
		return false;
	});
	$('header .icon-sort').click( function() {
		sort();
		return false;
	});
	$('header .icon-apply-sort').click( function() {
		apply_sort();
		return false;
	});
	$('header .icon-save').click( function() {
		$('#save').click();
		return false;
	});
	$('header .icon-panel').click( function() {
		var gto = ($('section').css('left') == '300px') ? '0px' : '300px';
		$('section').animate({left: gto}, 250);
		return false;
	});
	//[OK] Track Changes + Indicate
	$('aside textarea').bind('input propertychange', function() {
		$(this).attr('data-saved','false');
	});
	//[OK] Accept 'Tab'
	$("aside textarea").keydown(function(e) {
		if(e.keyCode === 9) { // tab was pressed
			// get caret position/selection
			var start = this.selectionStart;
			var end = this.selectionEnd;
			// set vars
			var $this = $(this);
			var value = $this.val();
			// set textarea value to: text before caret + tab + text after caret
			$this.val(value.substring(0, start) + "\t" + value.substring(end));
			// put caret at right position again (add one for the tab)
			this.selectionStart = this.selectionEnd = start + 1;
			// prevent the focus lose
			e.preventDefault();
		}
	});
	//[OK] Handles 'Ctrl + S' Scut
	$(window).keydown(function(event) {
		// http://www.cambiaresearch.com/articles/15/javascript-char-codes-key-codes
		if (!(event.which == 83 && event.ctrlKey)) return true;
		$('header .icon-save').click();
		event.preventDefault();
		return false;
	});
	// bebug ...
	// setTimeout(function(){
		// $('header .icon-apply-sort').click();
	// }, 1000);
});
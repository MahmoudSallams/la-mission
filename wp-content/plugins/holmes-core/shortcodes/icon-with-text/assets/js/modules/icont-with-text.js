(function($) {
	'use strict';
	
    var iconWithText = {};
    
	mkdf.modules.iconWithText = iconWithText;
	iconWithText.mkdfIconWithText = mkdfIconWithText;
	iconWithText.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfIconWithText().init();
	}
	
	/**
	 * Object that represents icon with text shortcode
	 */
	var mkdfIconWithText = function() {
		var iwts = $('.mkdf-iwt');
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.mkdf-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.closest('.mkdf-iwt').find('a').on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.closest('.mkdf-iwt').find('a').on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		return {
			init: function() {
				if(iwts.length) {
					iwts.each(function() {
						iconHoverColor($(this).find('.mkdf-icon-shortcode'));
					});
				}
			}
		};
	};
	
})(jQuery);
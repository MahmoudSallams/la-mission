(function($) {
	'use strict';
	
	var videoBtn = {};
	mkdf.modules.videoBtn = videoBtn;
	videoBtn.mkdfVideoBtnAppearFx = mkdfVideoBtnAppearFx;
	videoBtn.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfVideoBtnAppearFx();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function mkdfVideoBtnAppearFx() {
		var videoBtns = $('.mkdf-video-button-holder');
		
		if (videoBtns.length && !mkdf.htmlEl.hasClass('touch')) {
            videoBtns.find('.mkdf-video-button-play-inner').appear(function() {
                $(this).closest('.mkdf-video-button-holder').addClass('mkdf-appeared');
			}, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
		}
	}
})(jQuery);
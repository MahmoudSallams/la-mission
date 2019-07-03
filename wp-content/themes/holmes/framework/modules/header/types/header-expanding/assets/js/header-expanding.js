(function($) {
    "use strict";

    var headerExpanding = {};
    mkdf.modules.headerExpanding = headerExpanding;

	headerExpanding.mkdfOnDocumentReady = mkdfOnDocumentReady;
	headerExpanding.mkdfOnWindowLoad = mkdfOnWindowLoad;
	headerExpanding.mkdfOnWindowResize = mkdfOnWindowResize;
	headerExpanding.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function mkdfOnDocumentReady() {
	    mkdfExpandingMenu();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function mkdfOnWindowLoad() {
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function mkdfOnWindowResize() {
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function mkdfOnWindowScroll() {
    }

	/**
	 * Init Expanding Menu
	 */
	function mkdfExpandingMenu() {

		if ($('a.mkdf-expanding-menu-opener').length) {

			var expandingMenuOpener = $( 'a.mkdf-expanding-menu-opener');

			// Open expanding menu
			expandingMenuOpener.on('click',function(e){
				e.preventDefault();

				if (!expandingMenuOpener.hasClass('mkdf-fm-opened')) {
					expandingMenuOpener.addClass('mkdf-fm-opened');
					mkdf.body.addClass('mkdf-expanding-menu-opened');
					$(document).keyup(function(e){
						if (e.keyCode == 27 ) {
							expandingMenuOpener.removeClass('mkdf-fm-opened');
							mkdf.body.removeClass('mkdf-expanding-menu-opened');
						}
					});
				} else {
					expandingMenuOpener.removeClass('mkdf-fm-opened');
					mkdf.body.removeClass('mkdf-expanding-menu-opened');
				}
			});
		}
	}

})(jQuery);
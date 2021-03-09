(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );

function tahhl_guess ( L ) {

    var re = new RegExp(L,"g");
 
    var x = document.getElementsByClassName('tahhl_L'+L);
    var i;

    spruch = spruch.replace(re,'');

    for (i = 0; i < x.length; i++) {
        x[i].style.visibility = "visible";
    }
    if (x.length > 0) {
        document.getElementById('tahhl_L'+L).style.background = "green";
    }
    else {
        document.getElementById('tahhl_L'+L).style.background = "red";
    }
    if (spruch == "") {
        document.getElementById("tahhl_refresh").innerText = 'Gratuliere, das Rätsel ist gelöst! Neu?'; 
    }
    
}

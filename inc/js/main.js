/* Make a ajax function for use ajax in site */

jQuery(document).ready(function($){
	$('#refresh').click(function() {	

		GetNews();
	});

	function GetNews(){

		$.ajax({
			url:ajaxurl,
			type : "POST",
			data : {action: "wprndpst_Sorting"},
			success: function(response) {
				$('#showcontent').html(response);	

			}
		});   
	}
	jQuery('.tabs .tab-links a').on('click', function(e)  {
		var currentAttrValue = jQuery(this).attr('href');

        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).siblings().slideUp(400);
        jQuery('.tabs ' + currentAttrValue).delay(400).slideDown(400);
        
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
        
        e.preventDefault();
    });


	jQuery('.legend img').click(function(){
		jQuery('.more-detail').css('left','-340px').toggle(500);
		/* jQuery('.more-detail').css('display','block').toggle(500);*/
	});

	function heartbeat() {
        setTimeout(function(){                //start setTimeout
            jQuery('.love img').toggleClass('beat');    //add or remove class .beat
            heartbeat();                      //and call the function again
        },500);                               //every half second
    }
    heartbeat(); 

}); 

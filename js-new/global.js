// Email Dislcaimer and other code as needed

$(function(){
  	$('form.cmxform div:last-of-type').after('<div class="buygoods_quiz_disclaimer"><a href="#data_email_disclaimer_modal" data-uk-modal="{center:true}" class="bg_email_disclaimer_modal_link">How your data is used</a></div>');

	$('#data_footer_disclaimer').html('<div id="data_email_disclaimer_modal" class="uk-modal"><div class="uk-modal-dialog"><div class="uk-modal-header">How your data is used</div><p>We are committed to keeping your e-mail address confidential. We do not sell, rent, or lease our subscription lists to third parties, and we will not provide your personal information to any third party individual, government agency, or company at any time unless compelled to do so by law.</p><p>Your e-mail address will be used from time to time to provide timely information about our website news and related products. We will maintain the information you send via e-mail in accordance with applicable federal law. You can easily unsubscribe at anytime.</p><div class="uk-modal-footer"><a class="uk-modal-close">Close</a></div></div></div>');
	
	// https://getuikit.com/v2/docs/modal.html
	$('#data_email_disclaimer_modal').on({
		'show.uk.modal': function(){
			setTimeout(function() {
				var modal = UIkit.modal("#data_email_disclaimer_modal");

				if ( modal.isActive() ) {
					 modal.hide();
				}
			}, 25000);
		},

		'hide.uk.modal': function(){
		}
	});	
	
});

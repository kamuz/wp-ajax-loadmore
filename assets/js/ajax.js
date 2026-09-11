// AJAX query for Load more posts
jQuery(function($) {
	const button = $('#loadmore a');
	const maxPages = button.data('maxpages');
	const taxonomy = button.data('taxonomy');
	const termID = button.data('term-id');
	let paged = button.data('paged');
	console.log('Hey');
	button.click(function(e) {
		e.preventDefault();
		console.log(button.text());
		$.ajax({
			type: 'POST',
			url: kamuz.ajax_url, // WordPress admin-ajax endpoint
			data: {
				paged: ++paged, // next page number
				taxonomy: taxonomy,
				termID: termID,
				action: 'loadmore' // AJAX action hook on the server
			},
			beforeSend: function(){
				button.addClass('is-loading').text('Loading...'); // show loading state
			},
			success: function(data){
				console.log(data);
				console.log(paged);
				$('#posts-list').append(data); // insert new posts before the button
				button.removeClass('is-loading').text('Load more'); // restore button label
				if(paged == maxPages) {
					button.parent().remove();
				}
			}
		});
	});
});
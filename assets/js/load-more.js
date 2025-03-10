jQuery(document).ready(function($) {
    var page = 1;
  
    function truncateText(selector, maxLength) {
        $(selector).each(function () {
            let text = $(this).text();
            if (text.length > maxLength) {
                $(this).text(text.substring(0, maxLength) + '...');
            }
        });
    }
  
    $('#load-more').on('click', function() {
        var categoryId = $(this).data('category');
  
        $.ajax({
            url: load_more_params.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_posts',
                nonce: load_more_params.nonce,
                page: page + 1,
                category_id: categoryId
            },
            success: function(response) {
                response = JSON.parse(response);
  
                if (response.posts) {
                    $('.blog__content').append(response.posts);
                    page++;
  
                    truncateText('.blog__description', 100); 
                }
  
                if (!response.has_more_posts) {
                    $('#load-more').hide();
                }
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    });
  
    truncateText('.blog__description', 100);
  });
  
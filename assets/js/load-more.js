jQuery(document).ready(function($) {
  var page = 1;
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
});

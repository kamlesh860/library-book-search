jQuery(function($){

    // class when form submit
    $(".search-books").on("submit", function (e) {

        e.preventDefault();
        // Get all value of form
        var bookName = $(".books").val();
        var autorName = $(".authors").val();
        var publisherName = $(".publisher").val();
        var rating = $(".rating").val();
        var minPrice = $("#price-min").val();
        var maxPrice = $("#price-max").val();

        var data = {
			'action': 'booksearch',
            'bookName': bookName,
            'autorName': autorName,
            'publisherName': publisherName,
            'rating': rating,
            'minPrice': minPrice,
            'maxPrice': maxPrice,
        }
        $.ajax({
          type: "POST",
          url: custom.ajax_url,
          data: data,
          success: function (data) {
            // replce data of filter value by given data
            $("tbody").html(data);
          }
        });
    });
});
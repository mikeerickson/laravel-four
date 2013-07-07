/*
<a href="posts/2" data-method="delete"> <---- We want to send an HTTP DELETE request
*/

(function() {

  var laravel = {
    initialize: function() {
      this.methodLinks = $('a[data-method]');

      this.registerEvents();
    },


    registerEvents: function() {
      this.methodLinks.on('click', this.handleMethod);
    },

    handleMethod: function(e) {
      var link = $(this);

      var httpMethod = link.data('method').toUpperCase();
      var allowedMethods = ['PUT', 'DELETE'];

      // If the data-method attribute is not PUT or DELETE,
      // then we don't know what to do. Just ignore.
      if ( $.inArray(httpMethod, allowedMethods) === - 1 ) {
        return;
      }

      var form =
        $('<form>', {
          'method': 'POST',
          'action': link.attr('href')
        });

      var token =
        $('<input>', {
          'type': 'hidden',
          'name': 'csrf_token',
          'value': '<?php echo csrf_token(); ?>' // hmmmm...
        });

      var hiddenInput =
        $('<input>', {
          'name': '_method',
          'type': 'hidden',
          'value': link.data('method')
        });

      form.append(hiddenInput, token)
          .appendTo('body')
         .submit();

      e.preventDefault();
    }
  };

  laravel.initialize();

})();
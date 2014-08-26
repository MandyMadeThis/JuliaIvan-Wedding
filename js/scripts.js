$(function() {
  var feed = new Instafeed({
          get: 'tagged',
          tagName: 'dogs',
          clientId: '876cebe25a23446fa882f160f4327a9b',
          useHttp: true, 
          sortBy: 'most-recent',
          resolution: 'low_resolution',
          template: '<a class="fancybox" rel="gallery" title="{{caption}}" data-photo="{{model.user.profile_picture}}" href="{{model.images.standard_resolution.url}}"><img src="{{image}}" /></a>'
      });
      feed.run();

      // fancybox
     $(".fancybox").fancybox({
    afterLoad: function() {
        this.title = this.title + '<img class="profile" src"">';
    },
    helpers : {
        title: {
            type: 'inside'
        }
    }
});
      var profile = $('.fancybox').data('photo');
      $('img.profile').attr('src', profile);
    
}); // end of doc ready

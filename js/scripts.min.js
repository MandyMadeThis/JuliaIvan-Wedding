$(function() {
  var loadButton = document.getElementById('load-more');
  var feed = new Instafeed({
          get: 'tagged',
          tagName: 'themacdruzics',
          clientId: '876cebe25a23446fa882f160f4327a9b',
          useHttp: true, 
          sortBy: 'most-recent',
          resolution: 'low_resolution',
          template: '<div class="img-border"><a class="fancybox" rel="gallery" title="{{caption}}" data-photo="{{model.user.profile_picture}}"href="{{model.images.standard_resolution.url}}"><img src="{{image}}" /></a></div>',

          after: function() {
             // disable button if no more results to load
             if (!this.hasNext()) {
               loadButton.setAttribute('disabled', 'disabled');
               document.getElementById("load-more").style.display = "none";
             }
           },
      });

  // call feed.next() on button click
  $('#load-more').on('click', function() {
    feed.next();
  });

  // calling the instafeed function
      feed.run();


     $(".fancybox").fancybox({
         afterLoad: function() {
          var img = $(this.element).data('photo');
             this.title =  '<img src="' + img + '" class="profile">' + '<div class="caption">' + this.title + '</div>';
         },
         helpers : {
             title: {
                 type: 'inside'
             },
             overlay : {
                         css : {
                             'background' : 'rgba(49,22,11, 0.95)'
                         }
                     }
         },
     });
   
    
}); // end of doc ready


 // var comm = $(this.element).data('comments');
 // + '<div class="comments">' + comm + '</div>' 

// CODE TO GET JSON OBJECT -  DELETE FOR PRODUCTION
// var Instagram = {};

// (function(){

//   function toScreen(data){
//     console.log(data);
//   }

//   function search(tag){
//     var url = "https://api.instagram.com/v1/tags/" + tag + "/media/recent?callback=?&amp;client_id=876cebe25a23446fa882f160f4327a9b"
//     $.getJSON(url, toScreen);
//   }

//   Instagram.search = search;
// })();

// Instagram.search('cats');

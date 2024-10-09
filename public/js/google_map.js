
window.initMap = function(map_id,field_id){
  var myLatlng = new google.maps.LatLng(31.5546, 74.3572);
  var myOptions = {
    zoom: 13,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById(map_id), myOptions);
  var geocoder = new google.maps.Geocoder();

  google.maps.event.addListener(map, 'click', function(event) {
    geocoder.geocode({
      'latLng': event.latLng
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          /*alert(results[0].formatted_address);*/
          $(field_id).val(results[0].formatted_address);
        }
      }
    });
  });  

  
}


  // var map, map2;
  // window.initMap = function(condition)
  // {
  //   var myLatlng = new google.maps.LatLng(31.5546, 74.3572);
  //   var myOptions = {
  //     zoom: 13,
  //     center: myLatlng
  //   }
  //   // var map = new google.maps.Map(document.getElementById("map"), myOptions);

  //   map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
  //  // map2 = new google.maps.Map(document.getElementById("edit_meeting_map"), myOptions);

  //   // var geocoder = new google.maps.Geocoder();
  //   google.maps.event.addListener(map, 'click', function(event){
  //     geocoder.geocode({
  //       'latLng': event.latLng
  //     }, function(results, status) {
  //       if (status == google.maps.GeocoderStatus.OK) {
  //         if (results[0]) {
  //           /*alert(results[0].formatted_address);*/
  //           $('#show_place_name').val(results[0].formatted_address);
  //         }
  //       }
  //     });
  //   });









  // }


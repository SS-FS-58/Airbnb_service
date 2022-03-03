<!DOCTYPE html>
<html>
<head>
  <script src="https://unpkg.com/ag-grid-community/dist/ag-grid-community.min.noStyle.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/dist/styles/ag-grid.css">
  <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/dist/styles/ag-theme-balham.css">
  <script src="https://www.gstatic.com/firebasejs/7.9.1/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.9.1/firebase-database.js"></script>
</head>
<body>
  <h1>Hello from ag-grid!</h1>
  <input type="hidden" id="location" value="<?php echo $_POST["location"] ?>">
  <input type="hidden" id="checkin_date" value="<?php echo $_POST["checkin_date"] ?>">
  <input type="hidden" id="checkout_date" value="<?php echo $_POST["checkout_date"] ?>">
  <input type="hidden" id="price_max" value="<?php echo $_POST["price_max"] ?>">
  <input type="hidden" id="price_min" value="<?php echo $_POST["price_min"] ?>">
  <div id="myGrid" style="height: 600px;width:100%;" class="ag-theme-balham"></div>

  <script type="text/javascript" charset="utf-8">
     var firebaseConfig = {
    apiKey: "AIzaSyCDlt8uITRWP5gvGfwkDEx7Q1dBm5SVo-o",
    authDomain: "airbnbapidatabase.firebaseapp.com",
    databaseURL: "https://airbnbapidatabase.firebaseio.com",
    projectId: "airbnbapidatabase",
    storageBucket: "airbnbapidatabase.appspot.com",
    messagingSenderId: "43807455976",
    appId: "1:43807455976:web:5875e4a79820d56c64675d",
    measurementId: "G-J9BTSMWLNQ"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
    // specify the columns
    var arr1 = document.getElementById("checkin_date").value;
    var arr2 = document.getElementById("checkout_date").value;
    var arr3 = document.getElementById("location").value;
    var arr4 = document.getElementById("price_max").value;
    var arr5 = document.getElementById("price_min").value;
    const database = firebase.database();
    
    var columnDefs = [
            {headerName: "badges", field: "listing.badges"},
            {headerName: "bathroom_label", field: "listing.bathroom_label",sortable: true},
            {headerName: "bathrooms", field: "listing.bathrooms",sortable: true},
            {headerName: "bed_label", field: "listing.bed_label",sortable: true},
            {headerName: "bedroom_label", field: "listing.bedroom_label",sortable: true},
            {headerName: "bedrooms", field: "listing.bedrooms",sortable: true},
            {headerName: "beds", field: "listing.beds",sortable: true},
            {headerName: "city", field: "listing.city",sortable: true},
            {headerName: "guest_label", field: "listing.guest_label",sortable: true},
            {headerName: "host_languages", field: "listing.host_languages",sortable: true},
            {headerName: "host_thumbnail_url_small", field: "listing.host_thumbnail_url_small"},
            {headerName: "host_thumbnail_url", field: "listing.host_thumbnail_url"},
            {headerName: "id", field: "listing.id"},
            {headerName: "is_business_travel_ready", field: "listing.is_business_travel_ready"},
            {headerName: "is_new_listing", field: "listing.is_new_listing"},
            {headerName: "is_superhost", field: "listing.is_superhost"},
            {headerName: "kicker_content", field: "listing.kicker_content"},
            {headerName: "lat", field: "listing.lat"},
            {headerName: "lng", field: "lng"},
            {headerName: "localized_city", field: "listing.localized_city"},
            {headerName: "name", field: "listing.name"},
            {headerName: "person_capacity", field: "listing.person_capacity"},
            {headerName: "picture_count", field: "listing.picture_count"},
            {headerName: "picture_url", field: "listing.picture_url"},
            {headerName: "picture_urls", field: "listing.picture_urls"},
            {headerName: "picture", field: "listing.picture"},
            {headerName: "preview_amenities", field: "listing.preview_amenities"},
            {headerName: "preview_encoded_png", field: "listing.preview_encoded_png"},
            {headerName: "property_type_id", field: "listing.property_type_id"},
            {headerName: "reviews_count", field: "listing.reviews_count"},
            {headerName: "room_and_property_type", field: "listing.room_and_property_type"},
            {headerName: "room_type_category", field: "listing.room_type_category"},
            {headerName: "room_type", field: "listing.room_type"},
            {headerName: "scrim_color", field: "listing.scrim_color"},
            {headerName: "show_structured_name", field: "listing.show_structured_name"},
            {headerName: "space_type", field: "listing.space_type"},
            {headerName: "star_rating", field: "listing.star_rating"},
            {headerName: "tier_id", field: "listing.tier_id"},
            {headerName: "user", field: "listing.user"},
            {headerName: "wide_kicker_content", field: "listing.wide_kicker_content"},
            {headerName: "public_address", field: "listing.public_address"},
            {headerName: "seo_reviews", field: "listing.seo_reviews"},
            {headerName: "amenity_ids", field: "listing.amenity_ids"},
            {headerName: "preview_amenity_names", field: "listing.preview_amenity_names"},
            {headerName: "reviews", field: "listing.reviews"},
            {headerName: "star_rating_color", field: "listing.star_rating_color"},
            {headerName: "preview_tags", field: "listing.preview_tags"},
            {headerName: "avg_rating", field: "listing.avg_rating"},
            {headerName: "map_highlight_status", field: "listing.map_highlight_status"},
            {headerName: "formatted_badges", field: "listing.formatted_badges"},
            {headerName: "show_photo_swipe_indicator", field: "listing.show_photo_swipe_indicator"},
            {headerName: "min_nights", field: "listing.min_nights"},
            {headerName: "max_nights", field: "listing.max_nights"},
            {headerName: "contextual_pictures", field: "listing.contextual_pictures"},
            {headerName: "pdp_type", field: "listing.pdp_type"},
            {headerName: "pdp_url_type", field: "listing.pdp_url_type"},
            {headerName: "extend_cards", field: "listing.extend_cards"},
            {headerName: "picture_ids", field: "listing.picture_ids"},
            {headerName: "pricing_quote", field: "listing.pricing_quote"},
            {headerName: "verified", field: "verified"},
            {headerName: "verified_card", field: "verified_card"},
    ];

    // let the grid know which columns to use
    var gridOptions = {
      columnDefs: columnDefs
    };

  // lookup the container we want the Grid to use
  var eGridDiv = document.querySelector('#myGrid');
  new agGrid.Grid(eGridDiv, gridOptions);
  
  // console.log("-----------"+location);
  var body_data = {
    'inputs': {
        'neighborhood_id': '',
        'ne_lat': '',
        'ne_lng': '',
        'property_type_id': '',
        'sw_lat': '',
        'sw_lng': '',
        'checkin_date': ''+arr1,
        'checkout_date': ''+arr2,
        'location': ''+arr3,
        'price_max': ''+arr4,
        'price_min': ''+arr5,
        'superhost_only': '',
        'currency': '',
        'limit': '',
        'offset': '',
        'airbnb_api_key': ''
    },
    'proxy': {
      'type': 'shared',
      'location': 'nyc'
    },
    'format': 'json'
}

var today = new Date();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

postRequest('https://cors-anywhere.herokuapp.com/https://stevesie.com/cloud/api/v1/endpoints/e7762587-1426-47ac-b5d5-d9b2836ec89b/executions', body_data)
  .then(
    data => {gridOptions.api.setRowData(data.object.response.response_json.explore_tabs[0].sections[0].listings),
   
      //insert data
      database.ref("'data/"+today).set(data.object.response.response_json.explore_tabs[0].sections[0].listings);}
      // data=> console.log(data.object.response.response_json.explore_tabs[0].sections[0].listings)
  ) // Result from the `response.json()` call
  .catch(error => console.error(error))


function postRequest(url, body_data) {
  return fetch(url, {
    method: 'POST', // 'GET', 'PUT', 'DELETE', etc.
    body: JSON.stringify(body_data), // Coordinate the body type with 'Content-Type'
    headers: new Headers({
    
        'Token': '3138c6bb-6623-4bef-9da0-c61793a0d117',
        'Content-Type': 'application/json'
    })
  })
  .then(response => response.json())
}
  // create the grid passing in the div to use together with the columns & data we want to use


  
  // agGrid.simpleHttpRequest({
  //           method: 'POST',
  //           body: JSON.stringify(body_data),
  //           headers: new Headers({
  //           'Token': '3138c6bb-6623-4bef-9da0-c61793a0d117',
  //           'Content-Type': 'application/json'
  //           }),
  //           url:'https://cors-anywhere.herokuapp.com/https://stevesie.com/cloud/api/v1/endpoints/e7762587-1426-47ac-b5d5-d9b2836ec89b/executions'
  //         }).then(function(data) {
  //             console.log(data);
  //             gridOptions.api.setRowData(data);
  // });

  </script>
</body>
</html>
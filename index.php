<?php

$data = file_get_contents('json/data.json');
$people = json_decode($data, true);

?>


<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Person Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="/Persons/themes/css/style.css" />
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</head>

<body class="body_bg">
  <div class="container">
    <div class="row">
      <div class="col-md-6 colequal">
        <p class="pg_hd">people data</p>
      </div>
      <div class="col-md-6 colequal v2 nextperson"><button type="button" class="circle_tag">Next Person</button></div>
    </div>
    <div class="row" id="person_list">
    <?php if (is_array($people)) { ?>
      <div class="col-12">
        <div class="data_row">
          <p class="count_row">1</p>
          <div class="data_info_row">
            <p class="data_info_1 v1"><span class="data_info_hd">Name : </span><span class="data_info_hd2"><?php echo $people[0]['name']; ?></span></p>
            <p class="data_info_1"><span class="data_info_hd">Location : </span><span class="data_info_hd2"><?php echo $people[0]['location']; ?></span></p>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>

  <script>
    $('.nextperson').click(function(e) {

      var index = $(this).attr('data-person') || 1;
      $.ajax({
        "url": 'ajax/action.php?a=getNextPerson',
        "type": "GET",
        "dataType": "json",
        "data": {
          'index': index
        },
        "success": function(response) {

          if (response.status == "success") {
            index++;
            $('.nextperson').attr('data-person', index);
            $('#person_list').append(`<div class="col-12">
                                        <div class="data_row">
                                          <p class="count_row">${index}</p>
                                          <div class="data_info_row">
                                            <p class="data_info_1 v1"><span class="data_info_hd">Name : </span><span class="data_info_hd2">${response.data.name}</span></p>
                                            <p class="data_info_1"><span class="data_info_hd">Location : </span><span class="data_info_hd2">${response.data.location}</span></p>
                                          </div>
                                        </div>
                                      </div>`);
          } else {
            alert("No more people!");
          }

        }

      });
    })
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
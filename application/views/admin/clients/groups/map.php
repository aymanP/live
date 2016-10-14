<?php
if(isset($client)){
    if($google_api_key !== ''){ ?>
    <div id="map" class="customer_map"></div>
    <?php } else {
      echo _l('setup_google_api_key_customer_map');
  }
}
?>

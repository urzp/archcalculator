<?php

$selector = " `name` = 'HOAI_updated' ";
$data_HOAI_updated['value'] = date("Y-m-d H:m:s");
crud_update('settings', $data_HOAI_updated, $selector);

?>
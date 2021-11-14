<?php

    /*WRITTEN BY : ADIL OUTLIT */
    // MAP YOUR URL HERE
    $SITEMAP_URL = "[XML LINK]";
    //NUMBER TO BE DISPLAYED
    $NUMBER_TO_DISPLAY = 15;
    //WHERE TO SAVE THE TEMPORARY XML FILE
    $XML_FILE_PATH = "SAVE YOUR TEMP XML FILE HERE (PATH)";
    // PARSE IT
    $xml = file_get_contents($SITEMAP_URL);
    $SITEMAP_URL =new SimpleXMLElement($xml) ;
    // SAVE IT INTO A NEW FORMATTED XML FILE
    $domxml = new DOMDocument('1.0');
    $domxml->preserveWhiteSpace = false;
    $domxml->formatOutput = true;
    /* @var $xml SimpleXMLElement */
    $domxml->loadXML($SITEMAP_URL->asXML());
    $domxml->save($XML_FILE_PATH);
    // OPEN THE SAVED FILE
    $file = simplexml_load_file($XML_FILE_PATH) or die("Error: Cannot create object");
    //CONVERT THE LAST 100 FROM SIMPLEXML OBJECT TO STRING ARRAY
    $number = $file[0]->url->count();
    echo "<br><br>";
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet" id="bootstrap-css">
<div class="container">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>URL</th>
                <th>date</th>
            </tr>
        </thead>
        <tbody>
<?php
    for($i = 1; $i <= $NUMBER_TO_DISPLAY ;$i++){
?>
            <tr>
                <td><a href="<?php print_r(array( (string) $file[0]->url[$number-$i]->loc)[0]);?>"><?php print_r(array( (string) $file[0]->url[$number-$i]->loc)[0]);?></a></td>
                <td><?php print_r(array( (string) $file[0]->url[$number-$i]->lastmod)[0]);?></td>
            </tr>
           
    <?php }?>
        </tbody>
</table>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#example').DataTable({
        "order": [[ 1, "desc" ]]
    });
    
} );
</script>
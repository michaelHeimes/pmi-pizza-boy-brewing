<?php
//session_start();
require_once('beerconfig.php');
$datatables = 'on';
$pageid = 'beer';
$pagetitle = 'BEER/WINE LIST'
?>

<?php //include('header.php'); ?>
<div class="entry-content entry-content-beer">
    <div class="grid-container position-relative">
        <div class="grid-x grid-padding-x align-center">
            <div class="content-wrap cell small-12">
    <section id="feature" >
        <div class="container">
            <div class="row">
                <h2>WINE LIST</h2>
                <p class="lead">YOU ASKED AND WE LISTENED!  AL'S OF HAMPDEN NOW OFFERS WINE BY THE GLASS.  OUR SELECTION OF WINE IS ALWAYS GROWING AND CHANGING.  SEE OUR FEATURED WINE SELECTIONS ON THE BOARDS NEXT TO OUR DRAFT BEER LIST.  </p>
                            <table id="wine" class="table table-striped table-bordered responsive"  style="" cellspacing="0" align="center">
                    <thead>
                        <tr>
                            <th>NUM</th>
                            <th>VINEYARD</th>
                            <th>WINE</th>
                            <th>VINTAGE</th>
                            <th>VARIETAL</th>
                            <th>STYLE</th>
                            <th>REGION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$sources = array();
$sources[] = "https://spreadsheets.google.com/feeds/list/17yZGsa9cdr7RwjJHRhT3RHge80S4VDC5H5n3jRFGVys/1/public/values?alt=json";
$sources[] = "https://spreadsheets.google.com/feeds/list/17yZGsa9cdr7RwjJHRhT3RHge80S4VDC5H5n3jRFGVys/2/public/values?alt=json";
$sources[] = "https://spreadsheets.google.com/feeds/list/17yZGsa9cdr7RwjJHRhT3RHge80S4VDC5H5n3jRFGVys/3/public/values?alt=json";
$sources[] = "https://spreadsheets.google.com/feeds/list/17yZGsa9cdr7RwjJHRhT3RHge80S4VDC5H5n3jRFGVys/4/public/values?alt=json";
$scoperowcount = 0;
foreach($sources as $source) {
    $data = @file_get_contents($source);
	if ($data) {
    $json = json_decode($data);
    $rows = $json->{'feed'}->{'entry'};
    foreach($rows as $row) {
        $winenum = $row->{'gsx$num'}->{'$t'};
        $vineyard = $row->{'gsx$vineyard'}->{'$t'};
        $wine = $row->{'gsx$wine'}->{'$t'};
        $varietal = $row->{'gsx$varietal'}->{'$t'};
        $style= $row->{'gsx$style'}->{'$t'};
        $region = $row->{'gsx$region'}->{'$t'};
        $vintage = $row->{'gsx$vintage'}->{'$t'};
        
        $scoperowcount++;
        if($scoperowcount == 1) { $scopetag = "scope=\"row\""; }
        else { $scopetag = ''; }
        echo "<tr>";
        echo "<td $scopetag style=\"text-align: center;\" data-label=\"NUM\">".strtoupper($winenum)."</td>";
        echo "<td data-label=\"VINEYARD\">".strtoupper($vineyard)."</td>";
        echo "<td data-label=\"WINE\">".strtoupper($wine)."</td>";
        echo "<td style=\"text-align: center;\" data-label=\"VINTAGE\">".strtoupper($vintage)."</td>";
        echo "<td style=\"text-align: center;\" data-label=\"VARIETAL\">".strtoupper($varietal)."</td>";
        echo "<td style=\"text-align: center;\" data-label=\"STYLE\">".strtoupper($style)."</td>";
        echo "<td style=\"text-align: center;\" data-label=\"REGION\">".strtoupper($region)."</td>";
        echo "</tr>";

    }
	}
}



                        ?>
                    </tbody>
                </table>
            </div><!--/.row-->  
        </div><!--/.container-->
    </section><!--/#feature-->
</div>
        </div>
    </div>
    </div>
<?php //include('footer.php'); ?>
<link href="//cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
<link href="//cdn.datatables.net/responsive/1.0.3/css/dataTables.responsive.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script src="//cdn.datatables.net/responsive/1.0.3/js/dataTables.responsive.js"></script>
<style>
.dataTables_filter {
	display: none;
}

.entry-header + .entry-content {
	padding-bottom: 0 !important;
}

.entry-content-beer {
	padding-top: 0 !important;
}

</style>
<script>
    jQuery(document).ready(function( $ ) {
        $('#bottle_list').dataTable( {
            "language": {
                "emptyTable": "NO BOTTLES CURRENTLY AVAILABLE"
            },
            "responsive": true,
            "paging":   false,
            "info":     false,
            "order": [ [0,'asc'], [1,'asc'] ]            
        });
        $('#cask_list').dataTable( {
            "language": {
                "emptyTable": "NO CASKS CURRENTLY AVAILABLE"
            },
            "responsive": true,            
            "paging":   false,
            "info":     false,
            "order": [ [0,'asc'], [1,'asc'] ]
        });
        $('#draft_list').dataTable( {
            "language": {
                "emptyTable": "NO DRAFTS CURRENTLY AVAILABLE"
            },
            "responsive": true,           
            "paging":   false,
            "info":     false,
            "order": [ [1,'asc'], [2,'asc'] ]
        });  
        $('#wine').dataTable( {
            "language": {
                "emptyTable": "NO WINES CURRENTLY AVAILABLE"
            },
            "responsive": true,            
            "paging":   false,
            "info":     false,
            "order": [ [0,'asc'] ]
        }); 
        /*$('#cans').dataTable( {
            "language": {
                "emptyTable": "NO CANS CURRENTLY AVAILABLE"
            },
            "responsive": true,            
            "paging":   false,
            "info":     false,
            "order": [ [0,'asc'] ]
        }); */
         $('#kegs').dataTable( {
            "language": {
                "emptyTable": "NO KEGS CURRENTLY AVAILABLE"
            },
            "responsive": true,            
            "paging":   false,
            "info":     false,
            "order": [ [0,'asc'],[2,'asc'] ]
        });                               
    });
</script>
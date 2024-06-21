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
           <div class="center wow fadeInDown">
                <h2>BEER</h2>
                <p class="lead">OUR BEER LIST IS ALWAYS UP TO DATE.<br>FOLLOW US ON <a href="//<?php echo $twitter_url; ?>" target="_BLANK"><i class="fa fa-twitter"></i> TWITTER</a> TO BE NOTIFIED WHEN OUR SELECTIONS CHANGE.</p>
                <p class="lead-lg"><a href="#bottles">LIMITED RELEASES</a> &middot; <a href="#cask">CASK-CONDITIONED</a>  &middot; <a href="#drafts">DRAFT BEER</a>  &middot; <a href="#cans">CANS AVAILABLE</a>  &middot; <a href="#kegs">KEGS AVAILABLE</a></p>
            </div>
            <a name="bottles"></a>
            <div class="row">
                <h2>LIMITED RELEASES</h2>
                <p class="lead">ENJOY SOME OF THE LIMITED RELEASE, BARREL-AGED PIZZA BOY BOTTLES AND CANS ON-SITE.<br>FROM WORLD-CLASS SOURS TO TRADITIONAL STYLES AGED IN VIRGIN OR CHARRED OAK, SPENT LIQUOR OR SPENT WINE BARRELS.<br>OCCASIONALLY, WE WILL FEATURE LIMITED BEERS FROM OTHER BREWERIES HERE FOR IN-HOUSE CONSUMPTION ONLY.</p>
                            <table id="bottle_list" class="table table-striped table-bordered responsive"  style="" cellspacing="0" align="center">
                    <thead>
                        <tr>
                            <th>BREWERY</th>
                            <th>BEER</th>
                            <th>STYLE</th>
                            <th>ABV</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php echo strtoupper(file_get_contents("https://hopvision.com/client/client_output2.php?clientid=6&outputid=593dbdf4-6e7f-11e4-a2eb-21eb3855020b&format=table")); ?>
                    </tbody>
                </table>
            </div><!--/.row--> 
            <a name="cask"></a>   
            <div class="row">
                <h2>CASK-CONDITIONED</h2>
                <p class="lead">WE OFFER THREE ROTATING BEER ENGINES AND AN OCCASIONAL SPECIAL FIRKIN TO GIVE SOME OPTIONS TO TRY "REAL ALE".<br>CLICK <a href="//en.wikipedia.org/wiki/Cask_ale" target="_BLANK">HERE</a> TO READ ABOUT CASK-CONDITIONED BEERS.<br><i><small><i class="fa fa-warning"></i> NOTE: BECAUSE THESE BEERS ARE NOT FORCE CARBONATED, WE <STRONG>DO NOT</STRONG> ALLOW CROWLER OR GROWLER FILLS.</small></i></p>
                            <table id="cask_list" class="table table-striped table-bordered" cellspacing="0"  style="" align="center">
                    <thead>
                        <tr>
                            <th>BREWERY</th>
                            <th>BEER</th>
                            <th>STYLE</th>
                            <th>ABV</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php echo strtoupper(file_get_contents("https://hopvision.com/client/client_output2.php?clientid=6&outputid=6c07375b-6e7f-11e4-a2eb-21eb3855020b&format=table")); ?>
                    </tbody>                    
                </table>
            </div><!--/.row--> 
            <a name="drafts"></a>
            <div class="row">
                <h2>DRAFT BEER</h2>
                <p class="lead">WE OFFER 99 CRAFT BEER TAPS WITH A LITTLE BIT OF SOMETHING FOR EVERYONE INCLUDING: 20-30 OF OUR OWN PIZZA BOY BEERS, SEVERAL SELECTIONS ON NITRO, AND PLENTY OF GREAT CRAFT BEERS FROM RESPECTED CRAFT BREWERS.<br><i><small><i class="fa fa-warning"></i> NOTE: PLEASE ORDER BY TAP NUMBER!&nbsp;&middot;&nbsp;KICKED KEGS NOT SHOWN.&nbsp;&middot;&nbsp;WE <u>DO NOT</u> OFFER SAMPLES OR FLIGHTS.</small></i></p>
                            <table id="draft_list" class="table table-striped table-bordered" style="" cellspacing="0" align="center" width="100%">
                    <thead>
                        <tr>
                            <th>TAP#</th>
                            <th>BREWERY</th>
                            <th>BEER</th>
                            <th>STYLE</th>
                            <th>ABV</th>
                            <th>GROWLERS?</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php echo strtoupper(file_get_contents("https://hopvision.com/client/client_output2.php?clientid=6&outputid=f9cccb43-6e7b-11e4-a2eb-21eb3855020b&format=table")); ?>
                    </tbody>                    
                </table>    
            </div><!--/.row-->   
            <a name="cans"></a>
            <div class="row">
                <h2>CANS AVAILABLE</h2>
                <p class="lead">WE ALWAYS HAVE A SELECTION OF FRESH PIZZA BOY CANS AVAILABLE IN 6-PACKS AND CASES TO GO. NO PURCHASE LIMITS UNLESS SPECIFIED.</p>
  <!--                          <table id="cans" class="table table-striped table-bordered responsive"  style="font-size: smaller;" cellspacing="0" align="center">
                    <thead>
                        <tr>
                            <th>BEER</th>
                            <th>STYLE</th>
                            <th>ABV</th>
                            <th>FORMAT</th>
                            <th>4/6 PACK</th>
                            <th>CASE</th>
                        </tr>
                    </thead>
                    <tbody>-->
                        <?php
                        /*
                            $cansource = "https://spreadsheets.google.com/feeds/list/1uI-JWQBKnMx_vkn8Le8B4C-_mng-Qvji0S7AQW15M_o/1/public/values?alt=json";
                            $scoperowcount = 0;
                            $candata = file_get_contents($cansource);
                            $canjson = json_decode($candata);
                            $canrows = $canjson->{'feed'}->{'entry'};
                            foreach($canrows as $canrow) {
                                $canbeer = $canrow->{'gsx$beer'}->{'$t'};
                                $canstyle = $canrow->{'gsx$style'}->{'$t'};
                                $canabv = $canrow->{'gsx$abv'}->{'$t'};
                                $canformat = $canrow->{'gsx$format'}->{'$t'};
                                $can6pk = $canrow->{'gsx$pack'}->{'$t'};
                                $cancase = $canrow->{'gsx$case'}->{'$t'};
                                $scoperowcount++;
                                if($scoperowcount == 1) { $scopetag = "scope=\"row\""; }
                                else { $scopetag = ''; }
                                echo "<tr>";
                                echo "<td $scopetag data-label=\"BEER\">".strtoupper($canbeer)."</td>";
                                echo "<td data-label=\"STYLE\">".strtoupper($canstyle)."</td>";
                                echo "<td style=\"text-align: center;\" data-label=\"ABV\">".strtoupper($canabv)."%</td>";
                                echo "<td style=\"text-align: center;\" data-label=\"FORMAT\">".strtoupper($canformat)."</td>";
                                echo "<td style=\"text-align: center;\" data-label=\"4/6 PACK\">".strtoupper($can6pk)."</td>";
                                echo "<td style=\"text-align: center;\" data-label=\"CASE\">".strtoupper($cancase)."</td>";
                                echo "</tr>";

                            }
*/
                        ?><!--
                    </tbody>
                </table>-->
                <table id="cans" class="table table-striped table-bordered responsive"  style="" cellspacing="0" align="center">
                    <thead>
                        <tr>
                            <th>BEER</th>
                            <th>STYLE</th>
                            <th>ABV</th>
                            <th>FORMAT</th>
                            <th>4/6 PACK</th>
                            <th>CASE</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<tr>
                    		<td colspan="6" scope="row" style="text-align: center;">FOR CAN AVAILABILITY, PLEASE CALL US AT (717)728-3840 OR CHECK ONLINE ORDERING.</td>
                    	</tr>
                    </tbody>
                </table>
            </div><!--/.row-->    
            <a name="kegs"></a>
            <div class="row">
                <h2>KEGS AVAILABLE</h2>
                <p class="lead">WE USUALLY HAVE A SELECTION OF FRESH PIZZA BOY SIXTELS OR 30L ONE-WAY/NON-RETURNABLE KEGS AVAILABLE FOR SALE.  FOR AVAILABILITY AND PICKUP/PURCHASE INFO, PLEASE CALL US @ <a href="tel:+17177283840">717-728-3840</a>.</p>
                            <!--<table id="kegs" class="table table-striped table-bordered responsive"  style="font-size: smaller;" cellspacing="0" align="center">
                    <thead>
                        <tr>
                            <th>BEER</th>
                            <th>STYLE</th>
                            <th>FORMAT</th>
                            <th>PRICE</th>
                            <th>DEPOSIT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php /*
                            $kegsource = "https://spreadsheets.google.com/feeds/list/13b0yJrdQj7u9QxrfeVkAf2l8ylAlkCESxuKJhDaMVD4/1/public/values?alt=json";
                            $scoperowcount = 0;
                            $kegdata = file_get_contents($kegsource);
                            $kegjson = json_decode($kegdata);
                            $kegrows = $kegjson->{'feed'}->{'entry'};
                            foreach($kegrows as $kegrow) {
                                $kegbeer = $kegrow->{'gsx$beer'}->{'$t'};
                                $kegstyle = $kegrow->{'gsx$style'}->{'$t'};
                                $kegformat = $kegrow->{'gsx$format'}->{'$t'};
                                $kegprice = $kegrow->{'gsx$price'}->{'$t'};
                                $kegdeposit = $kegrow->{'gsx$deposit'}->{'$t'};
                                $scoperowcount++;
                                if($scoperowcount == 1) { $scopetag = "scope=\"row\""; }
                                else { $scopetag = ''; }
                                echo "<tr>";
                                echo "<td $scopetag data-label=\"BEER\">".strtoupper($kegbeer)."</td>";
                                echo "<td data-label=\"STYLE\">".strtoupper($kegstyle)."</td>";
                                echo "<td style=\"text-align: center;\" data-label=\"FORMAT\">".strtoupper($kegformat)."</td>";
                                echo "<td style=\"text-align: center;\" data-label=\"PRICE\">".strtoupper($kegprice)."</td>";
                                echo "<td style=\"text-align: center;\" data-label=\"DEPOSIT\">".strtoupper($kegdeposit)."</td>";
                                echo "</tr>";

                            }*/

                        ?>
                    </tbody>
                </table>-->
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
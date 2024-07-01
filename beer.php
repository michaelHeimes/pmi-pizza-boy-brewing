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
                <p>Our beer list is always up to date. Follow us on <a href="//<?php echo $twitter_url; ?>" Target="_blank"><i class="fa fa-twitter"></i> Twitter</a> to be notified when our selections change.</P>
                <p><a href="#bottles">limited releases</a> &middot; <a href="#cask">cask-conditioned</a>  &middot; <a href="#drafts">draft beer</a>  &middot; <a href="#cans">cans available</a>  &middot; <a href="#kegs">kegs available</a></p>
            </div>
            <a name="bottles"></a>
            <div class="row">
                <h2>LIMITED RELEASES</h2>
                <p>Enjoy some of the limited release, barrel-aged pizza boy bottles and cans on-site. From world-class sours to traditional styles aged in virgin or charred oak, spent liquor or spent wine barrels. Occasionally, we will feature limited beers from other breweries here for in-house consumption only.</p>
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
                <p>We offer three rotating beer engines and an occasional special firkin to give some options to try "real ale". Click <a href="//en.wikipedia.org/wiki/cask_ale" target="_blank">here</a> to read about cask-conditioned beers.<br><i><small><i class="fa fa-warning"></i> Note: because these beers are not force carbonated, we <strong>do not</strong> allow crowler or growler fills.</Small></i></p>
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
                <p>We offer 99 craft beer taps with a little bit of something for everyone including: 20-30 of our own pizza boy beers, several selections on nitro, and plenty of great craft beers from respected craft brewers.<br><i><small><i class="fa fa-warning"></i> note: please order by tap number!&nbsp;&middot;&nbsp;kicked kegs not shown.&nbsp;&middot;&nbsp;we <u>do not</u> offer samples or flights.</small></i></p>
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
                <p>We always have a selection of fresh pizza boy cans available in 6-packs and cases to go. No purchase limits unless specified.</p>
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
                    		<td colspan="6" scope="row" style="text-align: center;">For can availability, please call us at (717)728-3840 or check online ordering.</td>
                    	</tr>
                    </tbody>
                </table>
            </div><!--/.row-->    
            <a name="kegs"></a>
            <div class="row">
                <h2>KEGS AVAILABLE</h2>
                <p>We usually have a selection of fresh pizza boy sixtels or 30l one-way/non-returnable kegs available for sale. For availability and pickup/purchase info, please call us @ <a href="tel:+17177283840">717-728-3840</a>.</p>
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

table.dataTable, table#cans {
	font-size: 18px;
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
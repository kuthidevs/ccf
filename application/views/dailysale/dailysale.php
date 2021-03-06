<style type="text/css">
    .btn-group>.btn:first-child {
        margin-left: 0;
        margin-top: 0px;
    }
</style>

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                Ledger Balance Information
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <form class="tasi-form" method="post" action="<?php echo site_url('dailysale/dailysale/searchbydate'); ?>">
                            <div class="form-group">
                                <div class="col-md-5" style="padding-left: 0">
                                    <div class="input-group input-sm" >
                                        <span class="input-group-addon">From </span>
                                        <div class="iconic-input right">
                                            <i class="fa fa-calendar"></i>
                                            <input type="text" id="dailysearchfrom" class="form-control" name="date_from" value="<?php echo $fdate;?>">
                                        </div>
                                        <span class="input-group-addon">To</span>
                                        <div class="iconic-input right">
                                            <i class="fa fa-calendar"></i>
                                            <input type="text" id="dailysearchto" class="form-control" name="date_to" value="<?php echo $edate;?>">
                                        </div>
                                    </div>
                                </div>                             

                                <div class="col-md-2">   
                                    <label>
                                        <button class="btn btn-info" type="submit">Submit</button>
                                    </label>   
                                </div>

                                <div class="col-md-3">   
                                    <div class="btn-group pull-right">
                                        <button class="btn dropdown-toggle" data-toggle="dropdown">Export <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="#" id="btnExport"> Save as CSV</a></li>
                                            <li><a href="#" onclick="generatePdf()" >Save as PDF</a></li>
                                            <li><a href="#" onclick="Clickheretoprint()">Print Report</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>     
                            <p> &nbsp; </p>
                        </form>                       
                    </div>

                    <div class="tab-content">
                        <div role="tabpanel" id="ledger"  class="tab-pane active">
                            <table  class="table table-striped table-hover table-bordered tab-pane active editable-sample1" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th>Sl. No.</th>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Cost</th>
                                        <th>Profit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $totalquanty = 0;
                                    $totalamount = 0;
                                    $totalcost = 0;
                                    $totalprofit = 0;
                                    if (sizeof($saleinfo) > 0):
                                        $i = 1;
                                        foreach ($saleinfo as $saledata):
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $saledata->productName; ?></td>                                                
                                                <td><?php $quanty = $saledata->qty;echo $quanty; ?></td>
                                                <td><?php $amount = $saledata->amount;echo $amount; ?></td>
                                                <td><?php $tcost = $saledata->cost;echo $tcost; ?></td>
                                                <td><?php $namount = $amount-$tcost;echo $namount; ?></td>
                                            </tr>
                                            <?php
                                            $totalquanty = $totalquanty + $quanty;
                                            $totalamount = $totalamount + $amount;
                                            $totalcost = $totalcost + $tcost;
                                            $totalprofit = $totalprofit + $namount;
                                        endforeach;
                                    endif;
                                    echo '<tr style="font-weight: bold"><td></td><td></td><td>Total= '.$totalquanty.'</td><td>Total= '.$totalamount.'</td><td>Total= '.$totalcost.'</td><td>Total= '.$totalprofit.'</td></tr>';
                                    ?>
                                </tbody>

                            </table>
                            <div class="row" style=" padding-top: 10px">
                                <div class="col-lg-4"></div>

                                <div class="col-lg-4"></div>
                            </div>
                        </div>                      
                    </div>
                </div>
            </div>           
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--modal-->
<!-- For pdf export this js included-->
<script src="<?php echo $baseurl; ?>assets/pdfcreate/jspdf.js"></script>
<script src="<?php echo $baseurl; ?>assets/pdfcreate/libs/FileSaver.js/FileSaver.js"></script>
<script src="<?php echo $baseurl; ?>assets/pdfcreate/jspdf.plugin.table.js"></script>     
<script src='<?php echo $baseurl; ?>assets/pdfcreate/libs/png_support/zlib.js' type='text/javascript'></script>
<script src='<?php echo $baseurl; ?>assets/pdfcreate/libs/png_support/png.js' type='text/javascript'></script>
<script src='<?php echo $baseurl; ?>assets/pdfcreate/jspdf.plugin.addimage.js' type='text/javascript'></script>
<script src='<?php echo $baseurl; ?>assets/pdfcreate/jspdf.plugin.png_support.js' type='text/javascript'></script>
<script type="text/javascript">
                                                $("#btnExport ").on('click', function (event) {
                                                    //Get table
                                                    var table = $("#editable-sample")[0];
                                                    //Get number of rows/columns
                                                    var rowLength = table.rows.length;
                                                    var colLength = table.rows[0].cells.length;
                                                    //Declare string to fill with table data
                                                    var tableString = "";
                                                    //Get column headers
                                                    for (var i = 0; i < colLength; i++) {
                                                        tableString += table.rows[0].cells[i].innerHTML.split(",").join("") + ",";
                                                    }

                                                    tableString = tableString.substring(0, tableString.length - 1);
                                                    tableString += "\r\n";
                                                    //Get row data
                                                    for (var j = 1; j < rowLength; j++) {
                                                        for (var k = 0; k < colLength; k++) {
                                                            tableString += table.rows[j].cells[k].innerHTML.split(",").join("") + ",";
                                                        }
                                                        tableString += "\r\n";
                                                    }

                                                    //Save file
                                                    if (navigator.appName == "Microsoft Internet Explorer") {
                                                        //Optional: If you run into delimiter issues (where the commas are not interpreted and all data is one cell), then use this line to manually specify the delimeter
                                                        tableString = 'sep=,\r\n' + tableString;

                                                        myFrame.document.open("text/html", "replace");
                                                        myFrame.document.write(tableString);
                                                        myFrame.document.close();
                                                        myFrame.focus();
                                                        myFrame.document.execCommand('SaveAs', true, 'data.csv');
                                                    } else {
                                                        var d = new Date();
                                                        var month = d.getMonth() + 1;
                                                        var day = d.getDate();
                                                        var currentdate = d.getFullYear() + '-' +
                                                                (('' + month).length < 2 ? '0' : '') + month + '-' +
                                                                (('' + day).length < 2 ? '0' : '') + day;
                                                        var outputFile = "Bank_book_report" + "_" + currentdate;
                                                        outputFile = outputFile.replace('.csv', '') + '.csv'
                                                        csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(tableString);
                                                        $(event.target).attr({
                                                            'href': csvData,
                                                            'target': '_blank',
                                                            'download': outputFile
                                                        });
                                                    }
                                                });


                                                function generatePdf() {
                                                    var d = new Date();
                                                    var month = d.getMonth() + 1;
                                                    var day = d.getDate();
                                                    var currentdate = d.getFullYear() + '-' + (('' + month).length < 2 ? '0' : '') + month + '-' +(('' + day).length < 2 ? '0' : '') + day;
                                                    var data = [], fontSize = 9, height = 0, doc;
                                                    doc = new jsPDF('p', 'pt', 'a4', true);
                                                    doc.setFont("times", "normal");
                                                    doc.setFontSize(fontSize);
                                                    //var imgData = 'http://whitecall.ca/payme/assets/image/call.jpg';
                                                    //doc.addImage(imgData, 100, 200, 280, 210, undefined);
                                                    doc.text(200, 20, "Details Report For Bank Book");
                                                    //doc.text(190, 35, "From:" + sdate);
                                                    //doc.text(260, 35, "To:" + edate);
                                                    doc.text(200, 32, "Create Date:" + currentdate);
                                                    doc.text(190, 44, "Company Name: Cloud It Limited");
                                                    data = [];
                                                    data = doc.tableToJson('editable-sample');
                                                    doc.setFontSize(5.5);
                                                    height = doc.drawTable(data, {
                                                        xstart: 10,
                                                        ystart: 10,
                                                        tablestart: 80,
                                                        marginleft: 10,
                                                        xOffset: 2,
                                                        yOffset: 7
                                                    });
                                                    //doc.text(50, height + 20, 'hi yousuf');
                                                    doc.save("Details_report_" + currentdate + ".pdf");
                                                }


                                                function Clickheretoprint()
                                                {
                                                    var d = new Date();
                                                    var month = d.getMonth() + 1;
                                                    var day = d.getDate();
                                                    var currentdate = d.getFullYear() + '-' +
                                                            (('' + month).length < 2 ? '0' : '') + month + '-' +
                                                            (('' + day).length < 2 ? '0' : '') + day;
                                                    var disp_setting = "toolbar=yes,location=no,directories=yes,menubar=yes,";
                                                    disp_setting += "scrollbars=yes,width=1140, height=780, left=100, top=25";
                                                    var docprint = window.open("about:blank", "_blank", disp_setting);
                                                    var oTable
                                                    oTable = document.getElementById("editable-sample");
                                                    docprint.document.open();
                                                    docprint.document.write('<html><title>Details Report Of Bank Book</title>');
                                                    docprint.document.write('<head><style>');
                                                    docprint.document.write('table {border-collapse:collapse;}');
                                                    docprint.document.write('table thead, tr, th, table tbody, tr, td { border: 1px solid #000; text-align:center;}');
                                                    docprint.document.write('table thead, tr, th{ background-colo: #000;}');
                                                    docprint.document.write('</style></head>');
                                                    docprint.document.write('<body><center>');
                                                    docprint.document.write('<p><h2>Details Report for Bank Book</h2></p>');
                                                    docprint.document.write('<h3>Create Date: ' + currentdate + '</h3>');
                                                    docprint.document.write(oTable.parentNode.innerHTML);
                                                    docprint.document.write('</center></body></html>');
                                                    docprint.document.close();
                                                    docprint.print();
                                                    docprint.close();
                                                }

</script>
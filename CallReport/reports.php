<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="rsc/pure-min.css" />
        <link rel="stylesheet" href="rsc/pureskin.css" type="text/css" />
        <link rel="shortcut icon" href="rsc/favicon.ico" />
        <title>On Call: Reporting</title>
    </head>
    <body class="pure-skin-gmap">
        <div id="layout">
            <div class="pure-menu pure-menu-open pure-menu-horizontal">
                <a href="#" class="pure-menu-heading">On Call Data</a>
                <ul>
                    <li><a href="index.php">Entry</a></li>
                    <li class="pure-menu-selected"><a href="#">Reports</a></li>
                </ul>
            </div>
            <div class="content">
                <form class="pure-form pure-form-aligned">
                    <legend>Graphs</legend>
                    <fieldset>
                        <div class="pure-control-group">
                            <select name="reportlist" id="reportlist" class="pure-input-2-3">
                                <option value="0">Select a Report</option>
                                <option disabled>Grouped By Home</option>
                                <option value="scripts/total_call_outs.php,bar">--Totals</option>
                                <option value="scripts/home_with_category.php,bar">--With Categories</option>
                                <option value="scripts/home_with_fault.php,bipolar">--With Fault</option>
                                <option value="scripts/home_with_pharmacist.php,bar">--With Pharmacist </option>
                                <option value="scripts/home_by_weekend.php,bipolar">--Weekend Vs Weekdays</option>
                                <option disabled>Grouped by Category</option>
                                <option value="scripts/category_totals.php,bar">--Totals</option>
                                <option value="scripts/category_with_subcategory.php,bar">--With Subcategories</option>
                                <option value="scripts/category_with_fault.php,bipolar">--With Fault</option>
                                <option value="scripts/category_with_pharmacist.php,bar">--With Pharmacist</option>
                                <option value="scripts/category_by_weekend.php,bipolar">--Weekend Vs Weekdays</option>
                                <option disabled>Grouped By Pharmacist</option>
                                <option value="scripts/pharmacist_totals.php,bar">--Totals</option>
                                <option value="scripts/pharmacist_with_fault.php,bipolar">--With Fault</option>
                                <option value="scripts/pharmacist_by_weekend.php,bipolar">--Weekend Vs Weekdays</option>
                            </select>
                        </div>
                        <button id="graphpng" disabled>Save Graph As Picture</button>
                    </fieldset>
                    <canvas id="myCanvas" width="600" height="250">[No canvas support]</canvas>
                    
                </form>
                <form class="pure-form pure-form-aligned">
                    <legend>Tables</legend>
                    <fieldset>
                        <div class="pure-control-group">
                            
                        </div>
                    </fieldset>
                </form>
                <div class=""
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/Rgraph.all.min.js"></script>
    <script type="text/javascript" src="js/reports.js"></script>
</html>

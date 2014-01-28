<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="rsc/pure-min.css" />
        <link rel="stylesheet" href="rsc/pureskin.css" type="text/css" />
        <link rel="shortcut icon" href="rsc/favicon.ico" />
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
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
                <br>
                <div class="pure-g">
                    <div class="pure-u-1-4">
                        &nbsp;
                    </div>
                    <div class="pure-u-1-4">
                        <label for="radiograph" class="pure-radio">
                            <input id="radiograph" value="rptgraphs,rpttables" type="radio" name="rpt" checked> Graphs
                        </label>
                    </div>
                    <div class="pure-u-1-4">
                        <label for="radiotable" class="pure-radio">
                            <input id="radiotable" value="rpttables,rptgraphs" type="radio" name="rpt"> Tables
                        </label>
                    </div>
                    <div class="pure-u-1-4">
                        &nbsp;
                    </div>
                </div>
                <div id="rptgraphs">
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
                    <canvas id="myCanvas" width="800" height="350">[No canvas support]</canvas>
                    
                </form>
                </div>
                <div id="rpttables" class="info-hidden">
                <form class="pure-form pure-form-stacked">
                    <legend>Tables</legend>
                    <fieldset>
                        <h5>Filters: <i class="fa fa-plus-square-o" id="filter"></i></h5>
                        <div id="filterbox" class="pure-g-r collapsing shrunk">
                            <div class="pure-u-1-3">
                                <label for="startdate">Start Date:</label>
                                <input type="date" id="startdate" value="2014-01-01" class="pure-input-1">
                            </div>
                            <div class="pure-u-1-3">
                                <label for="enddate">End Date:</label>
                                <input type="date" id="enddate" value="2014-12-31" class="pure-input-1">
                            </div>
                            <div class="pure-u-1-12">
                                &nbsp;
                            </div>
                            <div class="pure-u-1-4">
                                <label for="nofault" class="pure-radio">
                                    <input id="nofault" value="0" checked type="radio" name="faults"> Any
                                </label>
                                <label for="nhfault" class="pure-radio">
                                    <input id="nhfault" value="1" type="radio" name="faults"> Nursing Home at Fault Only
                                </label>
                                <label for="ourfault" class="pure-radio">
                                    <input id="ourfault" value="2" type="radio" name="faults"> Encore at Fault Only
                                </label>
                            </div>
                            <div class="pure-u-1-3">
                                <div class="pure-control-group">
                                    <label for="nursinghome">Nursing Home:</label>
                                    <select class="pure-input-1" id="nursinghome" name="nursinghome">
                                        <option value="0">All</option>
                                        <?php include_once('scripts/nhlist.php'); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="pure-u-1-3">
                                <div class="pure-control-group">
                                    <label for="rph">Pharmacist:</label>
                                    <select class="pure-input-1" id="rph" name="rph">
                                        <option value="0">All</option>
                                        <?php include_once('scripts/rphlist.php'); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="pure-u-1-3">
                                <div class="pure-control-group">
                                    <label for="category">Category:</label>
                                    <select class="pure-input-1" id="category" name="category">
                                        <option value="0">All</option>
                                        <?php include_once('scripts/categorylist.php'); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h5>Sort: <i class="fa fa-plus-square-o" id="sort"></i></h5>
                        <div id="sortbox" class="pure-g-r collapsing shrunk">
                            <div class="pure-u-1-4">
                                <label for="sort1">First:</label>
                                <select class="pure-input-1" id="sort1" name="sort1">
                                    <option value="A.DateOfCall DESC">Newest To Oldest</option>
                                    <option value="A.DateOfCall ASC">Oldest To Newest</option>
                                    <option value="B.HomeName ASC">Nursing Home A-Z</option>
                                    <option value="C.PharmName ASC">Pharmacist A-Z</option>
                                    <option value="DayOfWeek(A.DateOfCall)">Sunday to Saturday</option>
                                </select>
                            </div>
                            <div class="pure-u-1-4">
                                <label for="sort2">Second:</label>
                                <select class="pure-input-1" id="sort2" name="sort2">
                                    <option value="0">None</option>
                                    <option value="A.DateOfCall DESC">Newest To Oldest</option>
                                    <option value="A.DateOfCall ASC">Oldest To Newest</option>
                                    <option value="B.HomeName ASC">Nursing Home A-Z</option>
                                    <option value="C.PharmName ASC">Pharmacist A-Z</option>
                                    <option value="DayOfWeek(A.DateOfCall)">Sunday to Saturday</option>
                                </select>
                            </div>
                            <div class="pure-u-1-4">
                                <label for="sort3">Third:</label>
                                <select class="pure-input-1" id="sort3" name="sort3">
                                    <option value="0">None</option>
                                    <option value="A.DateOfCall DESC">Newest To Oldest</option>
                                    <option value="A.DateOfCall ASC">Oldest To Newest</option>
                                    <option value="B.HomeName ASC">Nursing Home A-Z</option>
                                    <option value="C.PharmName ASC">Pharmacist A-Z</option>
                                    <option value="DayOfWeek(A.DateOfCall)">Sunday to Saturday</option>
                                </select>
                            </div>
                            <div class="pure-u-1-4">
                                <label for="sort4">Fourth:</label>
                                <select class="pure-input-1" id="sort4" name="sort4">
                                    <option value="0">None</option>
                                    <option value="A.DateOfCall DESC">Newest To Oldest</option>
                                    <option value="A.DateOfCall ASC">Oldest To Newest</option>
                                    <option value="B.HomeName ASC">Nursing Home A-Z</option>
                                    <option value="C.PharmName ASC">Pharmacist A-Z</option>
                                    <option value="DayOfWeek(A.DateOfCall)">Sunday to Saturday</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <div class="pure-g-r">
                    <button id="tablerefresh" class="pure-button-primary"><i class="fa fa-refresh"></i> Refresh</button>
                    <div id="datatable" class="pure-u-1">
                            
                    </div>                   
                </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/Rgraph.all.min.js"></script>
    <script type="text/javascript" src="js/reports.js"></script>
</html>

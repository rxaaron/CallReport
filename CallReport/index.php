<?php include_once('scripts/dbconn.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="rsc/pure-min.css" />
        <link rel="stylesheet" href="rsc/pureskin.css" type="text/css" />
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link rel="shortcut icon" href="rsc/favicon.ico" />
        <title>On Call: Entry Form</title>
    </head>
    <body class="pure-skin-gmap">
        <div id="layout">
            <div class="pure-menu pure-menu-open pure-menu-horizontal">
                <a href="#" class="pure-menu-heading">On Call Data</a>
                <ul>
                    <li class="pure-menu-selected"><a href="#">Entry</a></li>
                    <li><a href="#">Reports</a></li>
                </ul>
            </div>
            <div class="content">
                <form class="pure-form pure-form-aligned" id="calldata">
                    <fieldset>
                        <legend>Call Data Entry Form</legend>
                        <div class="pure-control-group">
                            <label for="calldate">Date of Call:</label>
                            <input class="pure-input-1-3" type="date" value="<?php echo date("Y-m-d"); ?>" id="calldate">
                        </div>
                        <div class="pure-control-group">
                            <label for="nursinghome">Nursing Home:</label>
                            <select class="pure-input-1-3" id="nursinghome">
                                <option value="0">Select One</option>
                                <?php include_once('scripts/nhlist.php'); ?>
                            </select>
                        </div>
                        <div class="pure-control-group">
                            <label for="rph">Pharmacist:</label>
                            <select class="pure-input-1-3" id="rph">
                                <option value="0">Select One</option>
                                <?php include_once('scripts/rphlist.php'); ?>
                            </select>
                        </div>
                        <div class="pure-control-group">
                            <label for="category">Category:</label>
                            <select class="pure-input-1-3" id="category">
                                <option value="0">Select One</option>
                                <?php include_once('scripts/categorylist.php'); ?>
                            </select>
                        </div>
                        <div class="pure-control-group">
                            <label for="subcategory">Subcategory:</label>
                            <select class="pure-input-1-3" id="subcategory">
                                <option value="0">Select One</option>
                            </select>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>

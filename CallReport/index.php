<?php include_once('scripts/commit_new_call.php'); ?>
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
                    <li><a href="reports.php">Reports</a></li>
                </ul>
            </div>
            <div class="content">
                <form class="pure-form pure-form-aligned" id="calldata" name="calldata" action="" method="POST" autocomplete="off">
                    <fieldset>
                        <legend>Call Data Entry Form</legend>
                        <div class="pure-control-group">
                            <label for="calldate">Date of Call:</label>
                            <input class="pure-input-2-3" type="date" value="<?php echo date("Y-m-d"); ?>" id="calldate" name="calldate">
                        </div>
                        <div class="pure-control-group">
                            <label for="nursinghome">Nursing Home:</label>
                            <select class="pure-input-2-3" id="nursinghome" name="nursinghome">
                                <option value="0">Select One</option>
                                <?php include_once('scripts/nhlist.php'); ?>
                            </select>
                        </div>
                        <div class="pure-control-group">
                            <label for="rph">Pharmacist:</label>
                            <select class="pure-input-2-3" id="rph" name="rph">
                                <option value="0">Select One</option>
                                <?php include_once('scripts/rphlist.php'); ?>
                            </select>
                        </div>
                        <div class="pure-control-group">
                            <label for="category">Category:</label>
                            <select class="pure-input-2-3" id="category" name="category">
                                <option value="0">Select One</option>
                                <?php include_once('scripts/categorylist.php'); ?>
                            </select>
                        </div>
                        <div class="pure-control-group">
                            <label for="subcategory">Subcategory:</label>
                            <select class="pure-input-2-3" id="subcategory" name="subcategory" disabled>
                                <option value="0">Select Category First</option>
                            </select>
                        </div>
                        <div class="pure-control-group">
                            <label for="detail">Detail:</label>
                            <textarea id="detail" class="pure-input-2-3" name="detail"></textarea>
                        </div>
                        <div class="pure-controls mid-form">
                            <label for="nhfault" class="pure-checkbox"><input type="checkbox" id="nhfault" name="nhfault">  Nursing Home's Fault</label>
                            <label for="ourfault" class="pure-checkbox"><input type="checkbox" id="ourfault" name="ourfault"> Our Fault</label>
                        </div>
                        <div class="pure-control-group">
                            <label for="comments">Comments:</label>
                            <textarea id="comments" class="pure-input-2-3" name="comments"></textarea>
                        </div>
                        <div class="pure-controls">
                            <button type="submit" class="pure-button pure-button-primary">Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/data.js"></script>
</html>

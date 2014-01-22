<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="rsc/pure-min.css" />
        <link rel="stylesheet" href="rsc/pureskin.css" type="text/css" />
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
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
                            <select name="reportlist" id="reportlist" class="pure-input-2-3" onchange="chart(this);">
                                <option value="0">Select a Report</option>
                                <option value="scripts/total_call_outs.php">Total Call Outs</option>
                                <option value="scripts/calls_with_category.php">Calls With Categories</option>
                                <option value="scripts/calls_with_fault.php">Calls With Fault</option>
                            </select>
                        </div>
                    </fieldset>
                </form>
                <canvas id="myCanvas" width="600" height="250">[No canvas support]</canvas>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/Rgraph.all.min.js"></script>
    <script>
        function chart(s){
            RGraph.Reset(document.getElementById('myCanvas'));
            if(s.value!=='0'){
                RGraph.AJAX(s.value,GoJSON);
            }
        };
        window.onload = function(){
            //RGraph.AJAX('scripts/build_chart.php',GoJSON);
        };
        function GoJSON(result){
            var jdata = eval('(' + result + ')');
            var myChart = new RGraph.Bar('myCanvas',jdata.datas)
            RGraph.SetConfig(myChart,jdata);
            myChart.Set('key.position','gutter');
            myChart.Draw();
        };
    </script>
</html>

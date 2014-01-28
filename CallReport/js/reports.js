        AddListeners();
        GenerateTable();
        
        function AddListeners(){
            document.getElementById('reportlist').addEventListener('change',Chart,false);
            document.getElementById('graphpng').addEventListener('click',CreatePNG,false);
            var radios = document.getElementsByName('rpt');
            for(var i = 0, length = radios.length; i < length; i++){
                document.getElementById(radios[i].id).addEventListener('change',RptSwitch,false);
            }
            document.getElementById('filter').addEventListener('click',ShowHide,false);
            document.getElementById('sort').addEventListener('click',ShowHide,false);
            document.getElementById('tablerefresh').addEventListener('click',GenerateTable,false);
        };
        function GenerateTable(event){
            var xmlhttp;
            xmlhttp = new XMLHttpRequest();
            xmlhttp.open('POST','scripts/chart_builder.php',false);
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            var args;
            args = 'startdate='+document.getElementById('startdate').value + '&enddate='+document.getElementById('enddate').value;
            var radios = document.getElementsByName('faults');
            for(var i = 0, length = radios.length; i < length; i++){
                if(radios[i].checked){
                    args = args + '&fault=' + radios[i].value;
                }
            }
            args = args + '&nursinghome=' + document.getElementById('nursinghome').value + '&rph=' + document.getElementById('rph').value + '&category=' + document.getElementById('category').value + '&sort1=' + document.getElementById('sort1').value + '&sort2=' + document.getElementById('sort2').value + '&sort3=' + document.getElementById('sort3').value + '&sort4=' + document.getElementById('sort4').value;
            xmlhttp.send(args);
            document.getElementById('datatable').innerHTML=xmlhttp.responseText;
            var dtlbtns = document.getElementsByName('detailbtn');
            for(var i = 0, length = dtlbtns.length; i < length; i++){
                document.getElementById(dtlbtns[i].id).addEventListener('click',DetailToggle,false);
            }
        };
        function DetailToggle(event){
            var dtldiv = document.getElementById(this.value);
            if(dtldiv.className==='pure-u-1 info-hidden'){
                dtldiv.className='pure-u-1 info-visible';
            }else{
                dtldiv.className='pure-u-1 info-hidden';
            }
            event.preventDefault();
        }
        function ShowHide(event){
            var boxname = this.id + 'box';
            if(this.className ==='fa fa-plus-square-o'){
                this.className ='fa fa-minus-square-o';
                document.getElementById(boxname).className='pure-g-r collapsing';
            }else{
                this.className = 'fa fa-plus-square-o';
                document.getElementById(boxname).className='pure-g-r collapsing shrunk';
            }
            event.preventDefault();
        };
        function Chart(){
            RGraph.Reset(document.getElementById('myCanvas'));
            if(this.value!=='0'){
                var args = this.value.split(",");
                document.getElementById('graphpng').disabled = false;
                if(args[1]==='bar'){
                    RGraph.AJAX(args[0],BarJSON);
                }else if(args[1]==='bipolar'){
                    RGraph.AJAX(args[0],BipolarJSON);
                }
            }else{
                document.getElementById('graphpng').disabled = true;
            }
        };
        function BarJSON(result){
            var jdata = eval('(' + result + ')');
            var myChart = new RGraph.Bar('myCanvas',jdata.datas);
            RGraph.SetConfig(myChart,jdata);
            myChart.Set('key.position','gutter');
            myChart.Draw();
        };
        function BipolarJSON(result){
            var bdata = eval('(' + result + ')');
            var myChart = new RGraph.Bipolar('myCanvas',bdata.left,bdata.right);
            RGraph.SetConfig(myChart,bdata);
            myChart.Set('colors',['Gradient(red:white:blue)']);
            myChart.Draw();
        };
        function CreatePNG(event){
            RGraph.showPNG(document.getElementById('myCanvas'),event);
            event.preventDefault();
        };
        function RptSwitch(){
            var radios = document.getElementsByName('rpt');
            for(var i = 0, length = radios.length; i < length; i++){
                if(radios[i].checked){
                    var divs = radios[i].value.split(",");
                    document.getElementById(divs[0]).className="";
                    document.getElementById(divs[1]).className="info-hidden";
                    break;
                }
            }
        };
        
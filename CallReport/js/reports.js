        AddListeners();
        
        function AddListeners(){
            document.getElementById('reportlist').addEventListener('change',Chart,false);
            document.getElementById('graphpng').addEventListener('click',CreatePNG,false);
            var radios = document.getElementsByName('rpt');
            for(var i = 0, length = radios.length; i < length; i++){
                document.getElementById(radios[i].id).addEventListener('change',RptSwitch,false);
            }
            document.getElementById('filter').addEventListener('click',ShowHide,false);
            document.getElementById('sort').addEventListener('click',ShowHide,false);
        };        
        function ShowHide(event){
            var boxname = this.id + 'box';
            if(this.innerHTML==='Show'){
                this.innerHTML='Hide';
                document.getElementById(boxname).className='pure-g-r collapsing';
            }else{
                this.innerHTML='Show';
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
        
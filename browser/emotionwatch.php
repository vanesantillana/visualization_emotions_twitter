<?php
$csvFile = file('../ANEW/result/sentimiento1.csv');
$data = [];
foreach ($csvFile as $line) {
    $data[] = str_getcsv($line);
}
$commet_pos = '';
$commet_neg = '';
$all_pos =[];
$all_neg =[];

$type = ["enredo","diversión","orgullo","felicidad","placer","amor","admiración","alivio","sorpresa","nostalgia",
        "lástima","tristeza","preocupación","vergüenza","culpa","lamentar","envidia","asco","desprecio","enfado"];
$sentiment = [
    0 => array(0,0,0,0),
    1 => array(0,0,0,0),
    2 => array(0,0,0,0),
    3 => array(0,0,0,0),
    4 => array(0,0,0,0),
    5 => array(0,0,0,0),
    6 => array(0,0,0,0),
    7 => array(0,0,0,0),
    8 => array(0,0,0,0),
    9 => array(0,0,0,0),
    10 => array(0,0,0,0),
    11 => array(0,0,0,0),
    12 => array(0,0,0,0),
    13 => array(0,0,0,0),
    14 => array(0,0,0,0),
    15 => array(0,0,0,0),
    16 => array(0,0,0,0),
    17 => array(0,0,0,0),
    18 => array(0,0,0,0),
    19 => array(0,0,0,0),
];
for ($i = 1; $i < count($data); $i++) {
    $valence = ($data[$i][0]+1)*19/2; 
    $neg = $data[$i][1];
    //$neu = $data[$i][2];
    $pos = $data[$i][3];

    //$all_pos[] = $pos;
    if($valence!=0){
        $tipo = intval($valence);
        if($neg > $pos){
            $sentiment[$tipo][0] += $neg;
        }else{
            $sentiment[$tipo][0] += $pos;
        }
        $sentiment[$tipo][1] += $pos;      //total pos
        $sentiment[$tipo][2] += $neg;      //total neg               
        $sentiment[$tipo][3] +=1;
        //echo(intval($valence)."<br>");        
    }
}
//print_r($sentiment);
$time1 =[0.0,0.02,0.02,0.21,0.01,0.0,0.15,0.2,0.03,0.0,
        0.3,0.2,0.02,0.05,0.1,0.02,0.25,0.1,0.41,0.02];
$time2 =[0.01,0.0,0.1,0.25,0.2,0.0,0.1,0.02,0.03,0.1,
0.1,0.015,0.12,0.01,0.1,0.01,0.15,0.0,0.32,0.0];
$time3 =[];
for($i=0;$i<20;$i++){
    array_push($time3, ($time1[$i]+$time2[$i])/2); 
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EmotionWatch</title>
    <script src="code/highcharts.js"></script>
    <script src="code/highcharts-more.js"></script>
    <script src="code/modules/data.js"></script>
    <script src="code/modules/exporting.js"></script>
    <script src="code/modules/export-data.js"></script>
    <style type="text/css">
        .conical-grad {
        width: 350px;
        height: 350px;
        position: relative;
        //filter: blur(2px);
        //opacity: 0.6;
        }

        .circle {
        width: 40px;
        height: 40px;
        overflow: hidden;
        position: absolute;
        left: 50%;
        top: 4%;
        border-radius: 50%;
        transform: translate(-50%, 8%);
        background-color: #F5912D;
        }

    </style>
</head>
<body>
    
    <div class="circle"></div>
    <div class="circle" style="background-color: #E66331;top: 5.5%;left: 54%;"></div>
    <div class="circle" style="background-color: #FFB100;top: 9%;left: 58%;"></div>    
    <div class="circle" style="background-color: #E6D53A;top: 14.5%;left: 61%;"></div>    
    <div class="circle" style="background-color: #BAC500;top: 21.5%;left: 63%;"></div>    
    <div class="circle" style="background-color: #BAED70;top: 29.5%;left: 63.8%;"></div>    

    <div class="circle" style="background-color: #3DDE00;top: 5.5%;left: 46%;"></div>
    <div class="circle" style="background-color: #8CF488;top: 9%;left: 42%;"></div>    
    <div class="circle" style="background-color: #00C987;top: 14.5%;left: 39%;"></div>    
    <div class="circle" style="background-color: #6DEFE9;top: 21.5%;left: 37%;"></div>    
    <div class="circle" style="background-color: #48A8F3;top: 29.5%;left: 36.5%;"></div>  
    
    <div class="circle" style="background-color: #0037A8;top: 55%;left: 50%;"></div>
    <div class="circle" style="background-color: #3657DD;top: 53.5%;left: 54%;"></div>
    <div class="circle" style="background-color: #2A2674;top: 49.5%;left: 58%;"></div>    
    <div class="circle" style="background-color: #7559DF;top: 44.5%;left: 61%;"></div>    
    <div class="circle" style="background-color: #7225C2;top: 37%;left: 63%;"></div>    

    <div class="circle" style="background-color: #D421FF;top: 54%;left: 46%;"></div>
    <div class="circle" style="background-color: #6F0070;top: 50%;left: 42%;"></div>    
    <div class="circle" style="background-color: #B11B9F;top: 44%;left: 39%;"></div>    
    <div class="circle" style="background-color: #B11B9F;top: 37%;left: 37%;"></div>

    <div id="container" style="min-width: 420px; max-width: 600px; height: 400px; margin: 0 auto"></div>
    <div style="display:none">
    <table id="freq" border="0" cellspacing="0" cellpadding="0">
        <tr nowrap bgcolor="#CCCCFF">
            <th colspan="9" class="hdr">Table of Frequencies (percent)</th>
        </tr>
        
        <tr nowrap bgcolor="#CCCCFF">
            <th class="freq">Direction</th>
            <th class="freq">Fuerza</th>
        </tr>
        <?php 
            for ($i = 0; $i < count($sentiment); $i++) {
                $value = 0;
                $iter = 19-$i;
                if( $sentiment[$iter][3] > 0){
                    $value = $sentiment[$iter][0] / $sentiment[$iter][3];
                }
                echo '<tr nowrap>
                <td class="dir">'.$type[$i].'</td>
                <td class="data" >'.$time3[$i].'</td>
                </tr>';
            }
        ?>
    </table>
    </div>
    <script type="text/javascript">


        // Parse the data from an inline table using the Highcharts Data plugin
        Highcharts.chart('container', {
        data: {
            table: 'freq',
            startRow: 1,
            endRow: 21,
            endColumn: 1
        },

        chart: {
            polar: true,
            type: 'area',
            backgroundColor:'rgba(255, 255, 255, 0.0)'

        },

        title: {
            text: 'EMOTIONWATCH'
        },


        pane: {
            size: '89%'
        },

        legend: {
            align: 'top',
            verticalAlign: 'top',
            y: 100,
            layout: 'vertical'
        },

        xAxis: {
            tickmarkPlacement: 'on'
        },

        yAxis: {
            min: 0,
            endOnTick: false,
            showLastLabel: true,
            /*title: {
                text: 'Frequency (%)'
            },
            labels: {
                formatter: function () {
                    return this.value + '%';
                }
            },*/
            //reversedStacks: false
        },

        tooltip: {
            valueSuffix: '%'
        },

        plotOptions: {
            series: {
                stacking: 'normal',
                shadow: false,
                groupPadding: 0,
                pointPlacement: 'on'
            }
        }
        });
    </script>
</body>
</html>

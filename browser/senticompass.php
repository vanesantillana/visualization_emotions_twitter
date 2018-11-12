<?php
$csvFile = file('../ANEW/result/sentimiento1.csv');
$data = [];
foreach ($csvFile as $line) {
    $data[] = str_getcsv($line);
}
$total = count($data)-1;
$type = ["desactivación","calma","relajado","sereno","contenido","agradable","contento","exaltado","emocionado","alerta","activación","tenso","nervioso",
        "estresado","trastornado","desagradable","triste","Deprimido","aburrido","adormecido"];
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
    if($valence!=0){
        $tipo = intval($valence);
        /*print_r($data[$i][0].' - '.$valence.' - '.$tipo.'<br>');
        if($neg > $pos){
            $sentiment[$tipo][0] += $neg;
        }else{
            $sentiment[$tipo][0] += $pos;
        }*/
        $sentiment[$tipo][0] += 1;
        $sentiment[$tipo][1] += $pos;      //total pos
        $sentiment[$tipo][2] += $neg;      //total neg               
        $sentiment[$tipo][3] +=1;
        //echo(intval($valence)."<br>");        
    }
}
//print_r($sentiment);
$time1 =[0.0,0.02,0.02,0.21,0.01,0.0,0.15,0.2,0.03,0.0,
        0.3,0.2,0.02,0.05,0.1,0.02,0.25,0.1,0.41,0.02];
/*$time2 =[0.01,0.0,0.1,0.25,0.2,0.0,0.1,0.02,0.03,0.1,
0.1,0.015,0.12,0.01,0.1,0.01,0.15,0.0,0.32,0.0];
*/
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Senticompass</title>
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
        filter: blur(2px);
        //opacity: 0.6;
        }
        .circle {
        border-radius: 50%;
        overflow: hidden;
        position: absolute;
        left: 50%;
        top: 32.8%;
        transform: translate(-50%, -50%);
        }
        .circle2 {
        width: 300px;
        height: 300px;
        position: relative;
        left: 50%;
        border-radius: 50%;
        transform: translate(-50%, 8%);
        background-color: white;
        }
        .conical-grad:before,
        .conical-grad:after {
        position: absolute;
        content: "";
        top: 0;
        bottom: 50%;
        left: 0;
        right: 0;
        background: linear-gradient(18deg, #06f906 50%, transparent 50%),
            linear-gradient(36deg, #00ff40 50%, transparent 50%),
            linear-gradient(54deg, #00ffbf 50%, transparent 50%),
            linear-gradient(72deg, #00bfff 50%, transparent 50%),
            linear-gradient(90deg, #0040ff 50%, transparent 50%),
            linear-gradient(108deg, #4000ff 50%, transparent 50%),
            linear-gradient(126deg, #bf00ff 50%, transparent 50%),
            linear-gradient(144deg, #ff00bf 50%, transparent 50%),
            linear-gradient(162deg, #ff0040 50%, transparent 50%),
            linear-gradient(180deg, #ff0000 50%, transparent 50%);
        background-size: 350px 350px;
        }
        .conical-grad:after {
        bottom: 0;
        background: linear-gradient(18deg, transparent 50%, #ff3300 50%),
            linear-gradient(36deg, transparent 50%, #ff4000 50%),
            linear-gradient(54deg, transparent 50%, #ff8000 50%),
            linear-gradient(72deg, transparent 50%, #ffbf00 50%),
            linear-gradient(90deg, transparent 50%, #fef801 50%),
            linear-gradient(108deg, transparent 50%, #dcfe01 50%),
            linear-gradient(126deg, transparent 50%, #bfff00 50%),
            linear-gradient(144deg, transparent 50%, #80ff00 50%),
            linear-gradient(162deg, transparent 50%, #40ff00 50%),
            linear-gradient(180deg, transparent 50%, #00ff00 50%);
        z-index: -1;
        }

        .conical-grad2 {
        width: 240px;
        height: 240px;
        position: relative;
        //filter: blur(2px);
        //opacity: 0.6;
        }
        .circle1 {
        border-radius: 50%;
        overflow: hidden;
        position: absolute;
        left: 25%;
        top: 83%;
        transform: translate(-50%, -50%);
        }
        .circle12 {
        width: 205px;
        height: 205px;
        position: relative;
        left: 50%;
        border-radius: 50%;
        transform: translate(-50%, 8%);
        background-color: white;
        }
        .conical-grad2:before,
        .conical-grad2:after {
        position: absolute;
        content: "";
        top: 0;
        bottom: 50%;
        left: 0;
        right: 0;
        background: linear-gradient(18deg, #06f906 50%, transparent 50%),
            linear-gradient(36deg, #00ff40 50%, transparent 50%),
            linear-gradient(54deg, #00ffbf 50%, transparent 50%),
            linear-gradient(72deg, #00bfff 50%, transparent 50%),
            linear-gradient(90deg, #0040ff 50%, transparent 50%),
            linear-gradient(108deg, #4000ff 50%, transparent 50%),
            linear-gradient(126deg, #bf00ff 50%, transparent 50%),
            linear-gradient(144deg, #ff00bf 50%, transparent 50%),
            linear-gradient(162deg, #ff0040 50%, transparent 50%),
            linear-gradient(180deg, #ff0000 50%, transparent 50%);
        background-size: 240px 240px;
        }
        .conical-grad2:after {
        bottom: 0;
        background: linear-gradient(18deg, transparent 50%, #ff3300 50%),
            linear-gradient(36deg, transparent 50%, #ff4000 50%),
            linear-gradient(54deg, transparent 50%, #ff8000 50%),
            linear-gradient(72deg, transparent 50%, #ffbf00 50%),
            linear-gradient(90deg, transparent 50%, #fef801 50%),
            linear-gradient(108deg, transparent 50%, #dcfe01 50%),
            linear-gradient(126deg, transparent 50%, #bfff00 50%),
            linear-gradient(144deg, transparent 50%, #80ff00 50%),
            linear-gradient(162deg, transparent 50%, #40ff00 50%),
            linear-gradient(180deg, transparent 50%, #00ff00 50%);
        z-index: -1;
        }
    </style>
</head>
<body>
    
    <div class="circle">
        <div class="conical-grad">
    <div class="circle2"> </div>   
        </div>
    </div>
    <div id="container" style="min-width: 420px; max-width: 600px; height: 400px; margin: 0 auto"></div>
    <div style="display:none">
        <table id="freq" border="0" cellspacing="0" cellpadding="0">
            <tr nowrap bgcolor="#CCCCFF">
                <th colspan="9" class="hdr">SENTICOMPASS</th>
            </tr>
            
            <tr nowrap bgcolor="#CCCCFF">
                <th class="freq">Direction</th>
                <th class="freq">Fuerza 1T</th>
                <!--<th class="freq">Fuerza 2T</th>-->
            </tr>
            <?php 
                for ($i = 0; $i < count($sentiment); $i++) {
                    $value = 0;
                    $iter = 19-$i;
                    if( $sentiment[$iter][3] > 0){
                        $value = $sentiment[$iter][0]/$total;// / $sentiment[$iter][3];
                    }
                    echo '<tr nowrap>
                    <td class="dir">'.$type[$i].'</td>
                    <td class="dir">'.$time1[$iter].'</td>
                    </tr>';
                    /*<td class="data" >'.$time2[$iter].'</td>
                     */
                }
            ?>
        </table>
    </div>
    <!--POSITIVO-->
    <div class="circle1">
        <div class="conical-grad2">
    <div class="circle12"> </div>   
        </div>
    </div>

    <div id="container-pos" style="min-width: 210px; max-width: 500px; height: 300px;margin-left: 5%;"></div>
    <div style="display:none">
        <table id="pos" border="0" cellspacing="0" cellpadding="0">
            <tr nowrap bgcolor="#CCCCFF">
                <th colspan="9" class="hdr">SENTICOMPASS pos</th>
            </tr>
            
            <tr nowrap bgcolor="#CCCCFF">
                <th class="pos">Direction</th>
                <th class="pos">Fuerza</th>
            </tr>
            <?php 
                for ($i = 0; $i < count($sentiment); $i++) {
                    $value = 0;
                    $iter = 19-$i;
                    if( $sentiment[$iter][3] > 0){
                        $value = $sentiment[$iter][1] / $sentiment[$iter][3];
                    }
                    echo '<tr nowrap>
                    <td class="dir">'.$type[$i].'</td>
                    <td class="data" >'.$value.'</td>
                    </tr>';
                }
            ?>
        </table>
    </div>

    <!--Negativo-->
    <div class="circle1" style="left: 74.5%;" >
        <div class="conical-grad2">
    <div class="circle12"> </div>   
        </div>
    </div>

    <div id="container-neg" style="min-width: 210px; max-width: 500px; height: 300px;margin-left: 55%;
margin-top: -300px;"></div>
    <div style="display:none">
        <table id="neg" border="0" cellspacing="0" cellpadding="0">
            <tr nowrap bgcolor="#CCCCFF">
                <th colspan="9" class="hdr">SENTICOMPASS Neg</th>
            </tr>
            
            <tr nowrap bgcolor="#CCCCFF">
                <th class="neg">Direction</th>
                <th class="neg">Fuerza</th>
            </tr>
            <?php 
                for ($i = 0; $i < count($sentiment); $i++) {
                    $value = 0;
                    $iter = 19-$i;
                    if( $sentiment[$iter][3] > 0){
                        $value = $sentiment[$iter][2] / $sentiment[$iter][3];
                    }
                    echo '<tr nowrap>
                    <td class="dir">'.$time1[$iter].'</td>
                    <td class="data" >'.$time2[$iter].'</td>
                    </tr>';
                }
            ?>
        </table>
    </div>
    <div style="margin-bottom: 100px" ></div>
    <script type="text/javascript">
        Highcharts.chart('container', {
            data: {
                table: 'freq',
                startRow: 1,
                endRow: 21,
                endColumn: 2
            },

            chart: {
                polar: true,
                type: 'area',
                backgroundColor:'rgba(255, 255, 255, 0.0)'

            },

            title: {
                text: 'SENTICOMPASS'
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
            },
        });
        Highcharts.chart('container-pos', {
            data: {
                table: 'pos',
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
                text: 'Positivo'
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
        Highcharts.chart('container-neg', {
            data: {
                table: 'neg',
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
                text: 'Negativo'
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

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"></script>
 <script src="http://d3js.org/d3.v3.min.js"></script>
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<link rel="stylesheet" type="text/css" href="style.css">

 <title>Senti Compass </title>
</head>
<body>
 <div class="container" style="padding:10px 10px;">
   <h3>Obtener Comentarios</h3>
   <div class="well">
       <div class="row" id="csv-display" style="height:500px ;overflow: scroll;">
       </div>
   </div>
 </div>
 <div class="row">
        <div class="col-md-12">
            <p class="titu">Elige entre éstas visualizaciones</p>
        </div>
        <div class="col-md-6" style="text-align: center" >
            <a type="button" href="senticompass.php" class="btn btn-circle btn-xl" style="background-color: #00ffd2">
                <p style="padding-top: 45%; color: white">SentiCompass</p> 
            </a>
        </div>
        <div class="col-md-6"style="text-align: center">
            <a type="button" href="emotionwatch.php" class="btn btn-circle btn-xl" style="background-color: #d170db">
                <p style="padding-top: 45%; color: white">EmotionWatch</p>
            </a>
        </div>
    </div>
 <div id="container2" style="height: 100%; min-width: 310px; max-width: 100%; margin: 0 auto"></div>
</body>
</html>

<script type="text/javascript">
$(document).ready(function(){   
   var data;
   $.ajax({
     type: "GET",  
     url: "../ANEW/result/sentimiento1.csv",
     dataType: "text",       
     success: function(response)  
     {
       data = $.csv.toArrays(response);
       generateHtmlTable(data);
     }   
   });
   
   function generateHtmlTable(data) {
       var html = '<table  class="table table-condensed table-hover table-striped">';

     if(typeof(data[0]) === 'undefined') {
       return null;
     } else {
       $.each(data, function( index, row ) {
         //bind header
         if(index == 0) {
           html += '<thead>';
           html += '<tr>';
           $.each(row, function( index, colData ) {
               html += '<th>';
               html += colData;
               html += '</th>';
           });
           html += '</tr>';
           html += '</thead>';
           html += '<tbody>';
         } else {
           html += '<tr>';
           $.each(row, function( index, colData ) {
               html += '<td>';
               html += colData;
               html += '</td>';
           });
           html += '</tr>';
         }
       });
       html += '</tbody>';
       html += '</table>';
       
       $('#csv-display').append(html);
     }
   }
 });
</script>

<!--
<script type="text/javascript">/*
		$(document).ready(function() {
			
			var options = {
				chart: {
					type: 'bubble',
          plotBorderWidth: 1,
          zoomType: 'xy'
				},
				title: {
					text: 'SentiCompass'
				},
				xAxis: {
					title: {
						text: 'valence'
					}
				},
				yAxis: {
					title: {
						text: 'arousal'
					}
				},
				series: []
			};
			
			
			$.get('../ANEW/result/sentimiento.csv', function(data) {
				// Split the lines
				var lines = data.split('\n');
				$.each(lines, function(lineNo, line) {
					var items = line.split(',');
					
					// header line containes categories
					/*if (lineNo == 0) {
						$.each(items, function(itemNo, item) {
							if (itemNo > 0) options.xAxis.categories.push(item);
						});
					}
          */
          
					// the rest of the lines contain data with their name in the first position
					//else {
            /*
						var series = { 
							data: []
						};
						$.each(items, function(itemNo, item) {
							if (itemNo == 0) {
								series.name = item;
							} else {
                series.data.push(parseFloat(item));
                console.log(series.data);
							}
						});
						
						options.series.push(series);
					//}
					
				});
				
				var chart = new Highcharts.Chart('container2',options);
			});
			
			
		});*/
    </script>
    
    <script>
  creditURL = 'https://www.datavizforall.org/highcharts';
  $(function() {
    $.get('../ANEW/result/sentimiento.csv', function(csv) {     // EDIT to match your CSV data file name
      Highcharts.chart('container2', {
        chart: {
          type: 'scatter',
          zoomType: 'xy',
          events: {
            load: function() {
              this.credits.element.onclick = function() {
                window.open(creditURL, '_blank');
              }
            }
          }
        },
        title: {
          text: 'SentiCompass'  // EDIT to insert your chart title
        },
        subtitle: {
          text: 'View <a href="../ANEW/result/sentimiento.csv"> source data</a>', // EDIT link and text
          useHTML: true
        },
        data: {
          csv: csv,
          // data column headers (x, y, name...) must match column numbers (0, 1, 2...). Optional: category: 3
          seriesMapping: [{x: 0, y: 1, name: 2}],
          complete: function(data) {
            categoriesIntoSeries(data);
            changeSeriesColors(data);
            changeSeriesMarkers(data)
          }
        },
        legend: {
          enabled: false  // EDIT to true if using more than one category, color, shape
        },
        xAxis: {
          title: {
            text: 'Valence'  // EDIT to insert horizontal x-axis label
          }
        },
        yAxis: {
          title: {
            text: 'Arousal'   // EDIT to insert vertical y-axis label
          }
        },
        plotOptions: {
            scatter: {
                marker: {
                    radius: 5,
                    states: {
                        hover: {
                          enabled: true,
                        }
                    }
                },
                stickyTracking: false,
            }
        },
        tooltip: {
            useHTML: true,
            formatter: function() {
              point = this.point;
              // EDIT tooltip text labels below to match your data
              html = '<table>';
              html += '<tr><th colspan="2"><h3>District: ' + point.name + '</h3></th></tr>';
              html += '<tr><th>Median household income:</th><td>$' + comma(point.x) + '</td></tr>';
              html += '<tr><th>Grades above/below average:</th><td>' + point.y + '</td></tr>';
              html += '</table>';
              return html;
            },
            followPointer: true,
            hideDelay: 50
        },
        credits: {
          enabled: true,
          text: 'View Highcharts.com template by DataVizForAll.org',
          href: creditURL,
        },
      });
    });
  });
  // Split data based on 'category' property; needed for correct legend display
  function categoriesIntoSeries(data) {
    rows = data.series[0].data;
    data.series = [];
    for (i = 0; i < rows.length; i++) {
      cat = rows[i].category;
      catExists = false;
      for (j = 0; j < data.series.length; j++) {
        if (data.series[j].name == cat) {
          // Add a data point to existing series
          data.series[j].data.push(rows[i]);
          catExists = true;
        }
      }
      if (!catExists) {
        // When category is encountered for the first time, create a series
        data.series.push({name: cat, data: [rows[i]]})
      }
    }
  }
  // Customize colors of series
  function changeSeriesColors(data) {
    colors = {
      'SampleCategory1': 'rgba(100, 0, 0, 0.3)', // to add transparency, define colors in rgba() model, where the last number is between 0 and 1 (opacity)
      'SampleCategory2': 'red'
    }
    for (i = 0; i < data.series.length; i++) {
      data.series[i].color = colors[data.series[i].name] || 'rgba(51, 102, 255, 0.5)';
    }
  }
  // Customize markers of scatter series. Possible options are:
  // 'circle', 'square', 'diamond', 'triangle', 'triangle-down'
  function changeSeriesMarkers(data) {
    markers = {
      'SampleCategory1': 'circle',
      'SampleCategory2': 'triangle'
    }
    for (i = 0; i < data.series.length; i++) {
      data.series[i].marker = {symbol: markers[data.series[i].name] || 'circle'};
    }
  }
  // Returns a string that contains digits of val split by comma evey 3 positions
  // Example: 12345678 -> "12,345,678"
  function comma(val) {
      while (/(\d+)(\d{3})/.test(val.toString())) {
          val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
      }
      return val;
  }
  </script>
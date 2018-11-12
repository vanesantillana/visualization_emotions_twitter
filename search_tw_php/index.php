<?php 

include "twitteroauth/twitteroauth.php";

$consumer_key = "XnIYDS57O52dL0jqLe1tHJXk0";
$consumer_secret = "brO7q47DPVMPigqtN7OoCia5JHAV3EmgQv72oDsE2X6AUarjQ0";
$access_token = "999323137836756992-hGbNHbAOQPmK6WI87RvQJaYiS2rnz80";
$access_token_secret = "TimbW0tB3TtrjPmYhOHfLgDN40xEEy9kwXMDUwnOxuRds";

$twitter = new TwitterOAuth($consumer_key,$consumer_secret,$access_token,$access_token_secret);

$myfile = fopen("../ANEW/result/coments.csv", "w") or die("Unable to open file!");

$list = array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Twitter API SEARCH</title>
</head>
<body>
	<form action="" method="post">
		<label>Buscar:</label>
		<input type="text" name="dato"/>
		<input type="number" name="cant"/>
		<input type="submit" value="Enviar">
	</form>

	<?php //print_r($tweets); 
		if(isset($_POST['dato']) and isset($_POST['cant'])){
			//$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=trump&lang=en&since=2014-12-21');
			$tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q='.$_POST['dato'].'&lang=en&result_type=recent&count='.$_POST['cant']);
			//print_r($tweets);
			foreach ($tweets->statuses as $key => $tweet) {
				echo '<img src="'.$tweet->user->profile_image_url.'"/> '.$tweet->created_at.' : '.$tweet->text.'<br>';
				array_push($list,preg_replace("/[\r\n|\n|\r]+/", " ", $tweet->text));
				//fputcsv($myfile, $tweet);
				//fwrite($myfile, $tweet->text);
				//fwrite($myfile,"\n");
	
			}
			foreach ($list as $line){
				fputcsv($myfile,explode(',',$line));
			}
			/*foreach ($tweets as $tweet ) {
				foreach ($tweet as $t) {
					echo '<img src="'.$t->user->profile_image_url.'" />'.$t->text.'<br>';
				}
			}*/

		}
	?>
<?php 
fclose($myfile);
/*foreach ($tweets->statuses as $key => $tweet) { ?>
    Tweet : <img src="<?=$tweet->user->profile_image_url;?>" /><?=$tweet->text; ?><br>
<?php }
*/
?>
  

</body>
</html>
<html>
  <head>
    <title>Using PHP and Bing Maps REST Services Routes API</title>
  </head>
  <body>
    <form action="testMap.php" method="post">
      Bing Maps Key: <input type="text" name="key" value="ApfBSk5syb5hQ937V73FxwcqsVgS9vip_bCKIlULcdxiq1CWwM6N8wz7uujZ35Gg"<?php echo (isset($_POST['key'])?$_POST['key']:'') ?>"><br>
        Origin: <input type="text" name="origin" value="Rue de la Gare, 95820 Bruyères-sur-Oise, France"<?php echo (isset($_POST['origin'])?$_POST['origin']:'') ?>"><br>
          Destination: <input type="text" name="destination" value="139 boulevard robert ballanger"<?php echo (isset($_POST['destination'])?$_POST['destination']:'') ?>"><br>
            <input type="submit" value="Submit">
  </form>
<?php

include 'BingMapsHelperFunctions.php';

if(isset($_POST['key']) && isset($_POST['origin']) && isset($_POST['destination']))
{
  // Set default map width and height
  $mapWidth = 300;
  $mapHeight = 300;

  // URL of Bing Maps REST Routes API;
  $baseURL = "http://dev.virtualearth.net/REST/v1/Routes";

  // Set key based on user input
  $key = $_POST['key'];

  // construct parameter variables for Routes call
  $wayPoint0 = str_ireplace(" ","%20",$_POST['origin']);
  $wayPoint1 = str_ireplace(" ","%20",$_POST['destination']);
  $optimize = "time";
  $routePathOutput = "Points";
  $distanceUnit = "km";
  $travelMode = "Driving";

  // Construct final URL for call to Routes API
  $routesURL = $baseURL."/".$travelMode."?wp.0=".$wayPoint0."&wp.1=".$wayPoint1."&optimize=".$optimize."&routePathOutput=".$routePathOutput."&distanceUnit=".$distanceUnit."&output=xml&setLang=fr&key=".$key;

  // Get output from API and convert to XML element using php_xml
  $output = file_get_contents($routesURL);
  $response = new SimpleXMLElement($output);

  // Extract and print number of routes from response
  $numRoutes = $response->ResourceSets->ResourceSet->EstimatedTotal;
  echo "Number of routes found: ".$numRoutes."<br>";

  // Extract and print route instructions from response
  $itinerary = $response->ResourceSets->ResourceSet->Resources->Route->RouteLeg->ItineraryItem;

  echo "<ol>";
  for ($i = 0; $i < count($itinerary); $i++) {
    $instruction = $itinerary[$i]->Instruction;

echo "<li>".$instruction."</li>";
  }
  echo "</ol>";

}
else
{
  echo "<p>Please enter your Bing Maps key and complete all address fields, then click submit.</p>";
}
?>
</body>
</html>
<?php
/*
Plugin Name: Chsites
Plugin URI: #
Description: Chsites de api
Author: FRANK B

*/

defined("ABSPATH") or die("Salir");


function conectarAPI()
{
  $con = curl_init();

  $miapi = "https://api.chucknorris.io/jokes/random";

  curl_setopt($con, CURLOPT_URL, $miapi);
  curl_setopt($con, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($con, CURLOPT_HEADER, false);
  curl_setopt($con, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));

  $resultadapi = curl_exec($con);

  curl_close($con);

  return json_decode($resultadapi, true);
}

function func_mis_chistes()
{
  $i = 0;
  $mischistes = [];
  $listaID = [];
  while ($i < 25) {
    $cicloactual = conectarAPI();
    if (!in_array($cicloactual["id"], $listaID)) {
      $listaID[$i] = $cicloactual["id"];
      //echo $i;
      $mischistes[$i] = [
        "id" => $cicloactual["id"],
        "value" => $cicloactual["value"],
        "url" => $cicloactual["url"]
      ];
      $i++;
    }
  }

  $lista_chistes = "";

$lista_chistes .= "<ol>";
foreach($mischistes as $chiste){
  $lista_chistes .= "<li> <span>".$chiste["id"]."</span> <a href='".$chiste["url"]."' target='_blank'>". $chiste["value"] . "</a></li>";
}
$lista_chistes .= "</ol>";

return $lista_chistes;
}

add_shortcode("lista_chistes", "func_mis_chistes");

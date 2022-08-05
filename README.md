## Plugin

El Plugin lista 25 chistes únicos utilizando este shortcode `[lista_chistes]`

Esta función se conecta a la API dada y retorna un objeto json decodificado

```
function conectarAPI()
{
  $con = curl_init();

  $miapi = "https://api.chucknorris.io/jokes/random";

  curl_setopt($con, CURLOPT_URL, $miapi);
  curl_setopt($con, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($con, CURLOPT_HEADER, false);
  curl_setopt($con, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));

  $resultadapi = curl_exec($con);

  curl_close($con);...

```



Esta función implementa la lógica para clasificar los ids únicos

```
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
  }...

```


### Resultado de la implementación

![image](https://user-images.githubusercontent.com/32855821/182989705-a0894411-31fa-463f-b23e-15ffccd17b66.png)
...

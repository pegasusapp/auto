<?php


//Meti mano en requerimeinto para Andres Badillo

$videoURLs = array(
    "https://www.youtube.com/watch?v=CYqnIJVmw5g",
    "https://www.youtube.com/watch?v=r5OONGmRORY",
    "https://www.youtube.com/watch?v=3jKDHWEEzt4"
);

// Recorrer la lista de URLs de videos
foreach ($videoURLs as $videoURL) {
    // Extraer el ID del video de la URL
    parse_str(parse_url($videoURL, PHP_URL_QUERY), $videoParams);
    $videoID = $videoParams['v'];

    // Obtener el título del video
    $videoInfo = file_get_contents("https://www.youtube.com/oembed?url=" . $videoURL . "&format=json");
    $videoInfo = json_decode($videoInfo);
    $videoTitle = $videoInfo->title;

    // Generar el código HTML para embeber el video con título y enlace
   
    $embedCode = '<div style="width: 345px; height: 200px; display: inline-block; margin: 10px; padding-right:5px">';
    $embedCode .= '<a href="' . $videoURL . '" target="_blank">' . $videoTitle . '</a>';
    $embedCode .= '<iframe width="345" height="200" src="https://www.youtube.com/embed/' . $videoID . '" frameborder="0" allowfullscreen></iframe>';
 
        $embedCode .= '</div>';

    // Imprimir el código HTML para mostrar el video con título y enlace
    echo $embedCode;
	
}
echo '<br>';
//Meti mano en requerimeinto para Andres Badillo

?>
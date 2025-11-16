<?php
/**
 * INSTRUCCIONS:
 * 
 * Opció 1 - Des del navegador:
 * Visita: http://cataclismo.local/wp-content/themes/wordpress-theme/import-cataclismo.php
 * 
 * Opció 2 - Des del terminal:
 * cd "/Users/rogermasellas/Local Sites/cataclismo/app/public"
 * php -r "require 'wp-load.php'; require 'wp-content/themes/wordpress-theme/import-cataclismo.php';"
 */

// Carregar WordPress
$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if (file_exists($wp_load_path)) {
    require_once($wp_load_path);
} else {
    die('No es pot trobar wp-load.php');
}

echo "<h1>Importació de contingut Cataclismo</h1>";
echo "<p>Creant posts i pàgines...</p>";

// Array amb tots els artistes
$artistes = array(
    array(
        'title' => '¡A Fiskales Ad-Hok!',
        'subtitle' => 'Hardcore Punk desde 1987',
        'content' => '¡A Fiskales Ad-Hok! és una banda emblemàtica del hardcore punk llatinoamericà, activa des de 1987. Amb un so contundent i un missatge social directe, representen l\'esperit més pur del punk underground. La seva música combina la intensitat del hardcore amb lletres compromeses que parlen de la realitat social i política.'
    ),
    array(
        'title' => 'Tomás Íves',
        'subtitle' => 'Arte Urbano - Muralismo y Graffiti',
        'content' => 'Tomás Íves és un artista urbà especialitzat en muralisme i graffiti. El seu treball transforma espais urbans en galeries a l\'aire lliure, portant l\'art a la gent. Amb un estil únic que fusiona colors vibrants i formes orgàniques, Tomás crea murals que capturen l\'essència de la cultura urbana contemporània.'
    ),
    array(
        'title' => 'Erika Fritz',
        'subtitle' => 'La que nació de día - Bailaora y Música Percusionista',
        'content' => 'Erika Fritz, coneguda com "La que nació de día", és una bailaora i música percusionista que fusiona el flamenc tradicional amb elements contemporanis. La seva energia escènica i la seva capacitat per transmetre emocions a través del ball i la percussió la converteixen en una artista única i captivadora.'
    ),
    array(
        'title' => 'Los Peores de Chile',
        'subtitle' => 'Rock and Roll Punk Blues Salvaje',
        'content' => 'Los Peores de Chile són una banda que fusiona rock and roll, punk i blues en un còctel explosiu i salvatge. El seu so directe i sense filtres captura l\'esperit rebel del rock underground. Amb una actitud desafiadora i un estil musical que barreja influències diverses, la banda ofereix concerts energètics i inoblidables.'
    ),
    array(
        'title' => 'Descargo y Maleficio',
        'subtitle' => 'Música Delirante y Performance',
        'content' => 'Descargo y Maleficio és un projecte que combina música delirante amb performance art, creant experiències sensorials úniques que traslladen l\'audiència a dimensions alternatives. Les seves actuacions són rituals sonors que fusionen elements teatrals, visuals i musicals en un espectacle immersiu i impactant.'
    ),
    array(
        'title' => 'Hirlonegro',
        'subtitle' => 'Rock Stoner',
        'content' => 'Hirlonegro és una banda de rock stoner que ofereix riffs pesats i hipnòtics inspirats en el millor del rock psicodèlic i el heavy rock dels 70. El seu so dens i atmosfèric crea paisatges sonors que transporten l\'oient a través de viatges musicals intensos i embriagadors.'
    )
);

// Crear posts per cada artista
$posts_creats = 0;
foreach ($artistes as $artista) {
    // Comprovar si ja existeix
    $existing = get_page_by_title($artista['title'], OBJECT, 'post');
    
    if (!$existing) {
        $post_data = array(
            'post_title'    => $artista['title'],
            'post_content'  => '<h2>' . $artista['subtitle'] . '</h2><p>' . $artista['content'] . '</p>',
            'post_status'   => 'publish',
            'post_type'     => 'post',
            'post_author'   => 1
        );
        
        $post_id = wp_insert_post($post_data);
        
        if ($post_id) {
            echo "<p>✅ Post creat: <strong>" . $artista['title'] . "</strong> (ID: $post_id)</p>";
            $posts_creats++;
        } else {
            echo "<p>❌ Error creant: " . $artista['title'] . "</p>";
        }
    } else {
        echo "<p>⚠️ Ja existeix: <strong>" . $artista['title'] . "</strong></p>";
    }
}

// Crear pàgina de contacte
$existing_page = get_page_by_title('Contacte', OBJECT, 'page');

if (!$existing_page) {
    $contacte_content = '<div style="max-width: 800px; margin: 0 auto; padding: 40px 20px;">
    <h1 style="text-align: center; font-size: 2.5em; margin-bottom: 20px;">Contacte</h1>
    
    <div style="background: #f5f5f5; padding: 30px; border-radius: 10px; margin-bottom: 30px;">
        <h2 style="color: #333; margin-bottom: 20px;">Cataclismo Producciones</h2>
        <p style="font-size: 1.1em; line-height: 1.8; color: #555;">Barcelona, Catalunya</p>
    </div>

    <div style="background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <h3 style="color: #333; margin-bottom: 20px;">Informació de contacte</h3>
        
        <p style="font-size: 1.1em; margin-bottom: 15px;">
            <strong>Persona de contacte:</strong><br>
            Cristián Mella Pizarro
        </p>
        
        <p style="font-size: 1.1em; margin-bottom: 15px;">
            <strong>Email:</strong><br>
            <a href="mailto:producciones.cataclismo@gmail.com" style="color: #0073aa; text-decoration: none;">
                producciones.cataclismo@gmail.com
            </a>
        </p>
        
        <p style="font-size: 1.1em; margin-bottom: 15px;">
            <strong>Telèfon:</strong><br>
            <a href="tel:+34668536380" style="color: #0073aa; text-decoration: none;">
                +34 668 536 380
            </a>
        </p>
    </div>

    <div style="margin-top: 40px; padding: 30px; background: #0073aa; color: #fff; border-radius: 10px; text-align: center;">
        <h3 style="color: #fff; margin-bottom: 15px;">Vols contractar algun dels nostres artistes?</h3>
        <p style="font-size: 1.1em;">No dubtis en posar-te en contacte amb nosaltres. Estarem encantats d\'atendre la teva consulta.</p>
    </div>
</div>';

    $page_data = array(
        'post_title'    => 'Contacte',
        'post_content'  => $contacte_content,
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_name'     => 'contacte',
        'post_author'   => 1
    );
    
    $page_id = wp_insert_post($page_data);
    
    if ($page_id) {
        echo "<p>✅ Pàgina creada: <strong>Contacte</strong> (ID: $page_id)</p>";
    } else {
        echo "<p>❌ Error creant la pàgina de contacte</p>";
    }
} else {
    echo "<p>⚠️ La pàgina de Contacte ja existeix</p>";
}

echo "<hr>";
echo "<h2>Resum:</h2>";
echo "<p><strong>$posts_creats</strong> posts creats correctament!</p>";
echo "<p>Ara pots veure'ls al teu WordPress:</p>";
echo "<ul>";
echo "<li><a href='" . home_url() . "' target='_blank'>Veure la home</a></li>";
echo "<li><a href='" . admin_url('edit.php') . "' target='_blank'>Veure posts al WordPress admin</a></li>";
echo "<li><a href='" . home_url('/contacte') . "' target='_blank'>Veure pàgina de contacte</a></li>";
echo "</ul>";
?>

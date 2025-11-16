<?php
/**
 * Script per crear pàgines de serveis de Cataclismo
 * Basat en el PDF CATACLISMO_SIN_VALORES_20250803_182241_0000.pdf
 */

// Carregar WordPress
$wp_load_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/wp-load.php';
if (file_exists($wp_load_path)) {
    require_once($wp_load_path);
} else {
    die('No es pot trobar wp-load.php');
}

echo "<h1>Creació de pàgines de Serveis Cataclismo</h1>";
echo "<p>Creant pàgines...</p>";

// Pàgina 1: Què és Cataclismo?
$page_que_es = array(
    'post_title' => 'Què és Cataclismo?',
    'post_content' => '<div style="max-width: 900px; margin: 0 auto; padding: 40px 20px;">
    <h1 style="text-align: center; font-size: 2.8em; margin-bottom: 40px; color: #333;">Què és Cataclismo Producciones?</h1>
    
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 40px; border-radius: 15px; margin-bottom: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
        <p style="font-size: 1.3em; line-height: 1.8; margin-bottom: 20px;">
            Cataclismo Producciones és la figura representativa de <strong>Cristián Mella</strong>, gestor i productor cultural resident a Barcelona.
        </p>
        <p style="font-size: 1.2em; line-height: 1.8;">
            El seu treball s\'ha concentrat a partir de l\'any 2012, generant itineràncies artístiques tant a Xile com a Llatinoamèrica i Europa a través de gires de grups musicals.
        </p>
    </div>

    <h2 style="font-size: 2.2em; margin: 50px 0 30px; color: #333; border-bottom: 3px solid #667eea; padding-bottom: 15px;">Les nostres àrees d\'actuació</h2>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-top: 40px;">
        <div style="background: #fff; padding: 35px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #667eea;">
            <h3 style="color: #667eea; font-size: 1.6em; margin-bottom: 20px;">📋 Gestió i Producció</h3>
            <p style="font-size: 1.1em; line-height: 1.7; color: #555;">
                Elaboració de projectes de circulació a l\'estranger, creació de perfils culturals d\'artistes i gestió integral de projectes musicals.
            </p>
        </div>
        
        <div style="background: #fff; padding: 35px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #764ba2;">
            <h3 style="color: #764ba2; font-size: 1.6em; margin-bottom: 20px;">🎸 Booking</h3>
            <p style="font-size: 1.1em; line-height: 1.7; color: #555;">
                Representació d\'artistes de diferents disciplines, gestió de concerts, gires i tot el que necessita un artista per desenvolupar la seva carrera internacional.
            </p>
        </div>
    </div>

    <div style="background: #f8f9fa; padding: 40px; border-radius: 12px; margin-top: 50px; text-align: center;">
        <h3 style="font-size: 1.8em; margin-bottom: 20px; color: #333;">💼 Experiència Internacional</h3>
        <p style="font-size: 1.2em; line-height: 1.8; color: #555;">
            Amb més d\'una dècada d\'experiència, Cataclismo Producciones ha portat artistes xilens i llatinoamericans als escenaris d\'Europa, i viceversa, creant ponts culturals i oportunitats per al desenvolupament artístic internacional.
        </p>
    </div>
</div>',
    'post_status' => 'publish',
    'post_type' => 'page',
    'post_name' => 'que-es-cataclismo',
    'post_author' => 1
);

$existing = get_page_by_title('Què és Cataclismo?', OBJECT, 'page');
if (!$existing) {
    $page_id = wp_insert_post($page_que_es);
    if ($page_id) {
        echo "<p>✅ Pàgina creada: <strong>Què és Cataclismo?</strong> (ID: $page_id)</p>";
    }
} else {
    echo "<p>⚠️ La pàgina 'Què és Cataclismo?' ja existeix</p>";
}

// Pàgina 2: Gestió i Producció
$page_gestio = array(
    'post_title' => 'Gestió i Producció',
    'post_content' => '<div style="max-width: 900px; margin: 0 auto; padding: 40px 20px;">
    <h1 style="text-align: center; font-size: 2.8em; margin-bottom: 40px; color: #333;">Gestió i Producció</h1>
    
    <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 40px; border-radius: 15px; margin-bottom: 50px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
        <p style="font-size: 1.3em; line-height: 1.8; text-align: center;">
            Oferim un servei integral de gestió cultural i producció d\'esdeveniments artístics, especialitzat en la circulació internacional d\'artistes.
        </p>
    </div>

    <h2 style="font-size: 2.2em; margin: 50px 0 30px; color: #333; border-bottom: 3px solid #f5576c; padding-bottom: 15px;">Els nostres serveis</h2>
    
    <div style="display: grid; gap: 25px; margin-top: 40px;">
        
        <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #f093fb;">
            <h3 style="color: #f5576c; font-size: 1.5em; margin-bottom: 15px;">📝 Creació i elaboració de perfils culturals d\'artistes</h3>
            <p style="font-size: 1.1em; line-height: 1.7; color: #555;">
                Desenvolupem perfils professionals complets que destaquin les fortaleses i la trajectòria dels artistes, essencials per a presentacions a festivals, sales i promotors.
            </p>
        </div>

        <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #f093fb;">
            <h3 style="color: #f5576c; font-size: 1.5em; margin-bottom: 15px;">📄 Elaboració de projectes</h3>
            <p style="font-size: 1.1em; line-height: 1.7; color: #555; margin-bottom: 15px;">
                Especialistes en la preparació de projectes per al <strong>Fondo de la Música, Línea de Circulación en el Extranjero</strong> del Ministerio de la Cultura, las Artes y el Patrimonio de Chile.
            </p>
            <p style="font-size: 1.1em; line-height: 1.7; color: #555;">
                Coneixem els requisits i criteris d\'avaluació, maximitzant les possibilitats d\'èxit en les sol·licituds de finançament.
            </p>
        </div>

        <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #f093fb;">
            <h3 style="color: #f5576c; font-size: 1.5em; margin-bottom: 15px;">💼 Rendició de projectes</h3>
            <p style="font-size: 1.1em; line-height: 1.7; color: #555;">
                Gestionem tota la documentació i rendició de comptes necessària per complir amb els requisits dels organismes financers, assegurant la transparència i el correcte ús dels recursos.
            </p>
        </div>

    </div>

    <div style="background: #f8f9fa; padding: 40px; border-radius: 12px; margin-top: 50px; text-align: center;">
        <h3 style="font-size: 1.8em; margin-bottom: 20px; color: #333;">🌍 Experiència comprovada</h3>
        <p style="font-size: 1.2em; line-height: 1.8; color: #555;">
            Hem gestionat amb èxit nombrosos projectes de circulació internacional, facilitant que artistes xilens i llatinoamericans portin la seva música i art a escenaris europeus.
        </p>
    </div>
</div>',
    'post_status' => 'publish',
    'post_type' => 'page',
    'post_name' => 'gestio-i-produccio',
    'post_author' => 1
);

$existing = get_page_by_title('Gestió i Producció', OBJECT, 'page');
if (!$existing) {
    $page_id = wp_insert_post($page_gestio);
    if ($page_id) {
        echo "<p>✅ Pàgina creada: <strong>Gestió i Producció</strong> (ID: $page_id)</p>";
    }
} else {
    echo "<p>⚠️ La pàgina 'Gestió i Producció' ja existeix</p>";
}

// Pàgina 3: Booking
$page_booking = array(
    'post_title' => 'Booking',
    'post_content' => '<div style="max-width: 900px; margin: 0 auto; padding: 40px 20px;">
    <h1 style="text-align: center; font-size: 2.8em; margin-bottom: 40px; color: #333;">Booking</h1>
    
    <div style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: #333; padding: 40px; border-radius: 15px; margin-bottom: 50px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
        <p style="font-size: 1.3em; line-height: 1.8; text-align: center; font-weight: 600;">
            Servei integral de representació i gestió de concerts per a artistes de diferents disciplines
        </p>
    </div>

    <h2 style="font-size: 2.2em; margin: 50px 0 30px; color: #333; border-bottom: 3px solid #fa709a; padding-bottom: 15px;">Què oferim</h2>
    
    <div style="display: grid; gap: 25px; margin-top: 40px;">
        
        <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #fa709a;">
            <h3 style="color: #fa709a; font-size: 1.5em; margin-bottom: 15px;">🤝 Contacte amb promotors i sales de concerts</h3>
            <p style="font-size: 1.1em; line-height: 1.7; color: #555;">
                Mantenim una xarxa consolidada de contactes amb promotors, sales i festivals a Europa i Llatinoamèrica per garantir les millors oportunitats per als nostres artistes.
            </p>
        </div>

        <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #fa709a;">
            <h3 style="color: #fa709a; font-size: 1.5em; margin-bottom: 15px;">💰 Venta i/o acord per show</h3>
            <p style="font-size: 1.1em; line-height: 1.7; color: #555;">
                Negociem les millors condicions econòmiques per a cada concert, amb montos acordats prèviament amb cada banda, garantint transparència i professionalitat.
            </p>
        </div>

        <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #fa709a;">
            <h3 style="color: #fa709a; font-size: 1.5em; margin-bottom: 15px;">🎛️ Cobertura dels requeriments necessaris per a cada show</h3>
            <p style="font-size: 1.1em; line-height: 1.7; color: #555;">
                Ens encarreguem que cada concert tingui tot el necessari: rider tècnic, hospitalitat, allotjament i qualsevol requeriment especial de l\'artista.
            </p>
        </div>

        <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #fa709a;">
            <h3 style="color: #fa709a; font-size: 1.5em; margin-bottom: 15px;">🚐 Gestió d\'lloguer de transport</h3>
            <p style="font-size: 1.1em; line-height: 1.7; color: #555;">
                Organitzem el transport necessari per a les gires, assegurant desplaçaments còmodes i puntuals entre ciutats i països.
            </p>
        </div>

        <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #fa709a;">
            <h3 style="color: #fa709a; font-size: 1.5em; margin-bottom: 15px;">👨‍💼 Tour Manager</h3>
            <p style="font-size: 1.1em; line-height: 1.7; color: #555;">
                Acompanyament professional durant tota la gira per coordinar logística, horaris i assegurar que tot funcioni perfectament.
            </p>
        </div>

        <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #fa709a;">
            <h3 style="color: #fa709a; font-size: 1.5em; margin-bottom: 15px;">📅 Pla de treball diari de la banda</h3>
            <p style="font-size: 1.1em; line-height: 1.7; color: #555;">
                Elaborem itineraris detallats amb horaris de soundcheck, concerts, entrevistes i temps lliure, optimitzant cada dia de la gira.
            </p>
        </div>

        <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #fa709a;">
            <h3 style="color: #fa709a; font-size: 1.5em; margin-bottom: 15px;">📢 Gestió amb agències de promoció i difusió</h3>
            <p style="font-size: 1.1em; line-height: 1.7; color: #555;">
                Coordinem amb agències de premsa i comunicació per maximitzar la visibilitat dels artistes en mitjans, xarxes socials i plataformes digitals.
            </p>
        </div>

        <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #fa709a;">
            <h3 style="color: #fa709a; font-size: 1.5em; margin-bottom: 15px;">👕 Gestió de merchandising</h3>
            <p style="font-size: 1.1em; line-height: 1.7; color: #555;">
                Organitzem la venda de productes oficials als concerts, gestionant stock, logística i punts de venda per optimitzar els ingressos dels artistes.
            </p>
        </div>

        <div style="background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #fa709a;">
            <h3 style="color: #fa709a; font-size: 1.5em; margin-bottom: 15px;">🎸 Gestió de bandes suport</h3>
            <p style="font-size: 1.1em; line-height: 1.7; color: #555;">
                Seleccionem i coordinem les bandes teloneres adequades per a cada concert, creant sinergies entre artistes i enriquint l\'experiència del públic.
            </p>
        </div>

    </div>

    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 40px; border-radius: 12px; margin-top: 50px; text-align: center;">
        <h3 style="font-size: 1.8em; margin-bottom: 20px;">🎵 Servei 360° per a artistes</h3>
        <p style="font-size: 1.2em; line-height: 1.8;">
            Ens encarreguem de tots els aspectes logístics i de producció perquè l\'artista es pugui centrar únicament en el més important: la seva música i actuació.
        </p>
    </div>
</div>',
    'post_status' => 'publish',
    'post_type' => 'page',
    'post_name' => 'booking',
    'post_author' => 1
);

$existing = get_page_by_title('Booking', OBJECT, 'page');
if (!$existing) {
    $page_id = wp_insert_post($page_booking);
    if ($page_id) {
        echo "<p>✅ Pàgina creada: <strong>Booking</strong> (ID: $page_id)</p>";
    }
} else {
    echo "<p>⚠️ La pàgina 'Booking' ja existeix</p>";
}

echo "<hr>";
echo "<h2>Resum:</h2>";
echo "<p>Pàgines de serveis creades correctament!</p>";
echo "<ul>";
echo "<li><a href='" . home_url('/que-es-cataclismo') . "' target='_blank'>Què és Cataclismo?</a></li>";
echo "<li><a href='" . home_url('/gestio-i-produccio') . "' target='_blank'>Gestió i Producció</a></li>";
echo "<li><a href='" . home_url('/booking') . "' target='_blank'>Booking</a></li>";
echo "</ul>";
?>

<?php


/**
 *  OME
 *  20151107
 *  photon_scripts()
 *  @param: none
 *  @return: none
 */
function photon_scripts() {
  // Enqueue our scripts and styles here.

  // Bootstrap
  wp_enqueue_style( 'style-bootstrap', get_template_directory_uri() . '/bower_components/bootstrap/dist/css/bootstrap.min.css' );
  wp_enqueue_script( 'script-jquery', get_template_directory_uri() . '/bower_components/jquery/dist/jquery.min.js', array(), '1.0.0', true );
  wp_enqueue_script( 'script-bootstrap', get_template_directory_uri() . '/bower_components/bootstrap/dist/js/bootstrap.min.js', array(), '1.0.0', true );

  // Custom css
  wp_enqueue_style( 'style-custom', get_template_directory_uri() . '/inc/css/custom.css' );
  // Custom js
  wp_enqueue_script( 'script-custom', get_template_directory_uri() . '/inc/js/custom.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'photon_scripts');

/*
------- sidebar -------
*/

if (function_exists('register_sidebars')) {
    register_sidebars(1);
}



/*
------- theme options -------
*/

if (!get_option ('photon_custom_stylesheet_name')) add_option ('photon_custom_stylesheet_name', 'default.css');
if (!get_option ('photon_sidebar_align')) add_option ('photon_sidebar_align', 'left');
if (!get_option ('photon_index_post_length')) add_option ('photon_index_post_length', 'excerpt');
if (!get_option ('photon_header_style')) add_option ('photon_header_style', 'wide');

add_action ('admin_menu', 'photon_add_menu');



function photon_clear_options () {
    delete_option ('photon_custom_stylesheet_name');
    delete_option ('photon_sidebar_align');
    delete_option ('photon_index_post_length');
    delete_option ('photon_header_style');
}

function photon_add_menu () {
    add_submenu_page ('themes.php', 'Photon Options', 'Photon Options', 5, __FILE__, 'photon_menu');
}

function photon_menu () {
    if ($_REQUEST ['submit']) {
        photon_update_options ();
    }

    echo '<div class="wrap">';
    echo '<h2>Photon Options</h2>';
    photon_options_form ();
    echo '</div>';
}

function photon_update_options () {

    $updated = false;

    if ($_REQUEST ['stylesheet']) {
        update_option ('photon_custom_stylesheet_name', $_REQUEST ['stylesheet']);
        update_option ('photon_sidebar_align', $_REQUEST ['sidebaralign']);
        update_option ('photon_index_post_length', $_REQUEST ['indexpostlength']);
        update_option ('photon_header_style', $_REQUEST ['headerstyle']);
        $updated = true;
    }

    if ($updated) {
		echo '<div id="message" class="updated fade">';
		echo '<p>Options updated</p>';
		echo '</div>';
    }

}

function photon_options_form () {

    $files = photon_get_custom_styles ();
    $cust_ss_name = get_option ('photon_custom_stylesheet_name');

    $sidebaralign = get_option ('photon_sidebar_align');
    $indexpostlength = get_option ('photon_index_post_length');
    $headerstyle = get_option ('photon_header_style');

    echo '<form method="post">' . "\n";
    echo '<p>Stylesheet:<br />' . "\n";
    echo '<select name="stylesheet">' . "\n";

    foreach ($files as $file) {
        echo "<option value=\"$file\"";

        if ($cust_ss_name == $file)
            echo " selected=\"selected\"";

        echo ">$file</option>\n";
    }

    echo '</select></p>' . "\n";

    echo '<p>Sidebar alignment:<br />' . "\n";
    echo '<input type="radio" name="sidebaralign" value="left"' . ($sidebaralign == "left" ? ' checked="checked"' : '') . '>left</input><br />' . "\n";
    echo '<input type="radio" name="sidebaralign" value="right"' . ($sidebaralign == "right" ? ' checked="checked"' : '') . '>right</input><br />' . "\n";
    echo '<p>' . "\n";


    echo '<p>Front page post display:<br />' . "\n";
    echo '<input type="radio" name="indexpostlength" value="excerpt"' . ($indexpostlength == "excerpt" ? ' checked="checked"' : '') . '>excerpt</input><br />' . "\n";
    echo '<input type="radio" name="indexpostlength" value="full"' . ($indexpostlength == "full" ? ' checked="checked"' : '') . '>full</input><br />' . "\n";
    echo '</p>' . "\n";

    /*echo '<p>Header style:<br />' . "\n";
    echo '<input type="radio" name="headerstyle" value="wide"' . ($headerstyle == "wide" ? ' checked="checked"' : '') . '>wide</input><br />' . "\n";
    echo '<input type="radio" name="headerstyle" value="narrow"' . ($headerstyle == "narrow" ? ' checked="checked"' : '') . '>narrow</input><br />' . "\n";
    echo '<p>' . "\n";*/


    echo '<p><input type="submit" name="submit" value="Update Options" /></p>' . "\n";
    echo '</form>' . "\n\n";

}

function photon_get_custom_styles () {

    $dir = '../wp-content/themes/photon/styles';

    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file=readdir($dh)) != false) {
                if($file[0] == '.')
                    continue;
                $files[] = $file;
            }
            closedir($dh);
        }
    }

    return $files;

}

?>

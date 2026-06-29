<?php
/*
Plugin Name: YOURLS VS Theme
Plugin URI: https://github.com/vinnio/YOURLS-VS-Theme
Description: Moderne Van Stal frontend voor YOURLS (v0.1)
Version: 0.1
Author: VanStal
*/

yourls_add_action('plugins_loaded', 'vs_theme_init');

function vs_theme_init() {

    // Alleen frontend vervangen, admin ongemoeid laten
    if (defined('YOURLS_ADMIN') && YOURLS_ADMIN) {
        return;
    }

    yourls_add_action('html_head', 'vs_theme_head');
    yourls_add_action('html_footer', 'vs_theme_footer');
    yourls_add_filter('html_output', 'vs_theme_frontend');
}

function vs_theme_head() {
    $base = YOURLS_SITE . '/user/plugins/yourls-vs-theme/assets/';
    echo '<link rel="stylesheet" href="' . $base . 'frontend.css">';
}

function vs_theme_footer() {
    $base = YOURLS_SITE . '/user/plugins/yourls-vs-theme/assets/';
    echo '<script src="' . $base . 'qrcode.min.js"></script>';
    echo '<script src="' . $base . 'frontend.js"></script>';
}

/**
 * FRONTEND REPLACEMENT
 */
function vs_theme_frontend($content) {

    ob_start();
    ?>

    <div class="vs-page">

        <div class="vs-container">

            <header class="vs-header">
                <div class="vs-logo">🌿 Van Stal</div>
                <h1>Link verkorten</h1>
                <p>Modern, snel en schoon</p>
            </header>

            <div class="vs-card">

                <input type="text" id="vs-url" placeholder="Plak je lange URL hier...">

                <button onclick="vsShorten()">Verkorten</button>

                <div id="vs-result" style="display:none;">
                    <p>Korte link:</p>

                    <div class="vs-row">
                        <input type="text" id="vs-shorturl" readonly>
                        <button onclick="vsCopy()">Kopieer</button>
                    </div>

                    <div id="vs-qrcode"></div>
                </div>

            </div>

        </div>

    </div>

    <?php
    return ob_get_clean();
}
yourls_add_action('plugins_loaded', 'vs_admin_init');

function vs_admin_init() {

    if (!defined('YOURLS_ADMIN') || !YOURLS_ADMIN) {
        return;
    }

    yourls_add_action('html_head', 'vs_admin_head');
    yourls_add_action('admin_page_before_table', 'vs_admin_dashboard');
}

function vs_admin_head() {
    $base = YOURLS_SITE . '/user/plugins/yourls-vs-theme/assets/';
    echo '<link rel="stylesheet" href="' . $base . 'admin.css">';
}

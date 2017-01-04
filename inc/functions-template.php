<?php

// Echo the final code snippet preview
function code_snippets_do_output() {
  echo code_snippets_get_output();
}

// Generate the preview and code
function code_snippets_get_output() {
  $code_preview = wp_oembed_get( get_the_permalink( get_the_ID() ), array( 'width' => '1200', 'height' => '350' ) );
  $code_html    = get_post_meta( get_the_ID(), 'cs_html', true );
  $code_css     = get_post_meta( get_the_ID(), 'cs_css', true );
  $code_scss    = get_post_meta( get_the_ID(), 'cs_scss', true );
  $code_js      = get_post_meta( get_the_ID(), 'cs_js', true );

  $output .= '<div class="code-snippet-container">';
  $output .= '<div class="code-snippet-demo">' . $code_preview . '</div>';
  $output .= '<div class="code-html code-snippet"><h2 class="code-snippet-heading">HTML</h2><pre><code class="language-html">' . esc_html( $code_html ) . '</code></pre></div>';
  $output .= '<div class="code-css code-snippet"><h2 class="code-snippet-heading">CSS</h2><pre><code class="language-css">' . $code_css . '</code></pre></div>';
  $output .= '<div class="code-scss code-snippet"><h2 class="code-snippet-heading">SCSS</h2><pre><code class="language-scss">' . $code_scss . '</code></pre></div>';
  $output .= '<div class="code-js code-snippet"><h2 class="code-snippet-heading">JavaScript</h2><pre><code class="language-javascript">' . $code_js . '</code></pre></div>';
  $output .= '</div>';

  return $output;
}

function cs_frontend_enqueue_styles() {
  if ( is_singular( 'code_snippet' ) ) {
    wp_enqueue_style( 'prism-css', code_snippets_plugin()->dir_uri . 'css/prism.css' );
    wp_enqueue_script( 'prism-js', code_snippets_plugin()->dir_uri . 'js/prism.js', array(), null, true );
  }
}
add_action( 'wp_enqueue_scripts', 'cs_frontend_enqueue_styles', 5 );
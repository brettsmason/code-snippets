<?php

// Generate the preview and code
function bb_code_display() {
  $code_preview = wp_oembed_get( get_the_permalink( get_the_ID() ) );
  $code_html    = get_post_meta( get_the_ID(), 'bb_html', true );
  $code_css     = get_post_meta( get_the_ID(), 'bb_css', true );
  $code_scss    = get_post_meta( get_the_ID(), 'bb_scss', true );
  $code_js      = get_post_meta( get_the_ID(), 'bb_js', true );

  $output .= '<div class="row">';
  $output .= '<div class="code-demo column">' . $code_preview . '</div>';
  $output .= '<div class="code-html code-snippet medium-6 column"><h2 class="code-snippet-heading">HTML</h2><pre>' . esc_html( $code_html ) . '</pre></div>';
  $output .= '<div class="code-css code-snippet medium-6 column"><h2 class="code-snippet-heading">CSS</h2><pre>' . $code_css . '</pre></div>';
  $output .= '<div class="code-scss code-snippet medium-6 column"><h2 class="code-snippet-heading">SCSS</h2><pre>' . $code_scss . '</pre></div>';
  $output .= '<div class="code-js code-snippet medium-6 column"><h2 class="code-snippet-heading">JavaScript</h2><pre>' . $code_js . '</pre></div>';
  $output .= '</div>';

  echo $output;
}
<?php

// Generate the preview and code
function bb_code_display() {
  $code_preview = wp_oembed_get( get_the_permalink( get_the_ID() ), array( 'width' => '1200', 'height' => '350' ) );
  $code_html    = get_post_meta( get_the_ID(), 'bb_html', true );
  $code_css     = get_post_meta( get_the_ID(), 'bb_css', true );
  $code_scss    = get_post_meta( get_the_ID(), 'bb_scss', true );
  $code_js      = get_post_meta( get_the_ID(), 'bb_js', true );

  $output .= '<div class="building-block-container">';
  $output .= '<div class="code-demo flex-video">' . $code_preview . '</div>';
  $output .= '<div class="code-html code-snippet"><h2 class="code-snippet-heading">HTML</h2><pre><code class="language-html">' . esc_html( $code_html ) . '</code></pre></div>';
  $output .= '<div class="code-css code-snippet"><h2 class="code-snippet-heading">CSS</h2><pre><code class="language-css">' . $code_css . '</code></pre></div>';
  $output .= '<div class="code-scss code-snippet"><h2 class="code-snippet-heading">SCSS</h2><pre><code class="language-scss">' . $code_scss . '</code></pre></div>';
  $output .= '<div class="code-js code-snippet"><h2 class="code-snippet-heading">JavaScript</h2><pre><code class="language-javascript">' . $code_js . '</code></pre></div>';
  $output .= '</div>';

  echo $output;
}

function building_block_content( $content ) { 
    if ( is_singular( 'building_block' ) ) {
        $content = $content . bb_code_display();
		}

    return $content;
}
// add_filter( 'the_content', 'building_block_content' ); 

function bb_frontend_enqueue_styles() {
  if ( is_singular( 'building_block' ) ) {
    wp_enqueue_style( 'prism-css', building_blocks_plugin()->dir_uri . 'css/prism.css' );
    wp_enqueue_script( 'prism-js', building_blocks_plugin()->dir_uri . 'js/prism.js', array(), null, true );
  }
}
add_action( 'wp_enqueue_scripts', 'bb_frontend_enqueue_styles', 5 );
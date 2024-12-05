<?php $args = array(
'prev_text' => sprintf( esc_html__( '%s older', 'sshpros' ), '<span class="meta-nav">&larr;</span>' ),
'next_text' => sprintf( esc_html__( 'newer %s', 'sshpros' ), '<span class="meta-nav">&rarr;</span>' )
);
the_posts_navigation( $args );
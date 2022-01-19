<?php


function filter_get_avatar( $avatar, $id_or_email, $size, $default, $alt ) {    
    // If is email, try and find user ID
    if ( ! is_numeric( $id_or_email ) && is_email( $id_or_email->comment_author_email ) ) {
        $user = get_user_by( 'email', $id_or_email );
        if ( $user ) {
            $id_or_email = $user->ID;
        }
    }

    // If not user ID, return
    if( ! is_numeric( $id_or_email ) ) {
        return $avatar;
    }

    // Get attachment id
    $attachment_id  = get_user_meta( $id_or_email, 'avatar_attachment_id', true );
    //add_user_meta($id_or_email, 'myavator', $attachment_id);

    
    // NOT empty
    if ( ! empty ( $attachment_id  ) ) {
        // Return saved image
        update_user_meta($id_or_email, 'myavator', wp_get_attachment_image( $attachment_id, [ $size, $size ], false, ['alt' => $alt] ));
        return wp_get_attachment_image( $attachment_id, [ $size, $size ], false, ['alt' => $alt] );
    }

    return $avatar;
}
add_filter( 'get_avatar', 'filter_get_avatar', 10, 5 );


<?php
$author_info_box       = esc_attr( holmes_mkdf_options()->getOptionValue( 'blog_author_info' ) );
$author_info_email     = esc_attr( holmes_mkdf_options()->getOptionValue( 'blog_author_info_email' ) );
$author_id             = esc_attr( get_the_author_meta( 'ID' ) );
$user_data             = get_userdata( $author_id );
$social_networks       = holmes_mkdf_core_plugin_installed() ? holmes_mkdf_get_user_custom_fields() : false;
$display_author_social = holmes_mkdf_options()->getOptionValue( 'blog_single_author_social' ) === 'no' ? false : true;
?>
<?php if ( $author_info_box === 'yes' && get_the_author_meta( 'description' ) !== "" ) { ?>
    <div class="mkdf-author-description">
        <div class="mkdf-author-description-inner">
            <div class="mkdf-author-description-content">
                <div class="mkdf-author-description-image">
                    <a itemprop="url" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" title="<?php the_title_attribute(); ?>">
						<?php echo holmes_mkdf_kses_img( get_avatar( get_the_author_meta( 'ID' ), 135 ) ); ?>
                    </a>
                </div>
                <div class="mkdf-author-description-text-holder">
                    <h5 class="mkdf-author-name vcard author">
                        <a itemprop="url" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" title="<?php the_title_attribute(); ?>">
							<span class="fn">
								<?php
								if ( get_the_author_meta( 'first_name' ) != "" || get_the_author_meta( 'last_name' ) != "" ) {
									echo esc_html( get_the_author_meta( 'first_name' ) ) . " " . esc_html( get_the_author_meta( 'last_name' ) );
								} else {
									echo esc_html( get_the_author_meta( 'display_name' ) );
								}
								?>
							</span>
							<?php if ( count( $user_data->roles ) ) { ?>
                                <span class="mkdf-user-roles">
                                    <?php foreach ( $user_data->roles as $role ) { ?>
                                        <span class="mkdf-user-role"><?php echo holmes_mkdf_get_clean_output( $role ); ?></span>
                                    <?php } ?>
                                </span>
							<?php } ?>
                        </a>
                    </h5>
					<?php if ( $display_author_social ) { ?>
						<?php if ( is_array( $social_networks ) && count( $social_networks ) ) { ?>
                            <div class="mkdf-author-social-icons clearfix">
                                <span>
                                    <?php echo esc_html__( 'Connect', 'holmes' ); ?>
                                </span>
								<?php foreach ( $social_networks as $network ) { ?>
                                    <a itemprop="url" href="<?php echo esc_attr( $network['link'] ) ?>" target="_blank">
										<?php
										$soc = array( 'facebook'   => 'Fb.',
										              'twitter'    => 'Tw.',
										              'linkedin'   => 'Ln.',
										              'instagram'  => 'In.',
										              'pinterest'  => 'Pn.',
										              'tumblr'     => 'Tm.',
										              'googleplus' => 'G+'
										);
										foreach ( $soc as $key => $value ) {
											if ( strpos( $network['class'], $key ) ) {
												echo holmes_mkdf_get_clean_output( $value );
											}
										}
										?>
                                    </a>
								<?php } ?>
                            </div>
						<?php } ?>
					<?php } ?>
					<?php if ( get_the_author_meta( 'description' ) != "" ) { ?>
                        <div class="mkdf-author-text">
                            <p itemprop="description"><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
                        </div>
					<?php } ?>
					<?php if ( $author_info_email === 'yes' && is_email( get_the_author_meta( 'email' ) ) ) { ?>
                        <p itemprop="email" class="mkdf-author-email"><?php echo sanitize_email( get_the_author_meta( 'email' ) ); ?></p>
					<?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php get_header(); ?>

<?php
if (!is_user_logged_in()) {
	locate_template( "part-closed.php", true );
} else {
?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="content_pomodoro col-xs-12 col-sm-6 col-sm-offset-3">
		<h2 class="forte"><span class="glyphicon glyphicon-paste" aria-hidden="true"></span> <?php the_title();?></h2>
		<div class="table-responsive">
			<table class="table table-striped table-responsive table-condensed">
				<thead>
					<tr>
						<th><?php _e("Details", "sis-foca-js"); ?></th>
						<th><?php _e("Info", "sis-foca-js"); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> <?php _e("Author", "sis-foca-js"); ?></td>
						<td><?php echo get_avatar( get_the_author_meta( 'user_email' ), '96' ); ?></td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php _e("Name", "sis-foca-js"); ?></td>
						<td><a href="/members/<?php echo get_the_author_meta( 'user_nicename' ); ?>"><?php the_author(); ?></a></td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-tags" aria-hidden="true"></span> <?php _e("Project tags", "sis-foca-js"); ?></td>
						<td><?php the_tags(); ?></td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <?php _e("Type", "sis-foca-js"); ?></td>
						<td><?php the_category(); ?></td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> <?php _e("Pomodoro date", "sis-foca-js"); ?></td>
						<td><?php the_date("l, j \d\e F \d\e Y g:i "); ?></td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-text-background" aria-hidden="true"></span> <?php _e("Notes", "sis-foca-js"); ?></td>
						<td><?php the_content(); ?></td>
					</tr>
					<?php
						if(function_exists('revert_database_schema'))revert_database_schema();
						global $wpdb;

						$title = get_the_title();
						$posts_ids = array();
						$posts;
						$posts = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND     post_type='projectimer_focus'", $title), OBJECT );
						foreach ($posts as $post) {
						     $posts_ids[] = $post->ID;
						}
						#if(function_exists('revert_database_schema'))revert_database_schema();
					?>
					<tr>
						<td><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <?php _e("Durantion", "sis-foca-js"); ?></td>
						<td><?php echo count($posts_ids)/2; ?>h</td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> <?php _e("Total pomodoros", "sis-foca-js"); ?></td>
						<td><?php echo count($posts_ids); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	<?php endwhile; // end of the loop. ?>
	</div>
<?php } ?>
<?php get_footer();
	/*
	<div class="container">
		<br />
		<?php while ( have_posts() ) : the_post(); ?>
				<div class="row">
    				<div class="col-sm-1 col-md-offset-1">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), '60' ); ?>
					</div>
					<div class="col-sm-4">
						<p><strong> <?php the_title(); ?></strong></p>
						<p><?php get_the_author_meta('ID'); ?></p>
					</div>
				</div>
				<div class="row" style="text-align: center;">
					<div class="col-sm-4" >
					<p><strong>Pomodoro</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-2" style="text-align: right;">
						<p>projetos</p>
						<p>tipo</p>
						<p>data</p>
						<p>anotações</p>
					</div>
					<div class="col-sm-4">
						<p> <?php the_tags(''); ?> &nbsp; </p>
						<p> <?php the_category(); ?> &nbsp; </p>
						<p> <?php the_date("l, j \d\e F \d\e Y g:i "); ?> &nbsp; </p>
						<p> <?php the_content(); ?> &nbsp; </p>
					</div>
				</div>
				<div class="row" style="text-align: center;">
					<div class="col-sm-4" >
					<p><strong>Tarefa</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-2" style="text-align: right;">
						<p>duração</p>
						<p>pomodoros</p>
					</div>
					<div class="col-sm-4">
						<?php
						if(function_exists('revert_database_schema'))revert_database_schema();
						global $wpdb;

						$title = get_the_title();
						$posts_ids = array();
						$posts;
						$posts = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND     post_type='projectimer_focus'", $title), OBJECT );
						foreach ($posts as $post) {
						     $posts_ids[] = $post->ID;
						}
						#if(function_exists('revert_database_schema'))revert_database_schema();
						?>

						<p> <?php echo count($posts_ids)/2; ?>h &nbsp;</p>
						<p> <?php echo count($posts_ids); ?> &nbsp;</p>
						<p> Tarefas relaciondas </p>
					</div>
				</div>
				<!--div class="row">
					<div class="col-sm-2 col-md-offset-2">
						<button onclick="javascript:alert('desculpe, em construcao');">Carregar tarefa</button>
					</div>
				</div-->
			<br />
			<?php endwhile; // end of the loop. ?>
	<?php #} ?>
	</div>
	*?>
	</div>
<?php } ?>
<?php get_footer();


<div id="rg-comments" class="rg-card shadow mb-5">
    <div class="comment-form respond container">
		<?php if ( have_comments() ) : ?>
            <p class="h2"><?= comments_number() ?></p>
            <ul class="list">
				<?php
				wp_list_comments( [
					//'callback' => ''
				] );
				?>
            </ul>
		<?php endif; ?>
        <form id="respond" action="<?= site_url( 'wp-comments-post.php' ) ?>" method="post" name="commentform">
            <p><?= cancel_comment_reply_link() ?></p>
			<?php if ( ! is_user_logged_in() ) : ?>
                <div class="form-floating mb-3">
                    <input name="author" type="text" class="form-control" id="commentsInputAuthor"
                           placeholder="Ваше Имя">
                    <label for="commentsInputAuthor">Ваше Имя</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="email" type="email" class="form-control" id="commentsInputEmail"
                           placeholder="Ваш email">
                    <label for="commentsInputEmail">Email</label>
                </div>
			<?php else : ?>
                <p>Вы вошли как
                    <span class="strong"><?= wp_get_current_user()->display_name; ?></span>,
                    <a href="<?= wp_logout_url( get_permalink() ) ?>">Выйти?</a>
                </p>
			<?php endif; ?>
            <div class="form-floating">
                <textarea name="comment" class="form-control" placeholder="Ваш комментарий" id="commentsTextarea"
                          style="height: 100px"></textarea>
                <label for="commentsTextarea">Комментарий</label>
            </div>
			<?php comment_id_fields() ?>
            <button type="submit" class="btn mt-3">Отправить</button>
        </form>
    </div>
</div>
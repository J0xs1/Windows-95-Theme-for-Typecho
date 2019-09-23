<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments" data-no-instant>
    <div id="commentsBox">
        <?php $this->comments()->to($comments); ?>
        <?php if ($comments->have()): ?>
        <h3>
            <?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?>
        </h3>
        <?php $comments->listComments(); ?>
        <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
        <?php endif; ?>
        <?php if($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
            </div>

            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                <?php if($this->user->hasLogin()): ?>
            	<p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
                <?php else: ?>
            	<p>
            		<input type="text" name="author" id="author" class="text" placeholder="昵称" value="<?php $this->remember('author'); ?>" required />
            		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            		<input type="email" name="mail" id="mail" class="text" placeholder="邮箱" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
            	</p>
                <?php endif; ?>
                <p>
                    <textarea rows="5" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>
                </p>
            	<p>
                    <button type="submit" class="submit"><?php _e('提交评论'); ?></button>
                </p>
            </form>
            <?php if ($this->options->instantclick === 'true') { ?>
            <?php $this->header('keywords=&description=&rss1=&rss2=&atom=&generator=&template=&pingback=&xmlrpc=&wlw='); ?>
            <script>
                $('#comment-form').ajaxForm(function () {
                    var url_tmp = window.location.pathname;
                    $("#comments").load(url_tmp + " #commentsBox");
                });
            </script>
            <?php } ?>
        </div>
        <?php else: ?>
        <h3><?php _e('一年又一年，物是人已非。'); ?></h3>
        <?php endif; ?>
    </div>
</div>

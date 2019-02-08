<?php $this->start('script');
echo $this->Html->script('albums');
$this->end(); ?>
	
<?php if (!empty($latests)): ?>
    <?php if ($this->Paginator->current('Song') == 1): ?>
	<h3><?php echo __('Recently added'); ?></h3>
	<div class="col-lg-12" data-scroll-container="true" data-view="albums">
        <?php $i = 1; ?>
        <?php $hidden = ''; ?>
        <?php foreach ($latests as $album): ?>
            <?php if ($i == 4) {
                $hidden = 'hidden-xs';
            } elseif ($i >= 5) {
                    $hidden = 'hidden-sm hidden-xs';
            } ?>
            <div class="col-md-2 col-sm-3 col-xs-4 action-expend <?php echo $hidden; ?>" data-band="<?php echo h($album['Song']['band']); ?>" data-album="<?php echo h($album['Song']['album']); ?>" data-scroll-content="true">
                <?php echo $this->Image->lazyload($this->Image->resizedPath($album['Song']['cover'], 220, 220), array('class' => 'img-responsive cover lzld', 'style' => 'cursor: pointer;')); ?>
                <h4 class="truncated-name" title="<?php echo h($album['Song']['album']); ?>">
                    <?php echo h($album['Song']['album']); ?>
                    <small>
                        <br /><?php echo h($album['Song']['band']); ?>
                    </small>
                </h4>
            </div>
            <?php
            $clear = false;
            if ($i % 6 == 0) {
                $clear = "visible-lg visible-md visible-xs";
                if ( $i % 4 == 0) {
                    $clear .= " visible-sm";
                }
            } elseif ($i % 4 == 0) {
                $clear = "visible-sm";
            } elseif ($i % 3 == 0) {
                $clear = "visible-xs";
            }
            ?>
            <?php if ($clear !== false): ?>
                <div class="clearfix <?php echo $clear; ?>" data-scroll-content="true"></div>
            <?php endif;
            $i++; ?>
        <?php endforeach; ?>
        <div class="clearfix"></div>
        <hr />

    <?php endif; ?>
    </div>
<?endif; ?>

<?php if (!empty($songs)): ?>
    <div class="col-lg-12" data-view="default">
        <table class="table table-hover" data-scroll-container="true">
            <thead>
            <tr>
                <th class="track-number">#</th>
                <th><?php echo __('Song Title'); ?></th>
                <th class="hidden-xs hidden-sm"><?php echo __('Artist'); ?></th>
                <th class="visible-lg"><?php echo __('Album'); ?></th>
                <th class="text-right"><?php echo __('Duration'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($songs as $song) { ?>
                <tr data-id="<?php echo h($song['Song']['id']); ?>" data-scroll-content="true">
                    <td class="track-number">
                        <span class="song-number"><?php echo h($song['Song']['track_number']); ?></span>
                    </td>
                    <td class="truncated-name"><?php echo h($song['Song']['title']); ?></td>
                    <td class="truncated-name hidden-xs hidden-sm"><?php echo h($song['Song']['band']); ?></td>
                    <td class="truncated-name visible-lg"><?php echo h($song['Song']['album']); ?></td>
                    <td class="text-right playtime-cell">
                        <span class="song-playtime"><?php echo h($song['Song']['playtime']); ?></span>
                        <?php echo $this->element('add_menu', array('song_id' => h($song['Song']['id']), 'song_title' => h($song['Song']['title']))); ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php if (!empty($songs) || !empty($latests)): ?>
    <?php echo $this->element('add_to_playlist'); ?>
<?php endif; ?>

<div class="box">
    <div class="help about-me">
        <div class="tab-hd clearfix">
            <ul class="tab-nav">
                <li class="fd01 <?php if ($cusor == 'about_us'): ?>cur<?php endif; ?>"> 
                    <a href="<?php echo base_url(); ?>help/about_us" <?php if ($cusor == 'about_us'): ?> class="cur"<?php endif; ?> >
                        <div class="pic"></div>
                        <p>关于我们</p>
                    </a>
                </li>
                <li class="fd02 <?php if ($cusor == 'join_us'): ?>cur<?php endif; ?>">
                    <a href="<?php echo base_url(); ?>help/join_us" <?php if ($cusor == 'join_us'): ?> class="cur"<?php endif; ?>>
                        <div class="pic"></div>
                        <p>加入泛丁</p>
                    </a>
                </li>
                <li class="fd03 <?php if ($cusor == 'contact_us'): ?>cur<?php endif; ?>">
                    <a href="<?php echo base_url(); ?>help/contact_us" <?php if ($cusor == 'contact_us'): ?> class="cur"<?php endif; ?>>
                        <div class="pic"></div>
                        <p>联系我们</p>
                    </a>
                </li>
                <li class="fd04 <?php if ($cusor == 'media'): ?>cur<?php endif; ?>">
                    <a href="<?php echo base_url(); ?>help/media" <?php if ($cusor == 'media'): ?> class="cur"<?php endif; ?>>
                        <div class="pic"></div>
                        <p>媒体报道</p>
                    </a>
                </li>
                <li class="fd05 <?php if ($cusor == 'cooperation'): ?>cur<?php endif; ?>">
                    <a href="<?php echo base_url(); ?>help/cooperation" <?php if ($cusor == 'cooperation'): ?> class="cur"<?php endif; ?>>
                        <div class="pic"></div>
                        <p>商业合作</p>
                    </a>
                </li>
            </ul>
        </div>
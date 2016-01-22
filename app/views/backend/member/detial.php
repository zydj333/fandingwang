<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_member"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_member/detial/<?php echo $member->id; ?>"><?php echo lang('page_where_detial'); ?></a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <table class="tablelist">
                <tr align="left">
                    <td><?php echo lang('avatar'); ?>：<img src="<?php echo base_url() . $member->avatar ?>" onerror="this.onerror='';this.src='/images/share_head.png'" /></td>
                    <td><?php echo lang('id'); ?>：<?php echo $member->id; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('account'); ?>：<?php echo $member->account; ?></td>
                    <td><?php echo lang('username'); ?>：<?php echo $member->username; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('email'); ?>：<?php echo $member->email; ?></td>
                    <td><?php echo lang('telphone'); ?>：<?php echo $member->telphone; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('gender'); ?>：<?php if ($member->gender == 0) { echo '男'; } else { echo '女';} ?></td>
                    <td><?php echo lang('birthday'); ?>：<?php echo $member->birthday; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('job'); ?>：<?php echo $member->job; ?></td>
                    <td><?php echo lang('idnumber'); ?>：<?php echo $member->idnumber; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('province'); ?>：<?php echo $member->province; ?></td>
                    <td><?php echo lang('city'); ?>：<?php echo $member->city; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('address'); ?>：<?php echo $member->address; ?></td>
                    <td><?php echo lang('discription'); ?>：<?php echo $member->discription; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('usable_money'); ?>：<?php echo $member->usable_money; ?></td>
                    <td><?php echo lang('freeze_money'); ?>：<?php echo $member->freeze_money; ?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('real_name'); ?>：<?php if ($member->real_name == 1) {echo '已认证';} else {echo '未认证'; }?></td>
                    <td><?php echo lang('real_phone'); ?>：<?php if ($member->real_phone == 1) { echo '已认证';} else {echo '未认证';}?></td>
                </tr>
                <tr align="left">
                    <td><?php echo lang('real_email'); ?>：<?php if ($member->real_email == 1) {echo '已认证';} else {echo '未认证';}?></td>
                    <td><?php echo lang('real_invest'); ?>：<?php if ($member->real_invest == 1) {echo '已认证'; } else {echo '未认证'; }?></td>
                </tr>
                 <tr align="left">
                    <td><?php echo lang('real_count'); ?>：</label><?php echo $member->real_count; ?></td>
                    <td><?php echo lang('addtime'); ?>：</label><?php echo $member->addtime; ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>

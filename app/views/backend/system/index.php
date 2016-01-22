<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo lang('page_title'); ?></title>
        <link href="<?php echo base_url(); ?>css/backend/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/backend/jquery.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
               
            });
        </script>
    </head>
    <body>
        <div class="place">
            <span><?php echo lang('page_where'); ?></span>
            <ul class="placeul">
                <li><a href="<?php echo base_url(); ?>admin_index/defaultpage"><?php echo lang('page_where_start'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_system"><?php echo lang('page_where_middle'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>admin_system/index"><?php echo lang('page_where_list'); ?></a></li>
            </ul>
        </div>
        <div class="rightinfo">
            <div class="tools">
                <ul class="toolbar">
                    <li class="click"><a href="<?php echo base_url(); ?>admin_system/add"><span><img src="<?php echo base_url(); ?>images/backend/t01.png" /></span><?php echo lang('add'); ?></a></li>
                    <li class="click"><a href=""><span><img src="<?php echo base_url(); ?>images/backend/t03.png" /></span><?php echo lang('del'); ?></a></li>
                    <!--<li><span><img src="<?php echo base_url(); ?>images/backend/t02.png" /></span>修改</li>
                    <li><span><img src="<?php echo base_url(); ?>images/backend/t04.png" /></span>统计</li>-->
                </ul>
            </div>
            <table class="tablelist">
                <thead>
                    <tr>
                        <th><input name="checkall" type="checkbox" value="1"/></th>
                        <th><?php echo lang('id'); ?><i class="sort"><img src="<?php echo base_url(); ?>images/backend/px.gif" /></i></th>
                        <th><?php echo lang('titel'); ?></th>
                        <th><?php echo lang('actionname'); ?></th>
                        <th><?php echo lang('controller'); ?></th>
                        <th><?php echo lang('parent_id'); ?></th>
                        <th><?php echo lang('sult'); ?></th>
                        <th><?php echo lang('is_del'); ?></th>
                        <th><?php echo lang('addtime'); ?></th>
                        <th><?php echo lang('todo'); ?></th>
                    </tr>
                </thead>
                <?php if (!empty($system)): ?>
                    <tbody>
                    <?php foreach ($system as $key => $values): ?>
                        <tr align="left">
                            <td><input name="sys_id" type="checkbox" value="<?php echo $values->id; ?>" /></td>
                            <td><?php echo $values->id; ?></td>
                            <td><?php echo $values->titel; ?></td>
                            <td><?php echo $values->actionname; ?></td>
                            <td><?php echo $values->controller; ?></td>
                            <td><?php echo $values->parent_id; ?></td>
                            <td><?php echo $values->sult; ?></td>
                            <td><?php if($values->is_del==1){echo '是';}else{echo '否';} ?></td>
                            <td><?php echo $values->addtime; ?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>admin_system/add/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('addson'); ?></a>
                                <a href="<?php echo base_url(); ?>admin_system/edit/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('edit'); ?></a>
                                <a onclick="return confirm('<?php echo lang('delete_notice'); ?>')" href="<?php echo base_url(); ?>admin_system/del/<?php echo $values->id; ?>" class="tablelink"><?php echo lang('del'); ?></a>
                            </td>
                        </tr>
                    <?php if (!empty($values->second)): ?>
                    <?php foreach ($values->second as $k => $v): ?>
                                <tr align="center">
                                    <td><input name="sys_id" type="checkbox" value="<?php echo $v->id; ?>" /></td>
                                    <td><?php echo $v->id; ?></td>
                                    <td><?php echo $v->titel; ?></td>
                                    <td><?php echo $v->actionname; ?></td>
                                    <td><?php echo $v->controller; ?></td>
                                    <td><?php echo $v->parent_id; ?></td>
                                    <td><?php echo $v->sult; ?></td>
                                    <td><?php if($v->is_del==1){echo '是';}else{echo '否';} ?></td>
                                    <td><?php echo $v->addtime; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>admin_system/add/<?php echo $v->id; ?>" class="tablelink"><?php echo lang('addson'); ?></a>
                                        <a href="<?php echo base_url(); ?>admin_system/edit/<?php echo $v->id; ?>" class="tablelink"><?php echo lang('edit'); ?></a>
                                        <a onclick="return confirm('<?php echo lang('delete_notice'); ?>')" href="<?php echo base_url(); ?>admin_system/del/<?php echo $v->id; ?>" class="tablelink"><?php echo lang('del'); ?></a>
                                    </td>
                                </tr>
                    <?php if (!empty($v->third)): ?>
                    <?php foreach ($v->third as $m => $n): ?>
                                 <tr align="right">
                                    <td><input name="sys_id" type="checkbox" value="<?php echo $n->id; ?>" /></td>
                                    <td><?php echo $n->id; ?></td>
                                    <td><?php echo $n->titel; ?></td>
                                    <td><?php echo $n->actionname; ?></td>
                                    <td><?php echo $n->controller; ?></td>
                                    <td><?php echo $n->parent_id; ?></td>
                                    <td><?php echo $n->sult; ?></td>
                                    <td><?php if($n->is_del==1){echo '是';}else{echo '否';}  ?></td>
                                    <td><?php echo $n->addtime; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>admin_system/edit/<?php echo $n->id; ?>" class="tablelink"><?php echo lang('edit'); ?></a>
                                        <a onclick="return confirm('<?php echo lang('delete_notice'); ?>')" href="<?php echo base_url(); ?>admin_system/del/<?php echo $n->id; ?>" class="tablelink"><?php echo lang('del'); ?></a>
                                    </td>
                                </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                                    </tbody>
                <?php endif; ?>
                                    </table>
                                    <div class="pagin"> </div>
                                    <div class="tip">
                                        <div class="tiptop"><span>提示信息</span><a></a></div>
                                        <div class="tipinfo">
                                            <span><img src="<?php echo base_url(); ?>images/backend/ticon.png" /></span>
                </div>
                <div class="tipbtn">
                    <input name="" type="button"  class="sure" value="确定" />&nbsp;
                    <input name="" type="button"  class="cancel" value="取消" />
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $('.tablelist tbody tr:odd').addClass('odd');
        </script>
    </body>
</html>

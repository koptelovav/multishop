<?php
/* @var $this OrderCommentController */
/* @var $data OrderComment */
?>

<div class="well well-sm">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" data-update="order-comments" data-href="<?php echo Yii::app()->createUrl('orderComment/delete',array('id'=>$data->id))?>">&times;</button>

    <table>
        <tr>
            <td style="border-right: 1px solid #ccc;padding-right: 10px;">
                <table>
                    <tr>
                        <td>
                            <small><?php echo date('d.m.Y H:i',strtotime($data->create_date)); ?></small>
                        </td>
                    </tr>
                    <tr>
                        <small><?php echo $data->user->name; ?></small>
                    </tr>
                </table>
            </td>
            <td style="padding-left: 10px">
                <?php echo nl2br($data->text); ?>
            </td>
        </tr>
    </table>

</div>
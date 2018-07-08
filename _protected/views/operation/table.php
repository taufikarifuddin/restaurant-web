<?php
use yii\helpers\Url;
?>

<div class="table-responsive" style="max-height:500px;">
    <table class="table no-margin">
        <tr>
            <td colspan="3" class="text-right">
                <a href="<?=Url::to(['operation/table'])?>" class="btn btn-xs btn-primary">All</a>&nbsp;
                <a href="<?=Url::to(['operation/table','action'=>'free'])?>" class="btn btn-xs btn-success">Only Free</a>&nbsp;
                <a href="" class="btn btn-xs btn-warning">Refresh</a>
            </td>
        </tr>
        <tr>
            <th>Table Number</th>
            <th>Occupied By</th>
        </tr>
        <tr >
            <?php foreach( $tables as $k => $v):?>
            <td>Table-<?=$v->seat_table_number?></td>
            <td>
                <?= is_null($v->user_id) ? "<label class='label label-warning'>Occupied By : ".$v->user->username."</label>" : 
                    "<label class='label label-success'>FREE</label>"?>
            </td>
            <?php endforeach; ?>
        </tr>
    </table>
</div>
<?php
use yii\helpers\Url;


$listOfUser = \app\models\User::find()
    ->where(['role' => \app\models\Role::CUSTOMER])
    ->all();

$listOfTable = \app\models\SeatTable::find()
    ->all();

?>

<div class="table-responsive" style="max-height:500px;">
    <table class="table no-margin">
        <tr>
            <td colspan="3">
                You Search  : <?= $date ?>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">
                <form class="form-inline">
                    <div class="form-group">
                        <input type="text" id="datepicker" readonly=true name="date" value="<?=$date?>" data-date-format="yyyy-mm-dd">
                        <button type="submit" class="btn btn-xs btn-primary">Go</button>
                    </div>
                    <div class="form-group">
                        <a href="<?=Url::to(['operation/table'])?>" class="btn btn-xs btn-primary">Now</a>&nbsp;
                        <a href="<?=Url::to(['booking/create'])?>" class="btn btn-xs btn-primary">Create Booking</a>&nbsp;
                    </div>
                </form>
            </td>
        </tr>
        <tr>
            <th>Table Number</th>
            <th>Occupied By</th>
            <th>Booking Schedule Today</th>
        </tr>
        <?php foreach( $tables as $k => $v):?>
        <tr>
            <td>Table-<?=$v->seat_table_number?></td>
            <td>
                <?= !is_null($v->user_id) ? "<label class='label label-warning'>Occupied By : ".$v->user->username."</label>" : 
                    "<label class='label label-success'>FREE</label>"?>
            </td>
            <td>
                <?php
                    $bookings =  $v->getBookingsByDate($date);
                    if( count($bookings) > 0 ){
                ?>
                <table class="table table-responsive">
                    <tr>
                        <th>Id Booking</th>
                        <th>User</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                    <?php foreach( $bookings as $k => $v ): ?>
                    <tr>    
                        <td><?= $v->id ?></td>
                        <td><?= $v->user->username ?></td>
                        <td><?= date('H:i',$v->starttime) ?></td>
                        <td><?= date('H:i',$v->endtime) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php } ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php

$js = "
    $(function(){
        $('#datepicker').datetimepicker({
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            minView: 2,
        });
    })
";

$this->registerJs($js);
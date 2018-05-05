<?php
    $this->title = "Koki";
?>

<div class="table-responsive" style="max-height:500px;">
    <table class="table no-margin">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Tabble</th>            
                <th>Details</th>            
                <th>Actions</th>                            
            </tr>
        </thead>
        <tbody>
            <?php foreach( $orders as $k => $v ): ?>
            <tr>
                <td> ORD-<?= $v->id ?> </td>    
                <td> <?= $v->user->username ?> </td>    
                <td> <?= $v->table_number ?> </td>    
                <td>
                    <table class="table" id="table-<?=$v->id?>">
                        <tr>
                            <td style="width:15%;"> Food Name </td>
                            <td style="width:5%;"> Qty </td>                              
                        </tr>
                        <?php foreach( $v->orderItems as $k => $val ): ?>
                        <tr>
                            <td><?= $val->food->name ?></td>
                            <td> <?= $val->qty ?> </td>                           
                        </tr>
                        <?php endforeach; ?>                        
                    </table>
                </td>                
                <td>
                    <button id="btn-approve-<?=$v->id?>"  data-id="<?=$v->id?>"  class="btn-approve btn btn-success btn-flat btn-xs round">
                        <i class="fa fa-check"></i>
                    </button>
                    <button id="btn-reject-<?=$v->id?>" data-id="<?=$v->id?>"  class="btn-reject btn btn-danger btn-flat btn-xs">
                        <i class="fa fa-times"></i>                    
                    </button>                    
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php


$js = '

    function sendDataToServer(url,data,method,fn){
        $.ajax({
            url : url,
            data : data,
            method : method,
            success : fn
        });
    }

    $(function(){

        $(document).on("click",".btn-approve",function(){
            var id = $(this).data("id");
        })
    
        $(document).on("click",".btn-reject",function(){
            var id = $(this).data("id");              
        })    

    })
';

$this->registerJs($js);
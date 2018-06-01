<?php
    use yii\helpers\Url;

    $this->title = "Kasir";
?>

<div class="table-responsive" style="max-height:500px;">
    <table class="table no-margin">
        <thead>
            <tr>
                <th style="width:10%">Order ID</th>
                <th style="width:10%;">User</th>
                <th style="width:5%;">Tabble</th>            
                <th>Details</th>            
                <th style="width:10%;">Actions</th>                            
            </tr>
        </thead>
        <tbody>
            <?php foreach( $orders as $k => $v ): ?>
            <tr id="container-<?= $v->id ?>">
                <td> ORD-<?= $v->id ?> </td>    
                <td> <?= $v->user->username ?> </td>    
                <td> <?= $v->table_number ?> </td>    
                <td>
                    <table class="table" id="table-<?=$v->id?>">
                        <tr >
                            <td style="width:15%;"> Food Name </td>
                            <td style="width:5%;"> Qty </td>
                            <td style="width:80%;"> Approved </td>                                
                        </tr>
                        <?php foreach( $v->orderItems as $k => $val ): ?>
                        <tr>
                            <td><?= $val->food->name ?></td>
                            <td> <?= $val->qty ?> </td>
                            <td> 
                                <div class="form-group">
                                    <input type="checkbox" checked="checked"  id="checkbox-<?=$val->id?>" 
                                    data-parent="<?= $v->id  ?>"
                                    data-id="<?=$val->id?>" class="checkbox-<?=$v->id?> checkbox" id="item-<?= $val->id ?>" />
                                </div>
                                <div class="form-group">                  
                                    <textarea class="textarea" id="textarea-<?=$val->id?>" style="display:none;" 
                                        placeholder="Add Note" rows=4 cols=80 id="note-<?= $val->id ?>"></textarea>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>                        
                    </table>
                </td>                
                <td>
                    <button id="btn-approve-<?=$v->id?>"  data-id="<?=$v->id?>" class="btn-approve btn btn-success btn-flat btn-xs round">
                        <i class="fa fa-check"></i>
                    </button>
                    <button id="btn-reject-<?=$v->id?>" data-id="<?=$v->id?>" disabled class="btn-reject btn btn-danger btn-flat btn-xs">
                        <i class="fa fa-times"></i>                    
                    </button>                    
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php

$this->registerJsFile(Yii::getAlias("@js/cashier.js"),[
    'depends' => [
        '\app\assets\AppAsset'
    ]
]);
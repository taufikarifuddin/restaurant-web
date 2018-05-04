<?php
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
            <tr>
                <td> ORD-<?= $v->id ?> </td>    
                <td> <?= $v->user->username ?> </td>    
                <td> <?= $v->table_number ?> </td>    
                <td>
                    <table class="table" id="table-<?=$v->id?>">
                        <tr>
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
                                    <input type="checkbox" checked=false id="checkbox-<?=$val->id?>" 
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
                    <button id="btn-approve-<?=$v->id?>"  data-id="<?=$v->id?>" disabled class="btn-approve btn btn-success btn-flat btn-xs round">
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


$js = '

    function checkIsApproved(parentId){
        var listOfCheckbox = $(".checkbox-"+parentId);
        var isApproved = true;
        $.each(listOfCheckbox,function(index,elem){
            var isChecked = $(this).prop("checked");
            if( !isChecked ){
                isApproved = false;                
                return;
            }
        })
        return isApproved;
    }

    function setActionBtn(id,parentId){
        var isValid = checkIsApproved(parentId);
        var button = getBtnDOM(parentId);

        button.approve.attr("disabled","true");
        button.reject.attr("disabled","true");
        
        if( isValid ){
            button.approve.removeAttr("disabled");
        }else{
            button.reject.removeAttr("disabled");                        
        }
    }

    function getBtnDOM(parentId){
        var approveBtn = $("#btn-approve-"+parentId);        
        var rejectBtn = $("#btn-reject-"+parentId);                
        return {
            approve : approveBtn,
            reject : rejectBtn
        }
    }

    function collectData(parentId){
        var listCheckbox = $("#table-"+parentId+" input[type=\"checkbox\"]");
        var value = [];
        $.each(listCheckbox,function(index,data){
            var id = $(this).data("id");
            var isApproved = $(this).prop("checked");
            var note = $("#textarea-"+id).val();
            if( !isApproved && note.trim() == "" ) {
                value = false;
                return;
            }
            value.push({
                approved : isApproved,
                note : note
            });
        })

        return value;
    }        

    function sendDataToServer(url,data,method,fn){
        $.ajax({
            url : url,
            data : data,
            method : method,
            success : fn
        });
    }

    $(function(){

        $(document).on("change",".checkbox",function(){
            var isSelected = $(this).prop("checked");        
            var id = $(this).data("id");
            var parentId = $(this).data("parent");        
            if(!isSelected){               
                $("#textarea-"+id).removeAttr("style");
            }else{
                $("#textarea-"+id).css("display","none");        
            }
    
            setActionBtn(id,parentId);
    
        });

    
        $(document).on("click",".btn-approve",function(){
            var id = $(this).data("id");
            var data = collectData(id);

        })
    
        $(document).on("click",".btn-reject",function(){
            var id = $(this).data("id");   
            var data = collectData(id);
            if(!data){
                alert("Note harus diisi ketika permintaan direject");
            }
        })    

    })
';

$this->registerJs($js);
<?php

function createDataDelete($type,$link){

return 

"
<script type='module'>


        import {tableTypeConstructor} from '../../module/scripts/graphic.js';
        tableTypeConstructor('$type');

        const deleteElementConfirm = (id,name)=>{
            
            let deleteConfirm = confirm('Deseja deletar o registro de '+name+'?');

            if(deleteConfirm){
                window.location.href='$link'+id;
            } 

        }
        
        window.deleteElementConfirm = deleteElementConfirm;

    </script>

";


}
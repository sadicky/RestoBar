<?php
?>
<table id="tabx" class="table-sm" cellspacing="0" width="100%">
    <tbody>
        <?php
        $dat1=$cat->select_all_3();
        foreach ($dat1 as $un) {

            $cat->select($un['category_parent']);

            echo '<tr><td><a href="javascript:void(0)" class="show_cont_det btn btn-primary btn-sm" id="'.$un['category_id'].'" data-id="'.$un['category_name'].'"><i class="fa fa-plus"></i> '.$un['category_name'].'</a> ';

            echo '<input value="" name="srch_prod'.$un['category_id'].'" class="srch_prod" id="'.$un['category_id'].'" placeholder="Search"/>';
            echo '<div class="srch_res_prod" id="srch_res_prod'.$un['category_id'].'">
                 </div>';
            echo '</td></tr>';

            $dat2=$cat->select_all_parent($un['category_id']);
            foreach ($dat2 as $un2) {
                echo '<tr class="det'.$un['category_id'].' hide_cont_det"><td style="padding-left:20px;">
                <a href="javascript:void(0)" class="show_cont_prod btn btn-info btn-sm" id="'.$un2['category_id'].'" data-id="'.$un2['category_name'].'"><i class="fa fa-plus"></i> '.$un2['category_name'].'</a>';
                
                echo '<div class="det'.$un2['category_id'].' hide_cont_det" style="">';
            
                if($_SESSION['cmd']!='' and !empty($vente->getAssId()))
                    {
                        $dat2=$prod->select_all_cat($un2['category_id']);
                        foreach ($dat2 as $un3) {
                    $stock->select($un3['prod_id'],$_SESSION['pos']);
                    if(($stock->getQuantity()<=0) and $un3['is_stock']=='Oui')
                            {
                        echo '<div class="rounded p-0 m-1 border border-danger" style="border: 1px solid black; display:inline-block; padding:0px;">
                    <a href="javascript:void(0)" id="1" data-id="'.$un3['prod_id'].'" class="btn btn-danger btn-sm m-0 ch_prod" style="font-size:12px;"><b>'.$un3['prod_code'].'</b>-'.$un3['prod_name'].'</a> 
                    <input type="number" value="1" name="qt" class="qt_'.$un3['prod_id'].' m-0" style="width:40px; display:inline; border-style:none; margin:0 font-size:12px;"/>
                    </div>';
                        }
                        else
                        {
                             echo '<div class="rounded p-0 m-1 border border-warning" style="border: 1px solid black; display:inline-block; padding:0px;">
                    <a href="javascript:void(0)" id="1" data-id="'.$un3['prod_id'].'" class="btn btn-warning btn-sm m-0 ch_prod" style="font-size:12px;"><b>'.$un3['prod_code'].'</b>-'.$un3['prod_name'].'</a> 
                    <input type="number" value="1" name="qt" class="qt_'.$un3['prod_id'].' m-0" style="width:40px; display:inline; border-style:none; margin:0 font-size:12px;"/>
                    </div>';

                        }
                    }
                    }
                    else
                    {
                        echo '<h1 style="font-weight:bold">Ajouter la commande cliquez sur la commande ou choisir le serveur</h1>';
                    }
                    
                echo '</div></td></tr>';
            }
        }
        ?>

    </tbody>
</table>
<span class="border border" style="display: bl"></span>
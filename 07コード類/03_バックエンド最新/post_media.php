<?php
function media_move ($post_id,$dbmng,$media1,$media2,$media3,$media4){ //ポストidを受け取って解凍して画像を移動させる
    $zip = new ZipArchive;

    if(isset($media1)){
        $zip_name = $post_id.'_1.zip';
        $pas = 'display/'.$zip_name;
        file_put_contents($pas, $media1);
        
            if ($zip->open($pas) === TRUE) {
                $zip->extractTo('display/');
                $zip->close();
                
                unlink($pas);
            }
    }
    if(isset($media2)){
        $zip_name = $post_id.'_2.zip';
        $pas = 'display/'.$zip_name;
        file_put_contents($pas, $media2);
        
            if ($zip->open($pas) === TRUE) {
                $zip->extractTo('display/');
                $zip->close();
                
                unlink($pas);
            }
    }
    if(isset($media3)){
        $zip_name = $post_id.'_3.zip';
        $pas = 'display/'.$zip_name;
        file_put_contents($pas, $media3);
        
            if ($zip->open($pas) === TRUE) {
                $zip->extractTo('display/');
                $zip->close();
                
                unlink($pas);
            }
    }
    if(isset($media4)){
        $zip_name = $post_id.'_4.zip';
        $pas = 'display/'.$zip_name;
        file_put_contents($pas, $media4);
        
            if ($zip->open($pas) === TRUE) {
                $zip->extractTo('display/');
                $zip->close();
                
                unlink($pas);
            }
    }
}
?>
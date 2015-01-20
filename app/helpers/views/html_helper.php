<?php

$css;
$js;
function use_css($file){
    global $css;
    $css .= '<link rel="stylesheet" href="/iflist/iflist-testing/csv_parse/public/style/'.$file.'">
';
}
function render_js(){
    global $js;
    print $js;
}
function use_js($file){
    global $js;
    $js .= '<link rel="stylesheet" href="/iflist/iflist-testing/csv_parse/public/style/'.$file.'">
';
}
function render_css(){
    global $css;
    print $css;
}

function render_h1($str){
    print '<h1>'.$str.'</h1>';
}

function render_h2($str){
    print '<h2>'.$str.'</h2>';
}
function render_h3($str){
    print '<h3>'.$str.'</h3>';
}

function render_table($list, $options = array('use_head'=>0, 'head_data'=> array(),'line_count'=>1)){
	$html = "";

	$html .= '<div class="table-responsive scroll">
            <table class="table table-striped">';
    $counter = 0;
    foreach($list as $krow=>$vrow){
        /************ head ***********/
    	if($counter == 0 && $options['use_head'] == 1 ){
    		$html .= ' <thead> ';
	    
            if($options['line_count'] == 1){$html .= '<td name=count> </td>';}
            foreach( $options['head_data'] as $kcol=>$vcol){
                $html .= '<th name='.$kcol.'>'.$vcol.'</th>';
            }  

            $html .= '  </thead> <tbody>  ';
        } 

        /************ /head ***********/
        $html .= ' <tr> ';
 
        if($options['line_count'] == 1){
        	$html .= '<td name=count>'.$counter.'</td>';
        }

        foreach($vrow as $kcol=>$vcol){
        	$html .= '<td name='.$kcol.'>'.$vcol.'</td>';
        }  

        $html .= ' </tr> ';

        $counter++;
    }	
    $html .= '</tbody></table> </div>';           
                  

	print $html;
}

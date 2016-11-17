<?php

/*
add_filter('uwpqsf_result_tempt', 'customize_output', '', 4);
function customize_output($results , $arg, $id, $getdata ){
	 // The Query
            $apiclass = new uwpqsfprocess();
            $query = new WP_Query( $arg );
		ob_start();	$result = '';
			// The Loop

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();global $post;
				$type = get_post_type();
				if ( get_post_meta( get_the_ID(), '_post_extra_boxes_checkbox', true ) != 'on') blokmaker(4, $type);
			}
                        echo  $apiclass->ajax_pagination($arg['paged'],$query->max_num_pages, 4, $id, $getdata);
		 } else {
					 echo  '<div class="col-md-12"><h2 style="margin-top:0;">Nothing found</h2></div>';
				}
				wp_reset_postdata();

		$results = ob_get_clean();		
			return $results;
}

add_filter('uwpqsftaxo_field', 'add_multiselect_admin');
function add_multiselect_admin($fields){

	$fields['multiselect'] = 'Multi Select';
	return $fields;
}

#2. Add the field to the frontend
add_filter('uwpqsf_addtax_field_multiselect','multiselect_front','',11);
function multiselect_front($type,$exc,$hide,$taxname,$taxlabel,$taxall,$opt,$c,$defaultclass,$formid,$divclass){
	$eid = explode(",", $exc);
	$args = array('hide_empty'=>$hide,'exclude'=>$eid );
	$taxoargs = apply_filters('uwpqsf_taxonomy_arg',$args,$taxname,$formid);
    $terms = get_terms($taxname,$taxoargs);
	$count = count($terms);
	$html  = '<div class="'.$defaultclass.' '.$divclass.'" id="tax-select-'.$c.'"><span class="taxolabel-'.$c.'">'.$taxlabel.'</span>';
	$html .= '<input  type="hidden" name="taxo['.$c.'][name]" value="'.$taxname.'">';
	$html .= '<input  type="hidden" name="taxo['.$c.'][opt]" value="'.$opt.'">';
	$html .= '<select multiple id="tdp-'.$c.'" class="multi tdp-class-'.$c.'" name="taxo['.$c.'][term]">';
		if(!empty($taxall)){
			$html .= '<option selected value="uwpqsftaxoall">'.$taxall.'</option>';
		}
			if ( $count > 0 ){
					foreach ( $terms as $term ) {
					$selected = (isset($_GET['taxo'][$c]['term']) && $_GET['taxo'][$c]['term'] == $term->slug) ? 'selected="selected"' : '';
					$html .= '<option value="'.$term->slug.'" '.$selected.'>'.$term->name.'</option>';}
		}
	$html .= '</select>';
	$html .= '</div>';
	return $html;
}

add_action('uwpqsf_form_bottom', 'form_reset', '', 1);
function form_reset($formid) {
	$html = '<button type="button" id="resetbtn" class="reset btn btn-default" value="clear">Clear</button>';
	echo $html;

}
*/


/* used with the ultimate wp query search filtering */
?>

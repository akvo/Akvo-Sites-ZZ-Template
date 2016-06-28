<?php 
	/*
		Template Name: Sustainability portal Page
	*/
?>

<?php
    $header_image = get_field('header_image');
    $financial_page = get_field('financial_page');
  	$institutional_page = get_field('institutional_page');
    $environmental_page = get_field('environmental_page');
    $social_page = get_field('social_page');
    $technical_page = get_field('technical_page');
	
		
	
	
?>

<?php get_header();?>
	<div class="container" id="main-page-container">
		<div class="row">
			<div class="col-md-12">
				<?php if(have_posts()):?>
         			<?php while ( have_posts() ) : the_post();?>
         				<?php the_content();?>
            		<?php endwhile;?>
          		<?php endif;?>
          		
          		
          		
         	</div>
		</div>
	</div><!-- End of Main Body Content -->
<?php get_footer();?>	

<style>
	
	#menu{
		list-style: none;
		padding-left: 0;
		text-align:center;
		border: #ccc solid 2px;
		padding: 20px 10px 10px 10px;
	}
	
	@media(min-width : 768px){
		#menu li{
			display: inline-block;
			padding-left: 5px;
			padding-right: 5px;
			min-width: 120px;
			width: 19%;
		}
	}
	
	
	#rsr{
		background-size: cover;
		width:100%;
		position: relative;
		min-height: 350px;
		width: 100%;
		padding-top:20px;	
		margin-bottom: 30px;
	}
	#rsr svg{
		left: 0 !important;
		display: block;
		margin: 0 auto;
	}
	
	#rsr h1{
		display: none;
	}
	
	#rsr.sub-page h1{
		display: block;
		text-shadow: 2px 2px 2px rgba(50, 50, 50, 1);
		text-transform: uppercase;
		font-size: 37px;
		color: #FFF;
		margin-left: 270px;
		margin-top: -40px;
		padding-bottom: 20px;
		font-weight: 400;
	}
	#rsr.sub-page svg{
		margin-left: 20px;
	}
	@media(max-width : 767px){
		#rsr.sub-page h1{
			margin-left: 20px;
			margin-top: 20px;
			text-align:center;
		}
		#rsr.sub-page svg{
			margin-left: auto;
		}
	}
	
</style>

<link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/js/wiel/qtip.min.css" />
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/wiel/qtip.min.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/wiel/raphael.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/wiel/<?php _e(get_field('current_page'));?>.js"></script>
<script type="text/javascript">
	 
	
	var links = {
		financial: '<?php echo $financial_page; ?>',
		institutional: '<?php echo $institutional_page; ?>',
		environmental: '<?php echo $environmental_page; ?>',
		technical: '<?php echo $technical_page; ?>',
		social: '<?php echo $social_page; ?>'
    };
    
    var $ = jQuery;
    $(function(){
    	for (var i = 0, len = rsrGroups.length; i < len; i++) {
            for (var j = 0, len2 = rsrGroups[i].length; j < len2; j++) {
                rsrGroups[i][j].glow({
                    width:7,
                    opacity:0.2
                });
            }

        }
        for (var i = 0, len = bollen.length; i < len; i++) {
        	var el = bollen[i];
        	var id=el.data('id');    
        
            el.mouseover(function() {
                
                this.attr({
                    cursor: 'pointer'
                });
                this.toFront();
                this.animate({
                    fill : '#FF6E01'
                }, 200);
                
            })
            .mouseout(function() {
                
                this.animate({
                    fill : '#ffffff'
                }, 200);
                
            })
            .mousedown(function(){
                document.location.href = links[this.data('id')];
            });
            addTip(el.node,id);

    	}
        function addTip(node, region){
            

            $(node).qtip({
                        content: {
                            text:region.charAt(0).toUpperCase() + region.slice(1)+' Sustainability'
                        },
                        position: {
                            viewport: $('.cDivSustainabilityHeader'),
                            my: 'top right',
                            at: 'bottom right'
                        },
                        style: {
                            classes: 'qtip-light qtipWiel',
                            tip: {
                                corner: true
                            }
                        }
                        ,
//                        style: {
//                            classes: 'ui-tooltip-custom',
//                            widget:false
//                        },
                        hide: {
                            fixed: true // Helps to prevent the tooltip from hiding ocassionally when tracking!
                        }
                    });

            }
    });
</script>
	
	
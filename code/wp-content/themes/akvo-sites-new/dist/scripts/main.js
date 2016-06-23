!function(n){var i={common:{init:function(){},finalize:function(){}},home:{init:function(){},finalize:function(){n(".box-wrap.dyno .thumb-wrapper").each(function(){var i=n(this).innerWidth()-15,t=i/1.77777778;n(this).css({height:t+"px"})}),window.addEventListener("resize",function(i){n(".box-wrap.dyno .thumb-wrapper").each(function(){var i=n(this).innerWidth()-15,t=i/1.77777778;n(this).css({height:t+"px"})})})}},about_us:{init:function(){}}},t={fire:function(n,t,e){var o,c=i;t=void 0===t?"init":t,o=""!==n,o=o&&c[n],o=o&&"function"==typeof c[n][t],o&&c[n][t](e)},loadEvents:function(){t.fire("common"),n.each(document.body.className.replace(/-/g,"_").split(/\s+/),function(n,i){t.fire(i),t.fire(i,"finalize")}),t.fire("common","finalize")}};n(document).ready(t.loadEvents)}(jQuery);
//# sourceMappingURL=main.js.map



/* Lazy Loading of the List */
(function($){

	$.fn.ajax_loading = function(){
        return this.each(function(){
			var btn = $(this);
            
            var ul = $(btn.data('list'));
			
			    
            
			ul.sanitize_url = function(){
				var url = ul.attr('data-url') ? ul.attr('data-url') : location.href;
				var hash_index = url.indexOf('#');
				if (hash_index > 0) { url = url.substring(0, hash_index);}
				url += (url.split('?')[1] ? '&':'?') + 'sjax=1';
				url = encodeURI(url);
				/* add page parameter to the request */
				var page = ul.page_inc();
				url += (url.split('?')[1] ? '&':'?') + 'akvo-paged=' + page;
				return url;
			};
			
			ul.page_inc = function(){
				var page = ul.attr('data-page') ? parseInt(ul.attr('data-page')) : 1;
				page += 1;
				ul.attr('data-page', page);
				return page;
			};
			
			ul.append_children = function(result){
				if($(result).find(ul.attr('data-target')).length){
					ul.attr('data-load-flag', '');
					btn.find('i').removeClass('fa-spin');
				}
				else{
					btn.hide();
				}
				
				$(result).find(ul.attr('data-target')).each(function(){
					var list = $(this);
					list.hide();
					list.appendTo(ul);
					list.show('slow');
					list.trigger('sjax:init', [list]);
				});	
			};
			
			ul.ajax_load = function(){
				ul.attr('data-load-flag', 'ajax');
				
				var url = ul.sanitize_url();
				console.log('lazy load initiated');
				
				jQuery.ajax({
    				url : url,
        			success : function(result){
        				console.log('lazy loading from sjax');
						ul.append_children(result);
            		},
        			error : function(){
        				console.log('lazy loading error');
        				btn.hide();
        			}
        		});
				
				
				
			};
			
			btn.click(function(ev){
				console.log('lazy loading clicked');
				btn.find('i').addClass('fa-spin');
				ul.ajax_load();
			});
			
			
		});
    };
    
    
    $('body').find("[data-behaviour~=ajax-loading]").ajax_loading();
    
    
    
   
}(jQuery));
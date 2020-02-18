var ms_search;

$(document).ready(function(){
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true
	});
	
	ms_search = $('input[name=search_asesor]').magicSuggest({
		data: base_url + 'penjadwalan/remote',
        hideTrigger: true,
        placeholder: 'Type & choose Asesor',
        useZebraStyle: true,
		required: true,
		maxSelection: 1,
        allowFreeEntries: false,
        ajaxConfig: {
		    type : 'post',
		    error : function(jqXHR){
				if (jqXHR.status == 444)
					sessionExpireHandler();
			}
		},
		dataUrlParams : {'action' : 'get-asesor'},
	});
	
});
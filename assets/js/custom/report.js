var ms_tuk;
var ms_asesor;

$(document).ready(function(){
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true
	});
	
	if ($('input[name=tuk]').length > 0){
		ms_tuk = $('#tuk').magicSuggest({
			data: base_url + 'penjadwalan/remote',
			hideTrigger: true,
			placeholder: 'Type & choose TUK',
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
			dataUrlParams : {'action' : 'get-tuk'},
		});
	}
	
	if ($('input[name=asesor]').length > 0){
		ms_asesor = $('#asesor').magicSuggest({
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
	}
});
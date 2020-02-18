var ms;

$(document).ready(function(){
	// set magic suggest
	ms = $('#form-search-pendaftaran').magicSuggest({
        data: base_url + 'pembayaran/remote',
        hideTrigger: true,
        placeholder: 'Type & find pendaftaran',
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
		dataUrlParams : {'action' : 'get-pendaftaran'},
    });
	
	$(ms).on('selectionchange', function(e,m){
		if (this.getValue() != ''){
			$.ajax({
				url : base_url + 'pembayaran/remote',
				method : 'post',
				dataType: 'json',
				data : {
					'action' : 'get-detail-pendaftar',
					'id'	: this.getValue()
				},
				beforeSend : function(){
					callLoader();
				}
			}).always(function(){
				endLoader();
			}).done(function(html){
				if (html.status == 'success')
				{
					$('.form-pembayaran-action').html(html.html);
					$('.form-pembayaran-action').slideDown();
				} 
				console.log(html);
				endLoader();
				iCheckInitialize();
				callback();
			}).fail(function(jqXHR, textStatus, errorThrown){
				if (jqXHR.status == 444)
					sessionExpireHandler();
				else
					callNoty('warning');
				console.log(textStatus);
			});
		} else {
			$('.form-pembayaran-action').slideUp();
		}
		
	});
	
	callback();
});



function callback(){	
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true
	});
}
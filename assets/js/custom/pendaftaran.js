var ms;
var ms_mitra;

$(document).ready(function(){
	$('select[name=id_skema]').on('change', function(){
		//callLoader();
		$('.mhs-form').html('');
		$('.mhs-form').slideUp();
		ms.clear();
		ms_mitra.clear();
		endLoader();
	});

	// set magic suggest
	ms = $('#form-nrp').magicSuggest({
        data: base_url + 'pendaftaran/remote',
        hideTrigger: true,
        placeholder: 'Type & choose NRP',
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
		dataUrlParams : {'action' : 'get-nrp'},
    });
	
	if (_mhs.length)
    	$('#form-nrp').magicSuggest().setSelection(_mhs);
	
	$(ms).on('selectionchange', function(e,m){
		if (this.getValue() != ''){
			$.ajax({
				url : base_url + 'pendaftaran/remote',
				method : 'post',
				dataType: 'json',
				data : {
					'action'   : 'get-mhs',
					'id'	   : this.getValue(),
					'id_skema' : $('select[name=id_skema]').val()
				},
				beforeSend : function(){
					//4callLoader();
				}
			}).always(function(){
				endLoader();
			}).done(function(html){
				if (html.status == 'success')
				{
					$('.mhs-form').html(html.html);
					$('.mhs-form').slideDown();
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
			$('.mhs-form').html('');
			$('.mhs-form').slideUp();
		}
		
	});
	
	ms_mitra = $('#find_name').magicSuggest({
        data: base_url + 'pendaftaran/remote',
        hideTrigger: true,
        placeholder: 'Find from system',
        useZebraStyle: true,
		maxSelection: 1,
        allowFreeEntries: false,
        ajaxConfig: {
		    type : 'post',
		    error : function(jqXHR){
				if (jqXHR.status == 444)
					sessionExpireHandler();
			}
		},
		dataUrlParams : {'action' : 'get-mitra-suggest'},
    });
	
	$(ms_mitra).on('selectionchange', function(e,m){
		$.ajax({
			url : base_url + 'pendaftaran/remote',
			method : 'post',
			dataType: 'json',
			data : {
				'action'   : 'get-mitra',
				'id'	   : this.getValue(),
				'id_skema' : $('select[name=id_skema]').val()
			},
			beforeSend : function(){
				//callLoader();
			}
		}).always(function(){
			endLoader();
		}).done(function(html){
			if (html.status == 'success')
			{
				$('.mhs-form').html(html.html);
				$('.mhs-form').slideDown();
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
		
	});
	
	callback();
});

function callback(){
	$('.type-pendaftaran').on('ifClicked', function(){
		console.log($(this).val());
		if ($(this).val() == 'mahasiswa'){
			ms.clear();
			$('.mhs-form').slideUp();			
			$('#pilihan_mitra').hide();			
			$('#pilihan_mahasiswa').show();		
		} else {			
			ms_mitra.clear();
			$('#pilihan_mitra').show();			
			$('#pilihan_mahasiswa').hide();		
			//3callLoadForm();
		}
		$('input[name=detail]').val($(this).val());
	});
	$('#datepicker').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true
	});
}

function callLoadForm(id){
	if (id == undefined){
		id = false;
	}
	$.ajax({
		url : base_url + 'pendaftaran/remote',
		method : 'post',
		dataType: 'json',
		data : {
			'action'   : 'get-mitra',
			'id'	   : id,
			'id_skema' : $('select[name=id_skema]').val()
		},
		beforeSend : function(){
			callLoader();
		}
	}).always(function(){
		endLoader();
	}).done(function(html){
		if (html.status == 'success')
		{
			$('.mhs-form').html(html.html);
			$('.mhs-form').slideDown();
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
}

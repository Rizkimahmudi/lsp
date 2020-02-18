var ms_tuk;
var ms_asesor;
var _cek = 0;
var ms_search;

$(function(){
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
	
	ms_tuk = $('#form-kd_tuk').magicSuggest({
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
	
	ms_asesor = $('#form-id_asesor').magicSuggest({
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
	
	$(ms_tuk).on('selectionchange', function(e,m){
		cek();			
	});
	$(ms_asesor).on('selectionchange', function(e,m){
		cek();			
	});
	$('input[name=tanggal]').on('change input', function(){
		cek();
	});
	
	$('select[name=skema]').on('change input', function(){
		if ($(this).val() != 'null')
			cek();
	});
	
	$('select[name=jam]').on('change input', function(){
		if ($(this).val() != 'null')
			cek();
	});
});

function cek(){
	tukVal = ms_tuk.getValue();
	asesorVal = ms_asesor.getValue();
	tanggalVal = $('input[name=tanggal]').val();
	skemaVal = $('select[name=skema]').val();
	jamVal = $('select[name=jam]').val();
	console.log('jam:'+jamVal+' skema'+skemaVal);
	
	if (tukVal != '' && asesorVal != '' && tanggalVal != '' && skemaVal != 'null' && jamVal != 'null'){
		$.ajax({
			url : base_url + 'rekap-asesmen/remote',
			method : 'POST',
			dataType: 'json',
			data : {
				'action' : 'get-rekap',
				'tuk' : tukVal,
				'asesor' : asesorVal,
				'tanggal' : tanggalVal,
				'skema' : skemaVal,
				'jam' : jamVal,
			},
			beforeSend : function(){
				callLoader();
			}
		}).always(function(){
			endLoader();
		}).done(function(html){
			$('#table-rekap').html(html.html);
			// if (html.status == 'success')
				// $('#button-simpan').show();
			// else 
				// $('#button-simpan').hide();
				
			console.log(html);
			endLoader();
			iCheckInitialize();
		}).fail(function(jqXHR, textStatus, errorThrown){
			if (jqXHR.status == 444)
				sessionExpireHandler();
			else
				callNoty('warning');
			console.log(textStatus);
		});
	}
}

$(document).on('click', '.rekapAsesmen', function(e){
	e.preventDefault();
	_id = $(this).data('id');
	$.ajax({
		url : base_url + 'rekap-asesmen/remote',
		method : 'POST',
		dataType: 'json',
		data : {
			'action' : 'get-rekap-detail',
			'id' : _id,
		},
		beforeSend : function(){
			callLoader();
		}
	}).always(function(){
		endLoader();
	}).done(function(data){
		$('.rekapAsesmenContent').html(data.html);
		if (data.status == 'success')
			$('#modal-rekap').modal('show');
			
		console.log(data);
		endLoader();
		iCheckInitialize();
	}).fail(function(jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 444)
			sessionExpireHandler();
		else
			callNoty('warning');
		console.log(textStatus);
	});
});

$(document).on('ifClicked', '.checkRekap', function(e){
	e.preventDefault();
	_id = $(this).data('id');
	_id_pendaftaran = $(this).data('pendaftar');
	$.ajax({
		url : base_url + 'rekap-asesmen/remote',
		method : 'POST',
		dataType: 'json',
		data : {
			'action' : 'set-rekap',
			'id' : _id,
			'id_pendaftaran' : _id_pendaftaran,
		},
		beforeSend : function(){
			//callLoader();
		}
	}).always(function(){
		endLoader();
	}).done(function(data){
		console.log(data);
		endLoader();
		iCheckInitialize();
	}).fail(function(jqXHR, textStatus, errorThrown){
		if (jqXHR.status == 444)
			sessionExpireHandler();
		else
			callNoty('warning');
		console.log(textStatus);
	});
});





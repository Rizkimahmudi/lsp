var ms_tuk;
var ms_asesor;
var jmlh_ = 0;
var ms_search;
var ms_tambahRekap;

function filterJam(){
	tukVal = ms_tuk.getValue();
	asesorVal = ms_asesor.getValue();
	tanggalVal = $('input[name=tanggal]').val();
	skemaVal = $('select[name=skema]').val();
	$('select[name=jam]').val('null');
	
	if (tukVal != '' && asesorVal != '' && tanggalVal != '' && skemaVal != ''){
		// alert('asdasd');
		$.ajax({
			url : base_url + 'penjadwalan/remote',
			method : 'POST',
			dataType: 'json',
			data : {
				'action' : 'get-jam',
				'tuk'	: tukVal,
				'asesor' : asesorVal,
				'tanggal' : tanggalVal,
				'skema' : skemaVal,
			},
			beforeSend : function(){
				callLoader();
			}
		}).always(function(){
			endLoader();
		}).done(function(html){
			if (html.status == 'success')
			{
				$('#jam-penjadwalan').html(html.html);
			} 
			console.log(html);
			endLoader();
		}).fail(function(jqXHR, textStatus, errorThrown){
			if (jqXHR.status == 444)
				sessionExpireHandler();
			else
				callNoty('warning');
			console.log(textStatus);
		});
	}
}

function callback(){
	$('#random-list').on('click', function(){
		swal({
			title: "Are you sure?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			confirmButtonText: "Yes",
			showLoaderOnConfirm: true,
			closeOnConfirm: true
		},function(isConfirm){
			if (isConfirm && $('select[name=skema]').val() != '')
				_getTableList($('select[name=skema]').val());
				
		});
	});
	$('select[name=skema]').on('change', function(){
		ms_tuk.clear();
		ms_asesor.clear();
		$('input[name=tanggal]').val('');
		$("select[name=jam]").val('null');
		
		_getTableList($(this).val());
	});
	
	var rule = {
		skema: {
			required: true,
		},
		kd_tuk : {
			required: true,
		},		
		id_asesor : {
			required: true,
		},	
		tanggal : {
			required: true,
		},	
	};
	
	$('#form-jadwal').validate({
		rule: rule,
		submitHandler: function(form) {
			error = 0;
			tukVal = ms_tuk.getValue();
			asesorVal = ms_asesor.getValue();
			tanggalVal = $('input[name=tanggal]').val();
			skemaVal = $('select[name=skema]').val();
			jamVal = $('select[name=jam]').val();
			
			if (skemaVal == null){
				error++;
				$('#error-skema').show();
				$('#error-skema').html('<i class="fa fa-times-circle-o"></i> Harap mengisi Skema').parent().addClass('has-error');
			} else 
				$('#error-skema').html('').parent().removeClass('has-error');
			
			if (tukVal == ''){
				error++;
				$('#error-tuk').show();
				$('#error-tuk').html('<i class="fa fa-times-circle-o"></i> Harap mengisi TUK').parent().addClass('has-error');
			} else 
				$('#error-tuk').html('').parent().removeClass('has-error');
			
			if (asesorVal == ''){
				error++;
				$('#error-asesor').show();
				$('#error-asesor').html('<i class="fa fa-times-circle-o"></i> Harap mengisi Asesor').parent().addClass('has-error');
			} else 
				$('#error-asesor').html('').parent().removeClass('has-error');
			
			if (tanggalVal == ''){
				error++;
				$('#error-tanggal').show();
				$('#error-tanggal').html('<i class="fa fa-times-circle-o"></i> Harap mengisi Tanggal').parent().addClass('has-error');
			} else 
				$('#error-tanggal').html('').parent().removeClass('has-error');
			
			if (jamVal == null){
				error++;
				$('#error-jam').show();
				$('#error-jam').html('<i class="fa fa-times-circle-o"></i> Harap mengisi Jam').parent().addClass('has-error');
			} else 
				$('#error-jam').html('').parent().removeClass('has-error');
			
			if (jmlh_ == 0){
				error++;
				$('#error-total').show();
				$('#error-total').html('<i class="fa fa-times-circle-o"></i> Total pendaftar yang tersedia adalah 0').parent().addClass('has-error');
			} else 
				$('#error-total').html('').parent().removeClass('has-error');
			
			if (error == 0)
				form.submit();
		}
	});
	
	$('.btn-detail').on('click', function(e){
		e.preventDefault();
		$.ajax({
			url : base_url + 'penjadwalan/remote',
			method : 'POST',
			dataType: 'json',
			data : {
				'action' : 'get-detail',
				'id'	: $(this).data('id')
			},
			beforeSend : function(){
				callLoader();
			}
		}).always(function(){
			endLoader();
		}).done(function(html){
			if (html.status == 'success')
			{
				$('#modal-detail-body').html(html.html);
				$('#modal-detail').modal('show');
				_setTambahRekap();
			} 
			console.log(html);
			endLoader();
		}).fail(function(jqXHR, textStatus, errorThrown){
			if (jqXHR.status == 444)
				sessionExpireHandler();
			else
				callNoty('warning');
			console.log(textStatus);
		});
	});
}

function _getTableList(id_skema){
	$.ajax({
		url : base_url + 'penjadwalan/remote',
		method : 'POST',
		dataType: 'json',
		data : {
			'action' : 'get-pendaftar-list',
			'id_skema'	: id_skema
		},
		beforeSend : function(){
			callLoader();
		}
	}).always(function(){
		endLoader();
	}).done(function(html){
		if (html.status == 'success')
		{
			$('#table-pendaftar').html(html.html);
			$('#id-jumlah-pendaftar').html(html.total);
			jmlh_ = html.total;
			$('input[name=pendaftar_id]').val(html.pendaftar_list);
		} 
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

function _setTambahRekap(){
	_skema = $('input[name=tambah_pendaftar]').data('skema');
	ms_tambahRekap = $('input[name=tambah_pendaftar]').magicSuggest({
		data: base_url + 'penjadwalan/remote',
        hideTrigger: true,
        placeholder: 'Type & choose Pendaftar',
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
		dataUrlParams : {'action' : 'get-pendaftar', 'id_skema' : _skema},
	});
}

$(document).ready(function(){
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true
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
	
	$(ms_tuk).on('selectionchange', function(e,m){
		filterJam();			
	});
	$(ms_asesor).on('selectionchange', function(e,m){
		filterJam();			
	});
	$('input[name=tanggal]').on('change input', function(){
		filterJam();
	});
	
	callback();
});

$(document).on('click', '.btnAddPendaftar', function(e){
	e.preventDefault();
	a = ms_tambahRekap.getValue();
	if (a != ''){
		$.ajax({
			url : base_url + 'penjadwalan/remote',
			method : 'POST',
			dataType: 'json',
			data : {
				'action' : 'set-pendaftar',
				'id_jadwal'	: $('input[name=id_jadwal]').val(),
				'pendaftar' : a,
			},
			beforeSend : function(){
				callLoader();
			}
		}).always(function(){
			endLoader();
		}).done(function(html){
			if (html.status == 'success')
			{
				$('#modal-detail-body').html(html.html);
				// $('#modal-detail').modal('show');
				_setTambahRekap();
				$('#count-'+html.id).html(html.count+' Peserta');
			} 
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
});

$(document).on('click', '.hapusFromJadwal', function(e){
	e.preventDefault();
	a = $(this).data('id');
	id_jadwal = $(this).data('jadwal');
	swal({
		title: "Are you sure?",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-warning",
		confirmButtonText: "Yes",
		showLoaderOnConfirm: true,
		closeOnConfirm: true
	},function(isConfirm){
		if (isConfirm){
			$.ajax({
				url : base_url + 'penjadwalan/remote',
				method : 'POST',
				dataType: 'json',
				data : {
					'action' : 'delete-pendaftar',
					'id_jadwal'	: id_jadwal,
					'pendaftar' : a,
				},
				beforeSend : function(){
					callLoader();
				}
			}).always(function(){
				endLoader();
			}).done(function(html){
				if (html.status == 'success')
				{
					// $('#modal-detail-body').html(html.html);
					_setTambahRekap();
					$('#count-'+html.id).html(html.count+' Peserta');
				} 
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
	});
});

$(document).on('click', '.absensiJadwal', function(e){
	e.preventDefault();
	// rekapAbsensi
	id_jadwal = $(this).data('id');
	$.ajax({
		url : base_url + 'penjadwalan/remote',
		method : 'POST',
		dataType: 'json',
		data : {
			'action' : 'get-absensi',
			'id_jadwal'	: id_jadwal,
		},
		beforeSend : function(){
			callLoader();
		}
	}).always(function(){
		endLoader();
	}).done(function(html){
		if (html.status == 'success')
		{
			$('.rekapAbsensi').html(html.html);
			$('#modal-absensi').modal('show');
		} 
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
});

$(document).on('click', '.simpanAbsensi', function(e){
	e.preventDefault();
	_data = $('#form-absensi').serialize();
	error = 0;
	
	$('div.pilihan > div.row').each(function(index,element){
		if ($(this).find('input[type=radio]:checked').length == 0)
			error++;
	});
	
	if (error == 0){
		swal({
			title: "Are you sure?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-warning",
			confirmButtonText: "Yes",
			showLoaderOnConfirm: true,
			closeOnConfirm: true
		},function(isConfirm){
			if (isConfirm){
				$.ajax({
					url : base_url + 'penjadwalan/remote',
					method : 'POST',
					dataType: 'json',
					data : _data,
					beforeSend : function(){
						callLoader();
					}
				}).always(function(){
					endLoader();
				}).done(function(html){
					console.log(html);
					$('#modal-absensi').modal('toggle');
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
		});
	}
});


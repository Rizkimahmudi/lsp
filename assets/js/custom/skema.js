$(function(){
	$('.detail-skema').on('click', function(e){
		e.preventDefault();
		$('#modal-detail-title').html($(this).data('title'));
		$.ajax({
			url : base_url + 'setting/skema/remote',
			method : 'POST',
			dataType: 'json',
			data : {
				'action' : 'detail_skema',
				'id'	: $(this).data('id'),
			},
			beforeSend : function(){
				callLoader();
			}
		}).always(function(){
			endLoader();
		}).done(function(html){
			if (html.status == 'success')
			{
				$('#modal-detail-skema').html(html.html);
				$('#modal-skema').modal('show');
			} 
			console.log(html);
			endLoader();
			callbackModal();
		}).fail(function(jqXHR, textStatus, errorThrown){
			if (jqXHR.status == 444)
				sessionExpireHandler();
			else
				callNoty('warning');
			console.log(textStatus);
		});
	});
	callbackModal();
});

function callbackModal(){
	$('#save-kompetensi').on('click', function(e){
		e.preventDefault();
		$.ajax({
			url : base_url + 'setting/skema/remote',
			method : 'POST',
			dataType: 'json',
			data : $('#form-kompetensi').serialize(),
			beforeSend : function(){
				callLoader();
			}
		}).always(function(){
			endLoader();
		}).done(function(html){
			if (html.status == 'success')
				$('#modal-detail-skema').html(html.html);
			else  
				$('#form-detail-skema-on-modal').html(html.html);
			
			console.log(html);
			endLoader();
			callbackModal();
		}).fail(function(jqXHR, textStatus, errorThrown){
			if (jqXHR.status == 444)
				sessionExpireHandler();
			else
				callNoty('warning');
			console.log(textStatus);
		});
	});
	
	$('.reset-kompetensi').on('click', function(e){
		e.preventDefault();
		$.ajax({
			url : base_url + 'setting/skema/remote',
			method : 'POST',
			dataType: 'json',
			data : {
				'action' : 'reset-form',
				'id'	: $(this).data('id')
			},
			beforeSend : function(){
				callLoader();
			}
		}).always(function(){
			endLoader();
		}).done(function(html){
			$('#form-detail-skema-on-modal').html(html.html);
			console.log(html);
			endLoader();
			callbackModal();
		}).fail(function(jqXHR, textStatus, errorThrown){
			if (jqXHR.status == 444)
				sessionExpireHandler();
			else
				callNoty('warning');
			console.log(textStatus);
		});
	});
	
	$('.edit-modal-kompetensi').click(function(e){
		e.preventDefault();
		$.ajax({
			url : base_url + 'setting/skema/remote',
			method : 'POST',
			dataType: 'json',
			data : {
				'action' : 'edit-kompetensi',
				'id'	: $(this).data('id'),
				'tipe'	: $(this).data('edit'),
			},
			beforeSend : function(){
				callLoader();
			}
		}).always(function(){
			endLoader();
		}).done(function(html){
			$('#form-detail-skema-on-modal').html(html);
			console.log(html);
			endLoader();
			callbackModal();
		}).fail(function(jqXHR, textStatus, errorThrown){
			if (jqXHR.status == 444)
				sessionExpireHandler();
			else
				callNoty('warning');
			console.log(textStatus);
		});
	});
	
	$('.add-detail-kompetensi').click(function(e){
		e.preventDefault();
		$.ajax({
			url : base_url + 'setting/skema/remote',
			method : 'POST',
			dataType: 'json',
			data : {
				'action' : 'add-detail-kompetensi',
				'id'	: $(this).data('id'),
				'parent': $(this).data('parent'),
			},
			beforeSend : function(){
				callLoader();
			}
		}).always(function(){
			endLoader();
		}).done(function(html){
			$('#form-detail-skema-on-modal').html(html);
			console.log(html);
			endLoader();
			callbackModal();
		}).fail(function(jqXHR, textStatus, errorThrown){
			if (jqXHR.status == 444)
				sessionExpireHandler();
			else
				callNoty('warning');
			console.log(textStatus);
		});
	});
	
	$('.confirm-skema').click(function(e){
		e.preventDefault();
		var _id = $(this).data('id');
		var _tipe = $(this).data('tipe');
		swal({
			title: "Are you sure?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Yes",
			showLoaderOnConfirm: true,
			closeOnConfirm: true
		},function(isConfirm){
			if (isConfirm){
				$.ajax({
					url : base_url + 'setting/skema/remote',
					method : 'POST',
					dataType: 'json',
					data : {
						'action' : 'delete-kompetensi',
						'id'	: _id,
						'tipe'	: _tipe,
					},
					beforeSend : function(){
						callLoader();
					}
				}).always(function(){
					endLoader();
				}).done(function(html){
					$('#modal-detail-skema').html(html);
					console.log(html);
					endLoader();
					callbackModal();
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

}
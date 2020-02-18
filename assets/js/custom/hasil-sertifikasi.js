$(function(){
	$('.kompeten-sertifikasi').on('ifClicked', function(e){
		e.preventDefault();
		$.ajax({
			url : base_url + 'hasil-sertifikasi/remote',
			method : 'post',
			dataType: 'json',
			data : {
				'action' : 'update-pendaftaran',
				'id'	: $(this).data('id')
			},
			beforeSend : function(){
				// callLoader();
			}
		}).always(function(){
			endLoader();
		}).done(function(html){
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
	
	$('.detail-sertifikasi').on('click', function(e){
		$.ajax({
			url : base_url + 'hasil-sertifikasi/remote',
			method : 'post',
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
			$('#modal-detail-body').html(html);
			$('#modal-detail').modal('show');
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
});
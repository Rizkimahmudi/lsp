$(document).on('change', 'select[name=id_skema]', function(){
	val = $(this).val();
	window.location.replace(base_url+"/daftar?&id_skema="+val);
});
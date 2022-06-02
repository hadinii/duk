$(document).ready(function() {
	$('.btn-edit').click(function() {
		$('#modal-create-edit').modal('show');
		const data = JSON.parse(this.dataset.id);

		$('#form-create-edit input[name=id_gaji]').val(data.id_gaji);
		$('#form-create-edit input[name=jabatan_id]').val(data.jabatan_id);
		$('#form-create-edit input[name=masa_kerja]').val(data.masa_kerja);
		$('#form-create-edit input[name=condition]').val(data.condition);
		$('#form-create-edit input[name=gaji_pokok]').val(data.gaji_pokok);
		
		console.log(JSON.parse(this.dataset.id));
	})
});

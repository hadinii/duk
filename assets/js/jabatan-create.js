// let count = 0;
// let $wrapper;
// $(document).ready(function() {
//     $('#is_increment').change(function(){
// 		console.log(this.checked);
// 		if(this.checked){
// 			if($wrapper){
// 				$('#box-jenjang').append($wrapper);
// 			}else{
// 				appendJenjang();
// 			}
// 			$('#box-jenjang').show();
// 		}else{
// 			$('#box-jenjang').hide();
// 			$wrapper = $('#container-jenjang').detach();
// 		}
// 	});

// 	$('#btn-tambah-jenjang').click(function(){
// 		appendJenjang();
// 	});

// });

// function appendJenjang() {
// 	$('#container-jenjang')
// 	.append(`<div class="box-body">
// 			<div class="form-group">
// 				<label class="col-md-2 control-label">Kondisi</label>
// 				<div class="col-md-8">
// 					<select name="condition[${count}]" id="condition[${count}]" class="form-control" required>
// 						<option value=">">Lebih dari (>)</option>
// 						<option value="<">Kurang dari (<)</option>
// 						<option value="=">Sama dengan (=)</option>
// 						<option value="Range">Range</option>
// 					</select>
// 				</div>
// 				<div class="col-md-2">
// 					<button type="button" id="btn-hapus-jenjang" class="btn btn-box-tool btn-danger text-white" title="Hapus Jenjang"><i class="fa fa-minus"></i></button>
// 				</div>
// 			</div>
// 			<div class="form-group">
// 				<label class="col-md-2 control-label">Masa Kerja</label>
// 				<div class="col-md-8">
// 					<input type="number" name="masa_kerja[${count}]" class="form-control" required>
// 				</div>
// 			</div>
// 			<div class="form-group">
// 				<label class="col-md-2 control-label">Gaji Pokok</label>
// 				<div class="col-md-8">
// 					<input type="number" name="gaji_pokok[${count}]" class="form-control" required>
// 				</div>
// 			</div>
// 	</div>`);
// 	count++;
// } 

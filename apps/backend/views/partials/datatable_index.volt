
{{ stylesheet_link("/library/datatables/dataTables.bootstrap.css") }}

<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">{{ language._('list') }} <small></small></h3>
		</div>

		<div class="box-body table-responsive" style="padding:10px 15px">
			<table id="table_data" class="table table-bordered table-striped">
				{{ partial("partials/filter") }}
			</table>
		</div>
	</div>
</section>

<!-- Datatables -->
{{ javascript_include("/library/datatables/js/jquery.dataTables.min.js") }}
{{ javascript_include("/library/datatables/dataTables.bootstrap.min.js") }}
<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#table_data').DataTable({
			// dom: 'lBfrtip',
			serverSide: true,// -->> tìm phân biệt hoa thường
			autoWidth: false,
			pagingType: "full_numbers",
			ajax: {
				url: "{{ url(define.backend~'/'~router.getControllerName()~'/'~router.getActionName()) }}",
				method: 'POST'
			},
			order: [[ "{{ col_order is defined and col_order is not empty ? col_order : 0}}", "{{ sort is defined and sort is not empty ? sort : 'asc'}}" ]],
			aoColumns: [
				{{ json_data is defined ? json_data : '' }}
			],
			fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				for (var i in aData)  {
					custom_check($('td:eq(0) input', nRow));

					//is check
					$($('td:eq(0) input', nRow)).on('ifChecked', function(event){
						$(this).parent().parent().parent().addClass('selected');
					});

					//not check
					$($('td:eq(0) input', nRow)).on('ifUnchecked', function(event){
						$(this).parent().parent().parent().removeClass('selected');
					});
				}
			},
			language: {
				{{ language._('table_lengthMenu') }},
				{{ language._('table_zeroRecords') }},
				{{ language._('table_info') }},
				{{ language._('table_infoEmpty') }},
				{{ language._('table_infoFiltered') }},
				{{ language._('table_search') }},
				{{ language._('table_paginate') }}
			}
		});
		custom_check($('input.flat'));
		
		//check all
		$('input#check-all').on('ifChecked', function(event){
			$('#table_data').find('tr').each(function (i, el) {
				$(this).addClass('selected');
				$(this).find('td').find('div').addClass('checked');
			});
			
			if(this.checked){
				var status = this.checked;
				$(".flat").each( function() {
					$(this).prop("checked",status);
				});
			} 
		});
		//not check all
		$('input#check-all').on('ifUnchecked', function(event){
			$('#table_data').find('tr').each(function (i, el) {
				$(this).removeClass('selected');
				$(this).find('td').find('div').removeClass('checked');
			});
			$(".flat").each( function() {
				$(this).prop("checked",false);
			});
		});

		// Tìm theo column
		$('.search-input-text').on( 'keyup click', function () {   // for text boxes
			var i =$(this).attr('data-column');  // getting column index
			var v =$(this).val();  // getting search input value
			table.columns(i).search(v).draw();
		});
		$('.search-input-select').on( 'change', function () {   // for select box
			var i =$(this).attr('data-column');
			var v =$(this).val();
			table.columns(i).search(v).draw();
		});

		//Xóa nhiều
		$('#deleteTriger').on("click", function(event){ // triggering delete one by one
			if( $('tbody .flat:checked').length > 0 ){  // at-least one checkbox checked
				var ids = [];
				$('tbody .flat').each(function(){
					if($(this).is(':checked')) { 
						ids.push($(this).parent().parent().parent().find('td.sorting_1').html());
					}
				});
				var ids_string = ids.toString();  // array to string conversion 
				
				$.confirm({		
					confirm: function() {
						$.ajax({
							type: "POST",
							url: "{{ url(define.backend~'/'~router.getControllerName()~'/bulkDelete') }}",
							data: {data_ids:ids_string},
							success: function(result) {
								table.draw(); // redrawing datatable
							},
							async:false
						});    
					},
					cancel: function() {
					   
					},
					close : function(){
						
					},
					title: 'Thông báo',
					text: 'Xóa dữ liệu mã số '+ids_string,
					confirmButton: confirm.agree,
					cancelButton: confirm.cancel,
				});				
			} else {
				$.confirm({
					title: 'Thông báo',
					text: 'Vui lòng chọn ít nhất là một phần tử!',
					confirmButton: confirm.agree,
					cancelButton: confirm.cancel,
				});
			}
		}); 
	});

	function custom_check(_obj){
		_obj.iCheck({
			checkboxClass : 'icheckbox_flat-green',
			radioClass : 'iradio_flat-green',
		});
	}
</script> 

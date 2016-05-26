$(document).ready(function () {
		// prepare the data
		
      
		var source =
		{
			datatype: "json",
			datafields: [
			{ name: 'country_code', type: 'string'},
			{ name: 'country_name', type: 'string' }
			
		],
		cache: false,
		url: '<?php echo base_url() ?>index.php/welcome/jqxdatatableAjax',
		filter: function()
		{
			// update the grid and send a request to the server.
			$("#jqxgrid").jqxGrid('updatebounddata', 'filter');
		},
		sort: function()
		{
			// update the grid and send a request to the server.
			$("#jqxgrid").jqxGrid('updatebounddata', 'sort');
		},
		root: 'Rows',
		beforeprocessing: function(data)
		{		
			if (data != null)
			{
				source.totalrecords = data[0].TotalRows;					
			}
		}
		};		
		var dataadapter = new $.jqx.dataAdapter(source, {
			loadError: function(xhr, status, error)
			{
				alert(error);
			}
		}
		);
	
		// initialize jqxGrid
		$("#jqxgrid").jqxGrid(
		{		
			source: dataadapter,
			
			filterable: true,
			sortable: true,
			autoheight: true,
			pageable: true,
			virtualmode: true,
			rendergridrows: function(obj)
			{
				return obj.data;    
			},
			columns: [
				{ text: 'Country code', datafield: 'country_code', width: 300 },
				{ text: 'Country Name', datafield: 'country_name', width: 300 }
		
			]
		});
	});
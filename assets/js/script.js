      
	$("#image-uploader").fileinput({
		'theme': 'explorer-fas',
		'uploadUrl': '#',
		dropZoneEnabled: false,
		browseOnZoneClick: true,
		showRemove: false,
		showUpload: false,
		showCancel: false,
		showCaption: false,
		showClose: false,
		browseClass: "btn btn-success btn-block",
		browseIcon: '<i class="fas fa-image"></i>',
		browseLabel: '&ensp;Click here to choose profile image',
		focusCaptionOnBrowse: true,
		allowedFileTypes: ["image"],
		allowedFileExtensions: ["jpg", "jpeg", "png"],
		maxFileSize: 2048,
		fileActionSettings: {
			showRemove: true,
			showZoom: false,
			showUpload: false,
			removeClass: 'btn btn-sm btn-danger',
			zoomClass: 'btn btn-sm btn-info' 
		},
  
	});


	//$('#dataTable').DataTable();
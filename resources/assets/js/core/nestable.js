$(document).ready(function()
{
	var updateOutput = function(e)
	{
		var list   = e.length ? e : $(e.target),
				output = list.data('output');
		if (window.JSON) {
			var data =  window.JSON.stringify(list.nestable('serialize'));
			if(data.match(/\"id\"/)){
				$.ajax({
					url: Main.getLangLink('/structure/rebuild'),
					method:"POST",
					data: {
						data : data
					},
					success: function (res) {

					}
				});
			}
		} else {
			output.val('JSON browser support required for this demo.');
		}
	};

	$('#nestable').nestable({
				group: 1
			})
			.on('change', updateOutput);

});
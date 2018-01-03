function deleteFunc(){
	var btn = document.getElementById('delete_form');
	var cfrm = confirm('Are you sure delete ?');
	if (cfrm) {
		btn.submit();
	};
}
// add ev
//ent listener to the close button
document.addEventListener("DOMContentLoaded", function() {
	document.getElementById('closebtn').addEventListener('click', function() {
		// close the error message
		document.getElementById('loginError').style.display = 'none';
	});
});
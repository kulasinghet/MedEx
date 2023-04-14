<?php

use app\views\pharmacy\Components;

$components = new Components();
echo $components->viewHeader("Contact Us");
echo $components->navBar($_SESSION['username']);
echo $components->sideBar('contact-us');

?>

<div class="canvas nav-cutoff sidebar-cutoff">
    <div class="canvas-inner">
        <div class="row">
            <div class="col ">

                <div class="contact-us">
                    <h1>Contact Us</h1>


                <form>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Subject</label>
                        <input type="text" class="form-input" id="exampleFormControlInput1" placeholder="Subject">
                    </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Message</label>
                            <textarea class="form-input" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="sendMessage()">Send</button>
                    </form>

                </div>

            </div>


        </div>
    </div>
</div>


<!-- [1] -->


<script>
	function sendMessage() {

		fetch('http://localhost:8080/medex/api/v1/pharmacy/contact-us', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({
				"subject": document.getElementById("exampleFormControlInput1").value,
				"message": document.getElementById("exampleFormControlTextarea1").value
			})
		}).then(response => {

			if (response.status === 200) {
				Swal.fire({
					title: 'Message Sent!',
					text: 'Your message has been sent to the MedEx team.',
					icon: 'success',
					confirmButtonText: 'OK'
				}).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload(); // refresh page
                    }
                })
		}
	else
		{
			Swal.fire({
				title: 'Error!',
				text: 'Something went wrong. Please try again.',
				icon: 'error',
				confirmButtonText: 'OK'
			})
		}
	}

	).then(response => {
		console.debug(response);
		// ...
	}).catch(error => {
		Swal.fire({
			title: 'Error!',
			text: 'Something went wrong. Please try again.',
			icon: 'error',
			confirmButtonText: 'OK'
		})
		console.error(error);
	});


	}
</script>


</body>
</html>

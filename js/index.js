$(function(){

	var editing = false;

	// Hidden elements
	$('#taskSearchResult').hide();
	$('#deleteAlert').hide();
	$('#successAlert').hide();
	$('#editingAlert').hide();
	$('#userContainer').hide();
	$('#nonUser').hide();


	// Functions
	verifyUser();
	fetchTasks();

	// Search Form
	$('#searchForm').keyup(function(event) {

		if ($('#searchForm').val()) {			

			// Get input value
			let search = $('#searchForm').val();

			// Query
			$.ajax({
				url: 'php/taskSearch.php',
				type: 'POST',
				data: { search },
				success: function(response){
					let tasks = JSON.parse(response);
					let template = '';

					tasks.forEach(task => {
						template += `<li>${task.name}</li>`
					})

					$('#taskSearchContainer').html(template);
					$('#taskSearchResult').show('fast');

				}
			}); // end query
		}else{
			$('#taskSearchResult').hide('fast');
		}
	}); // end search form

	// Add task
	$('#taskForm').submit(function(event) {
		event.preventDefault();
		$('#deleteAlert').hide();
		$('#successAlert').hide();

		// Get inputs data
		const taskData = {
			name: $('#taskName').val(),
			description: $('#taskDescription').val(),
			id: $('#taskID').val()
		}

		var url = ''

		// Edit or add task
		if (editing == true) {
			url = 'php/editTask.php';
		}else{
			url = 'php/addTask.php';
		}

		// Add task to DB
		$.post(url, taskData, function(response) {
			
			// Clear input box
			$('#taskForm').trigger('reset');

			// Reload task table
			fetchTasks();

			// Show success alert
			$('#successAlert').show('fast');
			$('#editingAlert').hide();

			editing = false;

		});
	});

	// Function List Tasks
	function fetchTasks(){
		$.ajax({
			url: 'php/listTasks.php',
			type: 'GET',
			success: function (response) {
				let tasks = JSON.parse(response);
				let template = '';

				tasks.forEach(task => {
					template += `
					<tr taskId = "${task.id}">
					<td>${task.id}</td>
					<td>
					<a href="#" class="taskItem">${task.name}</a>
					</td>
					<td>${task.description}</td>
					<td>
					<button class="deleteTask btn btn-danger">Delete</button>
					</td>
					</tr>
					`
				});

				$('#taskBody').html(template);
			}
		});
	}

	// Delete Task OnClick Event
	$(document).on('click', '.deleteTask', function(event) {
		event.preventDefault();
		$('#deleteAlert').hide();
		$('#successAlert').hide();

		if (confirm('Are you sure you want to delete it?')) {
			// Get row of clicked task
			let element = $(this)[0].parentElement.parentElement;
			let id = $(element).attr('taskId');
			$.ajax({
				url: 'php/deleteTask.php',
				type: 'POST',
				data: {id},
				success: function(response){
					console.log(response);
					fetchTasks();
					$('#deleteAlert').show('fast');
				}
			});
		}
	});


	// Edit Task OnClick Event
	$(document).on('click', '.taskItem', function(event) {
		event.preventDefault();

		$('#editingAlert').show('fast');


		let element = $(this)[0].parentElement.parentElement;
		let id = $(element).attr('taskId');

		$.post('php/getTask.php', {id}, function(response) {
			const task = JSON.parse(response);
			$('#taskName').val(task.name);
			$('#taskDescription').val(task.description);
			$('#taskID').val(task.id);

			editing = true;
		});
		
	});

	function verifyUser(){
		$.get('php/getUser.php', function(data) {
			try{
				var user = JSON.parse(data);
				$('#userContainer').show();
				$('#logInNavBar').hide();
				$('#userDropdown').html(user.name);
				$('#userNavBar').show();
			}
			catch{
				
				$('#userNavBar').hide();
				$('#logInNavBar').show();
				$('#nonUser').show();


			}

		});
	}
})
<?php 
$json_file = file_get_contents('data.json');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Resources</title>	
	<link rel="stylesheet" href="assets/style.css">	
</head>
<body>
<h3>Table of contents (<span style="color: #136F63">free</span> | 
	<span style="color: #DA4167">paid</span> | ❤️ Favorite) |
	🖥️ Desktop app)
</h3>
<nav>
	<ul class="menu">
		<li class="menu__item">
			<a href="#images">Images</a>
		</li>
		<li class="menu__item">
			<a href="#icons">Icons</a>
		</li>
		<li class="menu__item">
			<a href="#fonts">Fonts</a>
		</li>
		<li class="menu__item">
			<a href="#colors">Colors</a>
		</li>
		<li class="menu__item">
			<a href="#design">Design</a>
		</li>
		<li class="menu__item">
			<a href="#tools">Tools</a>
		</li>
	</ul>
</nav>

<div id="app">
	<div class="box" id="images"></div>

	<div class="box" id="illustrations"></div>

	<div class="box" id="fonts"></div>

	<div class="box" id="colors"></div>

	<div class="box" id="design"></div>

	<div class="box" id="tools"></div>
</div>
<!-- <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script> -->
<script>
	try {
		var jsonData = JSON.parse(`<?= $json_file ?>`);	
	} catch (error) {
		console.log(error);
		var jsonData = null;
	}

	const resourceKeys = Object.keys(jsonData);
	
	function populate(resource) {
		if (resource === null) return;
		const parent = document.querySelector('#' + resource);
		if (parent === null) return;
		const resourceData = jsonData[resource];
		// Create title
		const h4 = document.createElement('h4');
		h4.innerHTML = resourceData.title;
		// Create resources
		const list = document.createElement('ul');
		list.classList.add('list');
		// Add element to resources		
		resourceData.resources.forEach((resource) => {
			const li = document.createElement('li');
			li.classList.add('list__item');
			li.classList.add(resource.model);
			li.innerHTML = `<a href="${resource.url}" target="_blank">${resource.name}</a>`;
			list.appendChild(li);
		});
		// Add to parent
		parent.appendChild(h4);
		parent.appendChild(list);
	}

	resourceKeys.forEach(resource => populate(resource));
</script>
</body>
</html>
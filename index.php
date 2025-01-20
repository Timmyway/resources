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
		<?php 
			$sections = ['images', 'icons', 'fonts', 'colors', 'design', 'inspirations', 'css', 'video', 'ai', 'tools'];
			foreach ($sections as $section) {
				echo '<li class="menu__item"><a href="#' . $section . '">' . ucfirst($section) . '</a></li>';
			}
		?>
	</ul>

	<!-- Resource Sections -->
	<div id="app">
		<?php 
			foreach ($sections as $section) {
				echo '<div class="box" id="' . $section . '"></div>';
			}
		?>
	</div>
</nav>

<script>
	// Load JSON Data
	try {
		var jsonData = JSON.parse(`<?= $json_file ?>`);
	} catch (error) {
		console.error(error);
		var jsonData = null;
	}

	// Function to create an element with specific attributes and classes
	function createElement(tag, options = {}) {
		const element = document.createElement(tag);
		if (options.classes) {
			element.classList.add(...options.classes);
		}
		if (options.html) {
			element.innerHTML = options.html;
		}
		if (options.attrs) {
			Object.keys(options.attrs).forEach(attr => element.setAttribute(attr, options.attrs[attr]));
		}
		return element;
	}

	// Populate content for each resource section
	function populateSection(resourceKey) {
		if (!jsonData || !jsonData[resourceKey]) return;

		const resourceData = jsonData[resourceKey];
		const parent = document.querySelector('#' + resourceKey);
		if (!parent) return;

		// Create and append title
		const title = createElement('h4', { html: resourceData.title });
		parent.appendChild(title);

		// Create and append resource list
		const list = createElement('ul', { classes: ['list'] });
		resourceData.resources.forEach(resource => {
			const listItem = createElement('li', {
				classes: ['list__item', resource.model],
				html: `<a href="${resource.url}" target="_blank">${resource.name}</a>`
			});
			list.appendChild(listItem);
		});
		parent.appendChild(list);
	}

	// Populate all sections dynamically
	Object.keys(jsonData || {}).forEach(populateSection);
</script>
</body>
</html>
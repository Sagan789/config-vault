function addConfigItems(n) {
	var container = $("#config_items");
	var n_items = $("#itemsCount").val();
	var item_number;

	for (i=1;i<=n;i++) {
		item_number = +i + +n_items;
		var formgroup = document.createElement('div');
		formgroup.setAttribute('class', 'form-group');
		var labelcontainer = document.createElement('div');
		labelcontainer.setAttribute('class', 'col-lg-6');
		var inputcontainer = document.createElement('div');
		inputcontainer.setAttribute('class', 'col-lg-6');

		createLabel('Item Key', labelcontainer, item_number);
		createInput('item_key', labelcontainer, item_number, 'Key');

		createLabel('Item Value', inputcontainer, item_number);
		createInput('item_value', inputcontainer, item_number, 'Value');

		formgroup.appendChild(labelcontainer);
		formgroup.appendChild(inputcontainer);
		container.append(formgroup);
	}
	$("#itemsCount").val(+$("#itemsCount").val()+ +n);
}

function createLabel(name, container, item_number) {
	var label = document.createElement('label');
	label.setAttribute('for', name+'_'+item_number);
	label.appendChild(document.createTextNode(name +' #'+item_number));
	container.appendChild(label);
}

function createInput(name, container, item_number, placeholder) {
	var input = document.createElement('input');
	input.setAttribute('type', 'text');
	input.setAttribute('placeholder', placeholder);
	input.setAttribute('name', name+'_'+item_number);
	input.setAttribute('id', name+'_'+item_number);
	input.setAttribute('class', 'form-control');
	container.appendChild(input);
}

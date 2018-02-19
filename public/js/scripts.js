var $collectionHolder;

// setup an "add a item" link
var $addItemLink = $('<a href="#" class="collection-add btn btn-default" title="Add Parameter"><span class="glyphicon glyphicon-plus-sign"></span></a>');
var $newLinkDiv = $('<div class="item-actions"></div>').append($addItemLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of config-items
    $collectionHolder = $('div.config-items');

    // add a delete link to all of the existing item form div elements
    console.log('collection holder');
    console.log($collectionHolder);

    $collectionHolder.find(".item-form").each(function() {
        addItemFormDeleteLink($(this));
    });
    // add the "add a item" anchor and div to the config-items div

    console.log('add the "add a item" anchor and div to the config-items div');
    $collectionHolder.append($newLinkDiv);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    console.log('count the current form inputs we have');
    $collectionHolder.data('index', $collectionHolder.find(':input').length);
    console.log($collectionHolder.find(':input').length);

    $addItemLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        // add a new tag form (see next code block)
        addItemForm($collectionHolder, $newLinkDiv);
    });
});

function addItemForm($collectionHolder, $newLinkDiv) {
    console.log('addItemForm ');
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');
    console.log('prototype = '+prototype);
    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

   // newForm = newForm.replace(/id="config_form_items/g, 'class="config-item-form" id="config_item');

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);
    console.log('append newForm');
    // Display the form in the page in an div, before the "Add a item" link div
    var $newFormDiv = $('<div class="item-form"></div>').append(newForm);
    $newLinkDiv.before($newFormDiv);

    addItemFormDeleteLink($newFormDiv);
}

function addItemFormDeleteLink($itemFormDiv) {
    var $removeFormA = $('<a href="#" class="collection-remove btn btn-default" title="Delete Parameter"><span class="glyphicon glyphicon-trash"></span></a>');
    $itemFormDiv.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $itemFormDiv.remove();
    });
}
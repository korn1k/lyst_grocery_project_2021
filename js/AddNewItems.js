const list = [];
let index = 0;

const AddNewItems = function () {
  const ref_to_item_field = document.getElementById('items');
  const ref_to_quantity_field = document.getElementById('quantity');

  //headings
  const headings = `
  <div class='container'>
    <div class='row ml-3'>
        <div class='col NanumGothic'>
            <h4>Item</h4>
        </div>
        <div class='col NanumGothic'>
            <h4>Quantity</h4>
        </div>
        <div class='col'></div>
    </div>
  </div>`;
  //grids styling
  const container = `<div class='container'>`;
  //const row = `<div class='row m-2'>`;
  const col = `<div class='col'>`;
  const endDiv = `</div>`;

  if ((ref_to_item_field.value).length > 1 && (ref_to_item_field.value).length < 51) { // if item field is not blank & not too long - AT

    const input = `<input class='form-control input-sm' type="text" name="items[]" value="${ref_to_item_field.value}" />`;
    const quantity = `<input type="text" class='form-control input-sm' name="quantity[]" value="${ref_to_quantity_field.value}" />`;
    const remove = `<button class='btn btn-secondary btn-sm pr-2 pl-2 mt-1 mb-1' onclick="document.getElementById('item-${index}').parentNode.removeChild(document.getElementById('item-${index}'));">remove</button>`;
    const new_item = container + 
      `<div id='item-${index}' class='row m-2'>` + col + input + endDiv + col + quantity + endDiv + col + remove + endDiv + `</div>` + endDiv;

      if (document.getElementById('notesText').innerHTML == "") {
        document.getElementById('notesText').innerHTML = headings;
      }
    document.getElementById('notesText').innerHTML += new_item;

    ++index;
  }
  else if((ref_to_item_field.value).length < 1) { // if item field is blank - AT
    // alert("Item field cannot be blank!");
    $(document).ready(function(){
      $('#emptyFields').modal('show');
    });
  }
  else { // if item field is too long - AT
    // alert("Item name is too long, please limit it to 50 characters or less!");
    $(document).ready(function(){
      $('#itemLength').modal('show');
    });
  }
  ref_to_item_field.value = '';
  ref_to_quantity_field.value = '';
};

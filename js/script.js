document.addEventListener('DOMContentLoaded', function () {

    const menuToggle = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');

    
    if (!menuToggle || !navLinks) return;

    menuToggle.addEventListener('click', function () {
        navLinks.classList.toggle('open');
    });

});

//Script for editing items
function showEditForm(id) {
    
    const row = document.querySelector(`form input[name='item_id'][value='${id}']`).closest('tr');

  
    document.getElementById('editForm').style.display = 'block';
    document.getElementById('item_id').value = id;
    document.getElementById('item_name_edit').value = row.children[2].innerText;        
    document.getElementById('description_edit').value = row.children[3].innerText;    
    document.getElementById('colour_edit').value = row.children[4].innerText;         
    document.getElementById('price_edit').value = row.children[5].innerText.replace('£',''); 
    document.getElementById('quantity_edit').value = row.children[6].innerText;       
    document.getElementById('current_image').value = row.querySelector('input[name="current_image"]').value;

    window.scrollTo({ top: document.getElementById('editForm').offsetTop, behavior: 'smooth' });
}


function hideEditForm() {
    document.getElementById('editForm').style.display = 'none';
}
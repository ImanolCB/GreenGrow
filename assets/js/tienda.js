window.onload = function () {
    const searchInput = document.getElementById('busqueda');
    const productContainer = document.getElementById('contenedor');
    const searchableItems = productContainer.getElementsByClassName('searchable-item');

    searchInput.addEventListener('keypress', () => {
        const filter = searchInput.value.toLowerCase();

        for (let i = 0; i < searchableItems.length; i++) {
            const itemText = searchableItems[i].textContent.toLowerCase();
            if (itemText.includes(filter)) {
                searchableItems[i].style.display = "";
            } else {
                searchableItems[i].style.display = "none";
            }
        }
    });
};

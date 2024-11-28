const apiUrl = 'http://localhost:81/back/api.php';

function fetchProductos() {
    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const lista = document.getElementById('productos-list');
            lista.innerHTML = '';
            data.forEach(producto => {
                const item = document.createElement('li');
                item.textContent = `${producto.nombre} - $${producto.precio}`;
                lista.appendChild(item);
            });
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

function agregarProducto(event) {
    event.preventDefault();
    const nombre = document.getElementById('nombre').value;
    const precio = document.getElementById('precio').value;

    fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ nombre, precio })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        alert(data.status || data.error);
        fetchProductos(); // Refrescar la lista de productos
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
}

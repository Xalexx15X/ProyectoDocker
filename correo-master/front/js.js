
const apiUrl = 'http://localhost/ProyectoDokerApi/correo-master/back/api.php';

function fetchProductos() {
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            const lista = document.getElementById('productos-list');
            lista.innerHTML = '';
            data.forEach(producto => {
                const item = document.createElement('li');
                item.textContent = `${producto.nombre} - $${producto.precio}`;
                lista.appendChild(item);
            });
        });
}

function agregarProducto(event) {
    event.preventDefault();
    const nombre = document.getElementById('nombre').value;
    const precio = document.getElementById('precio').value;

    fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ nombre, precio})
    })
    .then(response => response.json())
    .then(data => {
        alert(data.status || data.error);
        fetchProductos(); // Refrescar la lista de productos
    });
}
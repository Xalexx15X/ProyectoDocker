const apiUrl = 'http://localhost:81/correo-master/back/api.php';

function fetchKebabs() {
    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en el servidor');
            }
            return response.json();
        })
        .then(data => {
            const lista = document.getElementById('kebab-list');
            lista.innerHTML = '';
            data.forEach(kebab => {
                const item = document.createElement('li');
                item.textContent = `$kebab.nombre - $kebab.precio`;
                lista.appendChild(item);
            });
        })
        .catch(error => {
            console.error('Error en la petición:', error);
        });
}

function agregarKebabs(event) {
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
            throw new Error('error del servidor');
        }
        return response.json();
    })
    .then(data => {
        alert(data.status || data.error);
        fetchKebabs(); // Refrescar la lista de productos
    })
    .catch(error => {
        console.error('Error en la petición:', error);
    });
}

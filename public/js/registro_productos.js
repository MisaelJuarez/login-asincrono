let editar;
let btnEditar = false;

const obtener_datos = () => {
    let tablaProducto = document.getElementById('tabla_productos');
    fetch("app/controller/obtener_datos.php")
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        if (respuesta[0] == 1) {
            let contenido = ''; 
            respuesta[1].map((dato) => {
            contenido += `
                <tr>
                    <td>${dato['nombre']}</td>
                    <td>$${dato['precio']}</td>
                    <td>
                        <button class="btn btn-warning editar" data-btn="editar" data-id="${dato['id']}" data-nombre="${dato['nombre']}" data-precio="${dato['precio']}">Editar</button>
                        <button class="btn btn-danger eliminar" data-btn="eliminar" data-id="${dato['id']}">Eliminar</button>
                    </td>
                </tr>
                `; 
            });
            tablaProducto.innerHTML = contenido;
        } else if(respuesta[0] == 0){
            tablaProducto.innerHTML = respuesta[1];
        }

    });
}

const registrar_producto = () => {
    btnEditar = false;
    let idInput = document.getElementById('idInput').value;
    let nombre_p = document.getElementById('nombre').value;
    let precio_p = document.getElementById('precio').value;
    let data = new FormData();
    data.append("idInput",idInput);
    data.append("nombre_p",nombre_p); 
    data.append("precio_p",precio_p); 
    fetch("app/controller/registro_productos.php",{
        method:"POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success",title:`${respuesta[1]}`});
        } else if(respuesta[0] == 0) {
            Swal.fire({icon: "error",title:`${respuesta[1]}`});
        }
    })
    document.getElementById('nombre').value = '';
    document.getElementById('precio').value = '';
    document.getElementById('idInput').value = parseInt(document.getElementById('idInput').value) + 1;
    obtener_datos();
}

const editar_producto = () => {
    btnEditar = false;
    let nombre_p = document.getElementById('nombre').value;
    let precio_p = document.getElementById('precio').value;
    let data = new FormData();
    data.append('idInput',editar);
    data.append("nombre_p",nombre_p); 
    data.append("precio_p",precio_p); 
    fetch(`app/controller/actualizar_producto.php`,{
        method:"POST",
        body: data
    })
    .then(res => res.json())
    .then(async (res) => {
        console.log(res);
        if (res.status === 'success') {
            await Swal.fire({icon: "success",title:`${res.message}`});
            obtener_datos();
        } else {
            await Swal.fire({icon: "error",title:`${res.message}`});
        }
    })
    document.getElementById('nombre').value = '';
    document.getElementById('precio').value = '';
    document.getElementById('btn-registrar-producto').textContent = 'Registrar producto';
} 

const eliminar_producto = () => {
    let data = new FormData();
    data.append('idInput',editar);
    fetch('app/controller/eliminar_producto.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(async result => {
        if (result.status === 'success') {
            await Swal.fire({icon: "success",title:`${res.message}`});
            obtener_datos();
        } else {
            await Swal.fire({icon: "error",title:`${res.message}`});
        }
    })
}

document.addEventListener('DOMContentLoaded',() => {
    obtener_datos();
})

document.getElementById('btn-registrar-producto').addEventListener('click',() => {
    if (!btnEditar) {
        registrar_producto();
    } else {
        editar_producto();
    }
});

document.getElementById('tabla_productos').addEventListener('click', (e) => {
    if (e.target.classList.contains('editar')) {
        document.getElementById('nombre').value = e.target.dataset.nombre;
        document.getElementById('precio').value = e.target.dataset.precio;
        document.getElementById('btn-registrar-producto').textContent = 'Editar Producto';
        editar = e.target.dataset.id;
        btnEditar = true;
    }
    if (e.target.classList.contains('eliminar')) {
        editar = e.target.dataset.id;
        eliminar_producto();
    }
});
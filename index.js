document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("formContacto");
    const btnBorrar = document.getElementById("btnBorrar");

    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault(); 

            const nombre = document.getElementById("nombre").value.trim();
            const email = document.getElementById("email").value.trim();
            const mensaje = document.getElementById("mensaje").value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (nombre.length < 2) {
                Swal.fire({
                    icon: 'error',
                    title: 'Nombre no válido',
                    text: 'Por favor, introduce un nombre de al menos 2 caracteres.',
                    confirmButtonColor: '#d51a1a'
                });
                return; 
            }

            if (!emailRegex.test(email)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Email incorrecto',
                    text: 'Asegúrate de que el formato de correo electrónico sea válido.',
                    confirmButtonColor: '#d51a1a'
                });
                return;
            }

            if (mensaje.length < 10) {
                Swal.fire({
                    icon: 'error',
                    title: 'Mensaje muy corto',
                    text: 'El mensaje debe contener al menos 10 caracteres.',
                    confirmButtonColor: '#d51a1a'
                });
                return;
            }
           
            Swal.fire({
                icon: 'success',
                title: '¡Validación correcta!',
                text: 'Los datos introducidos son válidos. (Simulado en GitHub Pages)',
                timer: 2500,
                showConfirmButton: false
            }).then(() => {
                
                form.reset(); 
            });
        });
    }
   
    if (btnBorrar && form) {
        btnBorrar.addEventListener("click", (e) => {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Se borrarán todos los datos que has escrito",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'red',
                cancelButtonColor: '#232020',
                confirmButtonText: 'Sí, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.reset();
                    Swal.fire('Vaciado', 'El formulario ha sido limpiado.', 'success');
                }
            });
        });
    }
});
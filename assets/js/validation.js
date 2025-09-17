document.addEventListener("DOMContentLoaded",()=>{
  const form=document.getElementById("empleadoForm");
  if(!form) return;
  form.addEventListener("submit",e=>{
    const email=form.email.value.trim();
    const sexo=form.querySelector("input[name='sexo']:checked");
    const area=form.area_id.value;
    const rol=form.rol_id.value;
    if(nombre.length<2){alert("Nombre muy corto");e.preventDefault();}
    else if(!/^\S+@\S+\.\S+$/.test(email)){alert("Email inválido");e.preventDefault();}
    else if(!sexo){alert("Selecciona sexo");e.preventDefault();}
    else if(!area){alert("Selecciona área");e.preventDefault();}
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("form-empleado");
  if (!form) return;

  form.addEventListener("submit", e => {
    let valid = true;

    // Expresiones regulares
    const regexNombre = /^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/;
    const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Obtener campos
    const nombre = form.nombre;
    const descripcion = form.descripcion;
    const correo = form.email;
    const genero = form.querySelector("input[name='sexo']:checked");
    const generoGroup = form.querySelector("#genero-group"); // Agrega un div con este id en el formulario
    const area = form.area_id;
    const rol = form.rol_id;

    // Resetear estados y mensajes
    [nombre, descripcion, correo, area, rol].forEach(el => {
      if (el) el.classList.remove("is-invalid");
      if (el && el.nextElementSibling && el.nextElementSibling.classList.contains("invalid-feedback")) {
        el.nextElementSibling.style.display = "none";
      }
    });
    if (generoGroup) {
      generoGroup.classList.remove("is-invalid");
      const feedback = generoGroup.querySelector(".invalid-feedback");
      if (feedback) feedback.style.display = "none";
    }

    // Validar nombre
    if (!regexNombre.test(nombre.value.trim())) {
      nombre.classList.add("is-invalid");
      if (nombre.nextElementSibling && nombre.nextElementSibling.classList.contains("invalid-feedback")) {
        nombre.nextElementSibling.style.display = "block";
      }
      valid = false;
    }

    // Validar descripción
    if (descripcion.value.trim().length < 10) {
      descripcion.classList.add("is-invalid");
      if (descripcion.nextElementSibling && descripcion.nextElementSibling.classList.contains("invalid-feedback")) {
        descripcion.nextElementSibling.style.display = "block";
      }
      valid = false;
    }

    // Validar correo
    if (!regexCorreo.test(correo.value.trim())) {
      correo.classList.add("is-invalid");
      if (correo.nextElementSibling && correo.nextElementSibling.classList.contains("invalid-feedback")) {
        correo.nextElementSibling.style.display = "block";
      }
      valid = false;
    }

    // Validar género
    if (!genero) {
      if (generoGroup) {
        generoGroup.classList.add("is-invalid");
        const feedback = generoGroup.querySelector(".invalid-feedback");
        if (feedback) feedback.style.display = "block";
      }
      valid = false;
    }

    // Validar área
    if (!area.value) {
      area.classList.add("is-invalid");
      if (area.nextElementSibling && area.nextElementSibling.classList.contains("invalid-feedback")) {
        area.nextElementSibling.style.display = "block";
      }
      valid = false;
    }

    // Validar rol
    if (!rol.value) {
      rol.classList.add("is-invalid");
      if (rol.nextElementSibling && rol.nextElementSibling.classList.contains("invalid-feedback")) {
        rol.nextElementSibling.style.display = "block";
      }
      valid = false;
    }

    if (!valid) e.preventDefault();
  });
});